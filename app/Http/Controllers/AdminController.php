<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RealRashid\SweetAlert\Facades\Alert;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use DB;
use DataTables;
use App\User;
use App\Anime;
class AdminController extends Controller
{
	use AuthenticatesUsers;
    public function getLogin($guard = 'admin'){
        if(Auth::guard('admin')->check()){
    		return redirect()->route('dashboard');
    	}
        else{
            Alert::toast('Please Login !','info','top');
            return view('AuthAdmin.login'); 	
    	}
	}

    public function postLogin($guard = 'admin', Request $request){
    	$auth = Auth::guard($guard)->attempt([
    			'username' => $request->username,
    			'password' => $request->password,
    		]);
    	if($auth){
            Alert::toast('Welcome Back Admin !','info','top');
    		return redirect()->route('dashboard');
    	}
    	return view('AuthAdmin.login');   
    }

    public function logout(){
    	$auth = Auth::guard('admin')->logout();
        toast('Thank You, Have a nice day!','info','top');
    	return view('AuthAdmin.login');
    }
    
    public function dashboard(){
        $count_user = DB::table('users')->count();
        $count_anime = DB::table('animes')->count();
        $count_comment = DB::table('comments')->count();

        $user = $this->user_registered();
        $comment = $this->commented_anime();
        $anime = $this->anime();
    	return view('admin.index', compact('count_user','count_anime','count_comment','user','comment','anime'));
    }

    public function user_registered(){
        return $users = DB::select("select * from users limit 5");
    }

    public function commented_anime(){
        return $comment = DB::select("select comments.id, comments.comment, animes.title, users.username from comments 
                                        LEFT join animes on comments.anime_id = animes.id 
                                        LEFT join  users on comments.user_id = users.id 
                                        limit 5");
    }

    public function anime(){
        return $animes = DB::select("select a.id, a.title, a.type, a.episode, a.members, a.genre, round(avg(r.rating),2) as rating, 
                                        COUNT(f.user_id) as fav from animes a
                                        left join ratings r 
                                        on a.id = r.anime_id
                                        LEFT join favorites f
                                        on a.id = f.anime_id
                                        group by a.id, a.title, a.type, a.episode, a.members, a.genre 
                                        limit 5");
    }

    /* Users CRUD */
    public function getUsers(Request $request){
       if($request->isMethod('post')){
            $columns = array(
            0 => 'username',
            1 => 'email',
            2 => 'created_at',
            3 => 'action'
        );
        $totalData = User::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if(empty($request->input('search.value'))){
            $posts = User::offset($start)
                    ->limit($limit)
                    ->orderBy($order,$dir)
                    ->get();
            $totalFiltered = User::count();
        }else{
            $search = $request->input('search.value');
            $posts = User::select('id')->where('username', 'like', "%{$search}%")
                            ->orWhere('email','like',"%{$search}%")
                            ->orWhere('created_at','like',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order, $dir)
                            ->get();
            $totalFiltered = User::where('username', 'like', "%{$search}%")
                            ->orWhere('email','like',"%{$search}%")
                            ->orWhere('created_at','like',"%{$search}%")
                            ->count();
        }       
        $data = array();
        
        if($posts){
            foreach($posts as $r){
                $data1['username'] = $r->username;
                $data1['email'] = $r->email;
                $data1['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $data1['action'] = 
            '<a href="users/edit/'.$r->id.'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                
            <a href="users/delete/'.$r->id.'" onclick="return confirm()" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';
                $data[] = $data1;
            }
        }
        
        $json_data = array(
            "draw"          => intval($request->input('draw')),
            "recordsTotal"  => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"          => $data
        );
        return response()->json($json_data);
        }

    $chart = DB::select('select count(id) as total, month(created_at) as month from users GROUP by month');
    $bulan="bulan";
    $res[] = [$bulan,'total','month'];
    foreach ($chart as $key => $value) {
        if($value->month == 1){
            $bulan = "Januari";
        }
        else if($value->month == 2){
            $bulan = "Februari";
        }
        else if($value->month == 3){
            $bulan = "Maret";
        }
        else if($value->month == 4) {
            $bulan= "April";
        }
        else if($value->month == 5) {
            $bulan= "Mei";
        }
        else if($value->month == 6) {
            $bulan= "Juni";
        }
        else if($value->month == 7) {
            $bulan= "Juli";
        }
        else if($value->month == 8) {
            $bulan= "Agustus";
        }
        else if($value->month == 9) {
            $bulan= "September";
        }
        else if($value->month == 10) {
            $bulan= "Oktober";
        }
        else if($value->month == 11) {
            $bulan = "November";
        }
        else{
            $bulan = "Desember";
        }
        $res[] = [$bulan, $value->total,$value->month];
    }
    $js = json_encode($res);
    return view('admin.user',compact('js'));
    }

    public function deleteUser($id){
        $delete = User::find($id);
        $delete->favorite()->delete();
        $delete->comments()->delete();
        $delete->delete();
        Alert::toast('User Deleted','warning','top');
        return redirect()->route('dataProcessing');
    }

    public function editUser($id){
        $user = User::find($id);
        $user_comment = DB::table('comments')->where('id',$user);
        return view('admin.edit_users',compact('user', 'user_comment'));
    }

    public function updateUser(Request $request,$id){
        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        if($user->save()){
            Alert::toast('Update Success','success','top');
            return redirect()->back();
        }
        Alert::toast('Opps! Something Wrong..','warning','top');
        return redirect()->back();
    }

    /* Animes CRUD */

    public function getAnimes(Request $request){
        if($request->isMethod('post')){
             $columns = array(
                0 => 'title',
                1 => 'img_url',
                2 => 'type',
                3 => 'members',
                4 => 'genre',
                5 => 'action'
            );

            $totalData = Anime::count();
            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value'))){
                $animes = Anime::offset($start)->limit($limit)->orderBy($order,$dir)->get();
                $totalFiltered = Anime::count();
            }
            else{
                $search = $request->input('search.value');
                $animes = DB::table('animes')
                                ->where('title', 'like', "%{$search}%")
                                ->orWhere('img_url','like',"%{$search}%")
                                ->orWhere('type','like',"%{$search}%")
                                ->orWhere('members','like',"%{$search}%")
                                ->orWhere('genre','like',"%{$search}%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order, $dir)
                                ->get();
                // $animes = DB::select("select a.id, a.img_url,a.title, a.type, a.episode, a.members, a.genre, round(avg(r.rating),2) as rating 
                //                     from animes a 
                //                     left join ratings r 
                //                     on a.id = r.anime_id
                //                     WHERE a.title LIKE '%".$search."%'
                //                     OR
                //                     a.img_url LIKE '%".$search."%'
                //                     OR
                //                     a.type LIKE '%".$search."%'
                //                     OR
                //                     a.members LIKE '%".$search."%'
                //                     OR
                //                     a.genre LIKE '%".$search."%'
                //                     GROUP BY a.id, a.title, a.type, a.episode, a.members, a.genre
                //                     ORDER BY $order $dir
                //                     LIMIT $limit OFFSET $start");
                $totalFiltered = Anime::where('title', 'like', "%{$search}%")
                                ->orWhere('img_url','like',"%{$search}%")
                                ->orWhere('type','like',"%{$search}%")
                                ->orWhere('members','like',"%{$search}%")
                                ->orWhere('genre','like',"%{$search}%")
                                ->count();
            }

            $data = array();
            foreach ($animes as $key => $value) {
                $animes1['title'] = $value->title;
                $animes1['img_url'] ='<a href="'.$value->img_url.'" class="btn btn-sm btn-info" target="_blank" rel="noopener noreferrer">See Image <i class="fas fa-images"></i> </a>';
                $animes1['type'] = $value->type;  
                $animes1['members'] = $value->members;
                $animes1['genre'] = $value->genre;
                $animes1['action'] = 
'<a href="animes/edit/'.$value->id.'" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>                
<a href="animes/delete/'.$value->id.'" onclick="return confirm()" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>';

                $data[] = $animes1;
            }
            $json = array(
                "data"          => $data
            );
            return response()->json($json);
        }
        $anime_rating_chart = DB::select('select a.title as title, round(avg(r.rating),2) as rating from animes a
                                        right join ratings r 
                                        on a.id = r.anime_id
                                        group by a.id, a.title,a.members,a.img_url,a.type,a.episode,a.genre
                                        order by rating desc
                                        limit 3');
        $anime = "Animes";
        $chart[] = ['title','rating'];
        foreach ($anime_rating_chart as $key => $value) {
            $chart[] = [$value->title, (float)$value->rating];
        }
        $response = json_encode($chart);
        return view('admin.animes',compact('response'));
    }

    public function updateRecommendation(){
            $client = new Client();
            $response = $client->get('http://localhost/maanime/public/api/anime/prosesanime')->getBody()->getContents();
            dd($response);       
    }

    public function mae(){
        $users = User::orderBy('id','asc')->get();
        // $rerata_rating = [];
        // foreach($users as $u){
        //     $animes = Anime::orderBy('id','asc')->get();
        //     $temp=[];
        //     $nItem = count($animes);
        //     $rata = 0;
        //     foreach($animes as $a){
        //         $rating = Rating::where(['user_id'=>$u->id,'anime_id'=>$a->id])->get();
        //         $temp[] = count($rating)==0 ? 0 : $rating[0]->rating;
        //         if(count($rating) > 0){
        //             $total = (Rating::where(['user_id'=>$u->id,'anime_id'=>$a->id])->sum('rating'));
        //             $rerata_rating[] = ['anime_id'=>$a->id, 'user_id'=>$u->id, 'total_rating'=>$total, 'banyak_rating'=>count($rating)];
        //         } else {
        //             $rerata_rating[] = ['anime_id'=>$a->id, 'user_id'=>$u->id, 'total_rating'=>0, 'banyak_rating'=>0];
        //         } 
        //     }
        //     $F[]=$temp;
        // }

        // $rekomendasi = [];

        $animes = DB::table('recommendations')->get();
        $animes = $animes->toArray();

        // $real_mae = [];
        // foreach($rerata_rating as &$item){
        //     $search = array_search($item['anime_id'], array_column($animes, 'anime_id'));
        //     if($item['total_rating'] != 0){
        //         $real_mae[] = [
        //             "mae"=>(float)abs( ((float)$item['total_rating']/$item['banyak_rating']) - $animes[$search]->value ) / $item['banyak_rating'],
        //             "user_id" => $item['user_id']
        //         ];
        //     } 
        // }
        // dd($real_mae);


        $rating = DB::table('ratings')->get();
        
        $total = [];
        foreach($users as $user){
            $eam = [];
            foreach($rating as $item){
                if($item->user_id == $user->id){
                    $search = array_search($item->anime_id, array_column($animes, 'anime_id'));
                    $jumlahData = DB::table('ratings')->where('user_id',$user->id)->count();
                    $eam[] = [
                        'mae' => (float)abs($item->rating - $animes[$search]->value) / $jumlahData,
                        'user_id' => $user->id,
                        'anime_id' => $animes[$search]->anime_id
                    ];

                }
            }
            if(count($eam)>0){
                $total[] = $eam;
            }
        }
        
        $hasil = [];
        foreach($total as $item){
            $counter = 0;
            foreach($item as $x){
                $counter += $x['mae'];
            }
            $hasil[] = [
                'user_id' => $item[0]['user_id'],
                'rata_error' => (float)$counter/count($item)
            ];
        }

        dd($total,$hasil);
    }

    public function getCommentsJson(){
        $komentar = DB::table('comments')->join('users','comments.user_id','=','users.id')
                                         ->join('animes','comments.anime_id','=','animes.id')
                                         ->select('comments.id','users.username','animes.title','comment');
        return DataTables::of($komentar)->addColumn('action',function($comments){
            return '<a href="datakomentar/delete/'.$comments->id.'" onclick="return confirm()" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>';
        })->make(true);
    }

    public function getComments(){
        return view('admin.comments');
    }

    public function getRecommendationJson(){
        $anime = DB::select("select s.id,s.title,s.members,s.type,s.episode,s.genre, rm.value, ROUND(avg(r.rating),2) as rating
        from animes s 
        left join ratings r on s.id = r.anime_id 
        left join recommendations rm on rm.anime_id = s.id 
        group by s.id, s.title,s.members,s.type,s.episode,s.genre,rm.value
        order by value DESC");

        return DataTables::of($anime)->make();
    }

    public function getRecommendation(){
        return view('admin.recommendation');
    }

    public function recommendation(){
        $client = new Client();
        $response = $client->get('http://localhost/maanime/public/api/prosesanime');
        return redirect()->back();
    }
}
