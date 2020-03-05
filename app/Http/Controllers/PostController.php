<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
Use App\Jobs\SendPostEmail;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index');
    }

    public function store(Request $request)
    {
        $time = $request->time * 60 * 60;
        for ($i = 0; $i < $request->amount; $i++) {
            dispatch(new SendPostEmail($request->all()))->delay(now()->addSeconds($time));
        }
        //https://laptrinhx.com/how-to-send-mail-using-queue-in-laravel-5-8-and-using-mailtrap-898583849/
        return redirect()->route('person.index')->with('status', 'Your post has been submitted successfully');
    }
}
