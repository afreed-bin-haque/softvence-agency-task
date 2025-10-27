<?php

namespace Modules\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
