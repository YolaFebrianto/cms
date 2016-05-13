@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Form</div>

                <div class="panel-body">
					{{ Form::open(['url' => ['edit-post',$datas->id]]) }}
					<div class="form-group">
						<input type="text" name="title" value="{{ $datas->title }}" class="form-control" placeholder="Title"/>
						@if($errors->has('title'))
							<span style="color: red;">{{ $errors->first('title') }}</span>
						@endif
					</div>
					<div class="form-group">
						<textarea name="body" class="form-control" id="new-post" rows="5" placeholder="Your Post">{{ $datas->body }}</textarea>
						@if($errors->has('body'))
							<span style="color: red;">{{ $errors->first('body') }}</span>
						@endif
					</div>
					<button type="submit" class="btn btn-primary">Update Post</button>
					<input type="hidden" value="{{ Session::token() }}" name="_token" />
					{{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection