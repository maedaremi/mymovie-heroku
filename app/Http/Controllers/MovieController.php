<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;

use App\Movie;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $posts = Movie::all()->sortByDesc('updated_at');
        return view('movie.index', ['posts' => $posts]);
    }
    public function show(Request $request)
    {
        $post = Movie::find($request->id);
        if (empty($post)) {
        abort(404);    
      }
      return view('movie.show',['movie' => $post]);
    }
    
}
