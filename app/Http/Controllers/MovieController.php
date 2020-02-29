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

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // movie/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('movie.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
