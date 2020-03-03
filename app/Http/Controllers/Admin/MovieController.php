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
      
    return redirect('admin/movie/create');
  }  
  
   public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Movie::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Movie::all();
      }
      return view('admin.movie.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
  
  public function edit(Request $request)
  {
      // Movie Modelからデータを取得する
      $movie = Movie::find($request->id);
      if (empty($movie)) {
        abort(404);    
      }
      return view('admin.movie.edit', ['movie_form' => $movie]);
  }

  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Movie::$rules);
      // Movie Modelからデータを取得する
      $movie = Movie::find($request->id);
      // 送信されてきたフォームデータを格納する
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

      // 該当するデータを上書きして保存する
      $movie->fill($movie_form)->save();

      return redirect('admin/movie');
  }
  
  public function delete(Request $request)
  {
      // 該当するMovie Modelを取得
      $movie = Movie::find($request->id);
      // 削除する
      $movie->delete();
      return redirect('admin/movie/');
  }  
  
}
