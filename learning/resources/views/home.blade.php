@extends('layouts.app')

@section('content')
   <?php alert()->message('Message', 'Optional Title');?>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">Dashboard</div>
                <div><img src="/images/vue.png" width="100%"/></div>
                <div class="panel-body">
                    <form method="POST" action="{{ url('upload') }}" enctype="multipart/form-data">
                        @foreach ($errors as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label for="image">Choose an image</label>
                            <input type="file" id="image" name="image">
                        </div>

                        <input class="btn btn-danger" type="submit" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
