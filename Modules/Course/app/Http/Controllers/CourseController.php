<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Modules\Course\Models\Content;
use Modules\Course\Models\Course;
use Modules\Course\Models\Module;

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
            $validator = Validator::make($request->all(), [
                'courseTitle' => 'required|string|max:255',
                'level' => 'required|string|in:Beginner,Intermediate,Advanced',
                'category' => 'required|string|in:General,Science,Commerce,Arts,Humanities,Mathematics',
                'coursePrice' => 'required|numeric|min:0',
                'courseSummery' => 'required|string',
                'featureImage' => 'nullable|file|mimes:png,jpg,jpeg',
                'featureVideo' => 'nullable|file|mimes:mp4',
                'module' => 'required|array|min:1',
                'module.*.moduleTile' => 'required|string|max:255',
                'module.*.content' => 'required|array|min:1',
                'module.*.content.*.contentTitle' => 'required|string|max:255',
                'module.*.content.*.videoSourceType' => 'required|in:Youtube,Facebook,Twitch',
                'module.*.content.*.videoUrl' => 'required|url',
                'module.*.content.*.videoLength' => ['required', 'regex:/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/'],
            ], [
                'module.*.content.*.videoLength.regex' => 'Video Length must be in HH:MM:SS 24-hour format.',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => 'bad-request',
                    'msg' => $validator->errors()->first()
                ], 400);
            }
            $videoUrl = null;
            $imageUrl = null;
            if ($request->hasFile('featureVideo') && $request->file('featureVideo')->isValid()) {
                $file = $request->file('featureVideo');
                $videoName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)
                    . '_' . time() . '.' . $file->getClientOriginalExtension();
                $videoPath = Storage::disk('public')->putFileAs('videos', $file, $videoName);
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

            $createCourse = Course::create([
                "course_title" => $request->courseTitle,
                "feature_video" => $videoUrl,
                "feature_image" => $imageUrl,
                "level" => $request->level,
                "category" => $request->category,
                "course_price" => $request->coursePrice,
                "course_summery" => $request->courseSummery,
            ]);
            if ($createCourse) {
                foreach ($request->module as $moduleObj) {
                    $createModule = Module::create([
                        'course_id' => $createCourse->course_id,
                        'module_title' => $moduleObj['moduleTile'],
                    ]);
                    if ($createModule) {
                        foreach ($moduleObj['content'] as $contentObj) {
                            Content::create([
                                'module_id' => $createModule->module_id,
                                'content_title' => $contentObj["contentTitle"],
                                'video_source' => $contentObj["videoSourceType"],
                                'video_url' => $contentObj["videoUrl"],
                                'video_length' => $contentObj["videoLength"],
                            ]);
                        }
                    }
                }
            }
            return response()->json([
                'status' => true,
                'error' => null,
                'msg' => 'Course details saved',
                'data' => $createCourse->course_id,
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

    public function courseDetail($id)
    {
        $getCourse = Course::with(['moduleList.contentList'])
            ->where('course_id', $id)
            ->first();

        if (!$getCourse) {
            abort(404);
        }
        return view('course::detail', compact('getCourse'));
    }
}
