<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;
//use App\Models\Lesson;
//use Illuminate\Support\Facades\Auth;
//use Spatie\Permission\Traits\HasRoles;

class PageController extends Controller
{

	//use HasRoles;

	public function index($slug) {

		$page = Page::findBySlug($slug);

		/*if (!Auth::guest()) {
			$user = Auth::user();
		}*/


		if (!$page)
		{
			abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
		}

		$this->data['title'] = $page->title;
		$this->data['page'] = $page->withFakes();

		/*if($page->template == 'lessons') {

			if (!Auth::guest() && $user->hasRole('Admin')) {

				$lessons = Lesson::all();

				return view( 'pages.' . $page->template, $this->data )->with( 'lessons', $lessons )->with( 'user',
					$user );
			} else {

				return view('inc.unauthorized');
			}

		} else {*/
			return view( 'pages.' . $page->template, $this->data );
		//}
	}
}
