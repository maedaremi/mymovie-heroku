@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        <div class="row">
        　<div class="col-md-4">
            <a href="/login" role="button" class="btn btn-primary">ログイン</a>
        　</div>
        　<div class="col-md-8">
            <a href="/admin/movie" role="button" class="btn btn-primary">管理画面</a>
        　</div>
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="title">
                                    {{ str_limit($post->title, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($post->body, 1500) }}
                                </div>
                            </div>
                            <div>
                                <a href="{{ action('MovieController@show', ['id' => $post->id]) }}">動画</a>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection