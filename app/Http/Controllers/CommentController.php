<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Comment;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function comment(Request $data){
		$table = new Comment;
		$table->comment = $data->Input('comment');
		$table->user = $data->Input('user');
		$table->post_id = $data->Input('post_id');
		$table->save();
		$slug = $data->Input('slug');
		return Redirect::to('single/'.$slug);
	}
}
