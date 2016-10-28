<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller
{
	
	public function getIndex () {
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		return view ('pages.welcome')->withPosts($posts);
	}

	public function getContact () {
		return view ('pages.contact');
	}

	public function getAbout () {
		return view ('pages.about');
	}

}