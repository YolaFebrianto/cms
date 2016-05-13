@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><p class="lead" style="margin: 0;">{{ $datas->title }}</p></div>

                <div class="panel-body">
					<p>{{ $datas->body }}</p>
					<div class="info">Posted by 
					<?php 
						$user_id = $datas->user_id;
						echo DB::table('users')->where('id',$user_id)->first()->name;
					?> 
					on {{ $datas->created_at }}</div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>

                <div class="panel-body">
					{{ Form::open(array('url'=>'comment')) }}
						<div class="form-group">
							<textarea rows="4" name="comment" placeholder="Write Your Comment Here!" class="form-control"></textarea>
							<input type="hidden" name="post_id" value="{{ $datas->id }}">	
							<input type="hidden" name="user" value="{{ Auth::user()->name }}">	
							<input type="hidden" name="slug" value="{{ $datas->slug }}">	
						</div>
						<input type="submit" value="Send Comment" class="btn btn-sm btn-default" />
					{{ Form::close() }}
					@foreach($comment as $komen)
						@if($komen->post_id == $datas->id)<hr>
							<p>{{ $komen->comment }}</p>
							<div class="info">Posted by 
							@if($komen->user == Auth::user()->name)
							{{ 'Me' }}
							@else
							{{ $komen->user }}
							@endif
							on {{ $komen->created_at }}</div>
						@endif
					@endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection