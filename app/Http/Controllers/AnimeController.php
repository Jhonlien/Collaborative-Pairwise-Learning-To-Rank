<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Anime;
use App\Comment;
use App\Rating;
use App\Favorite;
use DB;
use Auth;
class AnimeController extends Controller
{
    public function index(Request $request){
    	$anime = DB::table('animes')->where('type','ova')->paginate(4);
    	$anime_movie = $this->index_movie();
    	$anime_tv = $this->index_tv();
    	return view('user.index', compact('anime','anime_movie','anime_tv'));
    }

    public function count_comment($id){
        $comment = DB::table('comments')->where('anime_id','=',$id)->count();
        return $comment;
    }

    private function index_movie(){
    	$anime = DB::table('animes')->where('type','movie')->paginate(4);
    	return $anime;
    }

    private function index_tv(){
    	$anime = DB::table('animes')->where('type', 'tv')->paginate(4);
    	return $anime;
    }

    public function detail($id){
        $detail = Anime::find($id);
        $comment = DB::table('comments')->join('animes','comments.anime_id','=','animes.id')
                                        ->join('users','comments.user_id','=','users.id')
                                        ->select('comments.id','users.username','comment')
                                        ->where('anime_id',$id)->orderBy('id','desc')
                                        ->get();
        $count_comment = DB::table('comments')->where('anime_id',$id)->count();
        $count_favorit = DB::table('favorites')->where('anime_id',$id)->count();
        $rating = $this->rating($id);
        $created = $this->user_created1($id);
        return view('user.detail', compact('comment','detail','count_comment','count_favorit','rating','created'));
    }

    private function user_created1($id){
        $creat = DB::table('animes')->leftJoin('users', 'animes.user_id','=','users.id')
                                    ->select('animes.id','users.username')
                                    ->where('animes.id',$id)->first()->username;
        return $creat;
    }

    private function rating($id){
        $rating = "SELECT sum(rating)/count(rating) as total FROM ratings WHERE anime_id = $id";
        $db = DB::select(DB::raw($rating));
        $format = number_format($db[0]->total, 1);
        return $format;
    }

    public function search(Request $request){
        $query = $request->keyword;
        $search = Anime::when($request->keyword, function($query) use ($request){
            $query->where('title', 'like', "%{$request->keyword}%")
                    ->orWhere('genre', 'like', "%{$request->keyword}%")
                    ->orWhere('type', 'like', "%{$request->keyword}%");
            })->paginate(50);
        return view('user.search', compact('search','query'));
        }
    
    public function more(Request $request){
        if($request->is('anime/more/tv'))
        {
            $anime = DB::table('animes')->where('type','tv')->paginate(12);
            return view('user.more', compact('anime'));
        }
        else if($request->is('anime/more/movie'))
        {
            $anime = DB::table('animes')->where('type','movie')->paginate(12);
            return view('user.more', compact('anime'));
        }
        else if($request->is('anime/more/ova'))
        {
            $anime = DB::table('animes')->where('type','ova')->paginate(12);
            return view('user.more', compact('anime'));
        }
        else if($request->is('anime/more/asc'))
        {
            $anime = DB::table('animes')->orderBy('title','asc')->paginate(12);
            return view('user.more', compact('anime'));
        }
        else if($request->is('anime/more/desc')){
            $anime = DB::table('animes')->orderBy('title','desc')->paginate(12);
            return view('user.more', compact('anime'));
        }
        else if($request->is('anime/more/rating')){
            $anime = DB::select("select s.id,s.title,s.members,s.img_url,s.type,s.episode,s.genre, ROUND(avg(r.rating),2) as rating
                from animes s 
                left join ratings r on s.id = r.anime_id 
                group by s.id, s.title,s.members,s.img_url,s.type,s.episode,s.genre
                order by rating desc");
            return view('user.rating', compact('anime'));
        }
        else if($request->is('anime/more/members')){
            $anime = DB::table('animes')->orderBy('members','desc')->paginate(12);
            return view('user.more', compact('anime'));
        }
    }
}
