<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use DB;
use App\Favorite;
use App\Anime;
use App\Rating;
use App\Comment;
class UserController extends Controller
{

    public function __construct(){
        $this->middleware('web');
    }

    public function index(){
    	return view('user.index');
    }

    public function editUser(){
    	$user = Auth::user();
        $comment = DB::table('comments')->join('animes','comments.anime_id','=','animes.id')
                                        ->join('users','comments.user_id','=','users.id')
                                        ->select('comments.id','animes.title','comment')
                                        ->where('user_id', $user)
                                        ->get();
    	return view('user.edit', compact('user', 'comment'));
    }

    public function SaveEditUser(Request $request){
    	$user = Auth::user();
    	if(Hash::check($request->old_password, $user->password)){
    		$user->username  = $request->username;
    		$user->email  = $request->email;
    		$user->password  = bcrypt($request->new_password);
    		$user->save();
            
    		return redirect('/edit');
    	}
    	else if(Hash::check($request->old_password, $user->password) == null){
    		$user->username  = $request->username;
    		$user->email  = $request->email;
    		$user->save();
    		return redirect('/edit');
    	}
    }

    public function giveComment(Request $request, Anime $animes){
       $validate =  $request->validate([
            'comment' => 'required | max:255'
        ]);

       if(!Auth::check()){
            Alert::toast('Please login Or Register ! ','success','top-center');
            return redirect('login');
       }
       if($request->isMethod('post')){
            if($validate){
                $comment = new Comment;
                $comment->user_id = Auth::user()->id;
                $comment->anime_id  =  $animes->id;
                $comment->comment = $request->comment;
                if($comment->save()){
                    Alert::toast('Success Comment','success','top-center');
                    return back()->with(['success'=>'Berhasil Komentar']);
                }
            Alert::error('Opps!','Something Wrong!');
            return redirect()->back();
            }     
        }
        else
            return redirect('/anime/detail/'.$animes->id.'');
    }


     public function giveRating(Request $request, Anime $animes){
        $rating = new Rating;
        $rating->user_id = auth()->id();
        $rating->anime_id = $animes->id;
        $rating->rating = $request->rating;
        $rating->save();
        return redirect()->back();
    }

    public function postFavorite(Request $request, Anime $animes){
        $anime_id = $animes->id;
        $user_id = auth()->id();
        if(!empty($anime_id)){
            $cek = Favorite::where('anime_id',$anime_id)->where('user_id',$user_id)->count();
            if($cek == 0){
                Favorite::create([
                    'user_id'=>$user_id,
                    'anime_id'=>$anime_id
                ]);
                Alert::toast('Anime Add to Favorite','success','top');
                return redirect()->back();
            }
            else{
                Alert::toast('Anime already in favorites!','error','top');
                return redirect()->back();
                }
            }
    }

    public function showFavorite(){
        $user = auth()->id();
        $favorite = DB::select("select f.id, a.title, a.img_url, a.type, a.members FROM favorites f 
                                LEFT JOIN animes a ON f.anime_id = a.id 
                                LEFT JOIN users u ON f.user_id = u.id 
                                WHERE f.user_id = $user");
        return view('user.favorite',compact('favorite'));
    }

    public function recommendation(){
        $client = new Client();
        $response = $client->get('http://localhost/maanime/public/api/anime/rekomendasi/12')->getBody()->getContents();
        $data = json_decode($response, true);           
        return view('user.recommendation',compact('data'));
    }

}
