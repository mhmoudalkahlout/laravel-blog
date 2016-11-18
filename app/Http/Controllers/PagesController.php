<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller
{
	
	public function getIndex () {
		$posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
		return view ('pages.welcome')->withPosts($posts);
	}

	public function getContact () {
		return view ('pages.contact');
	}

	public function postContact (Request $request) {
		$this->validate($request, [
				'email' => 'required|email',
				'subject' => 'required|min:3',
				'messageBody' => 'required|min:10'
			]);
		$data = array(
			'email' => $request->email,
			'subject' => $request->subject,
			'messageBody' => $request->messageBody
			);
		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('hardak9@gmail.com');
			$message->subject($data['subject']);
		});
		Session::flash('success', 'Your message was send');
		return redirect('/'); 
	}

	public function getAbout () {
		return view ('pages.about');
	}

}