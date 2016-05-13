<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function single($slug){
		$comment = Comment::all();
		$table = DB::table('posts')->where('slug',$slug)->first();
		return view('single')->with('datas',$table)->with('comment',$comment);
	}
    public function store(Request $data){
		$validation = Validator::make($data->all(),[
			'title' => 'required',
			'body' => 'required'
		]);
		if($validation->fails()){
			return Redirect::to('home')->withErrors($validation);
		}else{
			$table = new Post;
			$table->title = $data->Input('title');
			$table->slug = str_slug($data->Input('title'),'-');
			$table->body = $data->Input('body');
			$table->user_id = Auth::user()->id;
			$table->save();
			return Redirect::to('home')->with('message','Data Berhasil di Tambahkan!');
		}
	}
	public function delete($id){
		$table = Post::find($id);
		$table->delete();
		return Redirect::to('home')->with('message','Data Berhasil di Hapus!'); 
	}
	public function getEditForm($id){
		$table = Post::find($id);
		return view('editform')->with('datas',$table);
	}
	public function update(Request $data, $id){
		$validation = Validator::make($data->all(),[
			'title' => 'required',
			'body' => 'required'
		]);
		if($validation->fails()){
			return Redirect::to('editform'.$data->id)->withErrors($validation);
		}else{
			$table = Post::find($id);
			$table->title = $data->Input('title');
			$table->slug = str_slug($data->Input('title'),'-');
			$table->body = $data->Input('body');
			$table->save();
			return Redirect::to('home')->with('message','Data Berhasil di Edit!');
		}
	}
}
