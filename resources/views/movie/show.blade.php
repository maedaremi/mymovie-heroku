@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="image col-md-6 text-right mt-4">
            
            @if ($movie->image_path)
                <video src="{{ asset('storage/image/'.$movie -> image_path) }}"controls></video>
            @endif
            <hr color="#c0c0c0">
        </div>
    </div>
@endsection
 