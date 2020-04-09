<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;


class LessonsController extends Controller
{
    public function index() {

    	return view('lessons.index')->with(['lessons' => Lesson::get()]);;
    }
}
