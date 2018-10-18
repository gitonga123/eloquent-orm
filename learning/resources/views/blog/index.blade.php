@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if ($posts->isEmpty())
                    <p class="alert alert-warning"> There is no posts.</p>
                @else
                    @foreach($posts as $post)
                        <div class="panel panel-primary">
                            <div class="panel-heading">{{ $post->title }}</div>

                            <div class="panel-body">
                                {!! mb_substr($post->content, 0, 500) !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
