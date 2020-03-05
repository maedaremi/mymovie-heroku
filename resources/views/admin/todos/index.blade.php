@extends('layouts.admin')
@section('title', 'Todo一覧')

@section('content')
    <div class="container">
        <div class="row">
            <h2>Todo一覧</h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="{{ action('Admin\TodoController@add') }}" role="button" class="btn btn-primary">新規作成</a>
            </div>
            <div class="col-md-8">
                <a href="/admin/movie" role="button" class="btn btn-primary">動画管理</a>
        　  </div>
        </div>
        <div class="row">
            <div class="list-todo col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="50%">本文</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $todo)
                                <tr>
                                    <td>{{ \Str::limit($todo->body, 250) }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\TodoController@delete', ['id' => $todo->id]) }}">削除</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection