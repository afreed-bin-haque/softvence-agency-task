<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CourseController extends Controller
{

    public function index()
    {
        return view('course::index');
    }

    public function makeCourse()
    {
        return view('course::make-course');
    }

    public function storeCourse(Request $request)
    {
        try {
            $videoUrl = null;
            $imageUrl = null;
            if ($request->hasFile('featureVideo') && $request->file('featureVideo')->isValid()) {
                $file = $request->file('featureVideo');
                $videoName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    . '_' . time() . '.' . $file->getClientOriginalExtension();

                // Store video in /storage/app/public/videos
                $videoPath = Storage::disk('public')->putFileAs('videos', $file, $videoName);

                // Correct absolute path (no 'public/' prefix)
                $absoluteVideoPath = Storage::disk('public')->path($videoPath);

                $this->saveVideo($absoluteVideoPath);
                $videoUrl = asset('storage/' . $videoPath);
            }

            if ($request->hasFile('featureImage') && $request->file('featureImage')->isValid()) {
                $image = $request->file('featureImage');
                $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '_' . time() . '.' . $image->getClientOriginalExtension();

                $imagePath = Storage::disk('public')->putFileAs('images', $image, $imageName);

                $absoluteImagePath = Storage::disk('public')->path($imagePath);

                $this->saveImage($absoluteImagePath);
                $imageUrl = asset('storage/' . $imagePath);
            }

            return response()->json([
                'status' => true,
                'error' => null,
                'msg' => 'Course details saved',
                'course' => [
                    'video' => $videoUrl,
                    'image' => $imageUrl,
                ],
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
                'msg' => 'Unprocessable entity',
            ], 499);
        }
    }


    private function saveVideo($filePath)
    {
        clearstatcache();
        $content = file_get_contents($filePath);
        file_put_contents($filePath, $content);
    }

    private function saveImage($filePath)
    {
        $width = 600;
        $height = 500;
        $manager = new ImageManager(new Driver());
        $image = $manager->read($filePath);
        $image->resize($width, $height)->save($filePath, 85);
    }
}
