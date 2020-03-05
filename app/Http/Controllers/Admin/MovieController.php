<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;

class MovieController extends Controller
{
    //
  public function add()
  {
      return view('admin.movie.create');
  }
  public function create(Request $request)
  {
    $this->validate($request, Movie::$rules);
    
    $movie = new Movie;
    $form = $request->all();
    
    if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $movie->image_path = basename($path);
    } else {
          $movie->image_path = null;
    }
    
    unset($form['_token']);
    
    unset($form['image']);
    
    $movie->fill($form);
    $movie->save();
      
    return redirect('admin/movie/');
  }  
  
   public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          
          $posts = Movie::where('title', $cond_title)->get();
      } else {
          
          $posts = Movie::all();
      }
      return view('admin.movie.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request)
  {
      
      $movie = Movie::find($request->id);
      if (empty($movie)) {
        abort(404);    
      }
      return view('admin.movie.edit', ['movie_form' => $movie]);
  }

  public function update(Request $request)
  {
      
      $this->validate($request, Movie::$rules);
      
      $movie = Movie::find($request->id);
      
      $movie_form = $request->all();
      if (isset($movie_form['image'])) {
      $path = $request->file('image')->store('public/image');
        $movie->image_path = basename($path);
        unset($movie_form['image']);
      } elseif (isset($request->remove)) {
        $movie->image_path = null;
        unset($movie_form['remove']);
      }
      unset($movie_form['_token']);

      
      $movie->fill($movie_form)->save();

      return redirect('admin/movie');
  }
  
  public function delete(Request $request)
  {
      
      $movie = Movie::find($request->id);
      
      $movie->delete();
      return redirect('admin/movie/');
  }  
  
}
