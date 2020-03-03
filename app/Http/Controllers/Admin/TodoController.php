<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Todo;

class TodoController extends Controller
{
    //
    public function index(Request $request) {
      
      $posts = Todo::all();
      return view('admin.todos.index', ['posts' => $posts]);
    }
    
    public function add() {
  
      return view('admin.todos.create');
  }
  public function create(Request $request) {
    $this->validate($request, Todo::$rules);

      $todo = new Todo;
      $form = $request->all();

      unset($form['_token']);
      
      $todo->fill($form);
      $todo->save();

      return redirect('admin/todos/create');
  }
  
  public function delete(Request $request)
  {
      // 
      $todo = Todo::find($request->id);
      // 
      $todo->delete();
      return redirect('admin/todos/');
  }  
}
