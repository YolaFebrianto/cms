@extends('layouts.app')

@section('content')
<div class="container">
	@if(Session::has('message'))
		<div class="alert alert-success">
			<b>{{ Session::get('message') }}</b>
		</div>
	@endif
	<div class="row">
		<div class="col-sm-5">
			<h2>Create a New Post</h2>
			{{ Form::open(array('url'=>'create-post')) }}
				<div class="form-group">
					<input type="text" name="title" class="form-control" placeholder="Title"/>
					@if($errors->has('title'))
						<span style="color: red;">{{ $errors->first('title') }}</span>
					@endif
				</div>
				<div class="form-group">
					<textarea name="body" class="form-control" id="new-post" rows="5" placeholder="Your Post"></textarea>
					@if($errors->has('body'))
						<span style="color: red;">{{ $errors->first('body') }}</span>
					@endif
				</div>
				<button type="submit" class="btn btn-primary">Create Post</button>
				<input type="hidden" value="{{ Session::token() }}" name="_token" />
			{{ Form::close() }}
		</div>
		<div class="col-sm-4 col-sm-offset-3 posts">
			<header><h3>What other people say...</h3></header>
			@foreach($datas as $post)
			<article class="post">
				<h4><a href="{{ url('single') }}/{{ $post->slug }}">{{ $post->title }}</a></h4>
				<p>
				<?php
				if(strlen($post->body) > 100){
					echo substr($post->body,0,100).'...';
				}else{
					echo $post->body;
				}
				?></p>
				<div class="info">Posted by 
				<?php 
					$user_id = $post->user_id;
					$user = DB::table('users')->where('id',$user_id)->first()->name;
					if($user == Auth::user()->name){ $user = 'Me'; }
					echo $user;
				?> 
				on {{ $post->created_at }}</div>
				<div class="interaction">
					@if(Auth::user()->id == $post->user_id)
					<a href="{{ url('editform') }}/{{ $post->id }}">Edit</a> |
					<a href="{{ url('delete-post') }}/{{ $post->id }}">Delete</a> 
					@endif
				</div>
			</article>
			@endforeach
			{{ $datas->links() }}
		</div>
	</div>
</div>
@endsection
