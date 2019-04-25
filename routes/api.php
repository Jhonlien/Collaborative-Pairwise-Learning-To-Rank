<?php

use Illuminate\Http\Request;
use App\User;
use App\Anime;
use App\Favorite;
use App\Comment;
use App\Rating;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login',function(Request $request){

    $check = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    $response = new stdClass;
    if ($check) {
        $data = User::where('email','=',$request->email)->first();
        $response->data = $data;
        $response->error = 0;     
        $response->message = "Berhasil Login";
    }else{
        $response->message = "Username atau Password Salah";
        $response->error = 1;
    }
    return json_encode($response);
});
Route::post('register',function(Request $request){
    $validator = Validator::make($request->all(), [ 
        'username' => 'required', 
        'email' => 'required|email', 
        'password' => 'required', 
        'c_password' => 'required|same:password', 
    ]);
    $response = new stdClass;
    $response->error = 0;    
    $response->message = '';    

    if ($validator->fails()) { 
        $response->message = $validator->errors();
        $response->error = 1;
    }else{
        $check = User::where('username',$request->username)->first();
        if(empty($check)){
            $user =User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]); 
            $response->data = $check;
            $response->message ="Berhasil daftar silahkan login";
        }else{
            $response->error=1;
            $response->message="Username sudah digunakan";
        }

    }
    return json_encode($response);
});
Route::get('getFavorit/{userid}',function($user_id){
    $anime = DB::table('favorites')
            ->join('animes', 'animes.id', '=', 'favorites.anime_id')
            ->where('favorites.user_id',$user_id)
            ->select('animes.*')
            ->get();
    foreach($anime as $a){
        $a->rating = round(Rating::all()->where('anime_id',$a->id)->avg('rating'),2);
    }
    $response = new stdClass;
    $response->error = 0;
    $response->data = $anime;    
    return json_encode($response);
});
Route::post('favorit',function(Request $request){
    $anime = Anime::find($request->id);
    $userId = $request->user_id;
    $response = new stdClass;
    $response->error = 0;
    $response->message='';
    if(!empty($anime)){
        $check = Favorite::where('anime_id',$request->id)->where('user_id',$userId);
        if($check->count()==0){
            Favorite::create([
                'user_id'=>$userId,
                'anime_id'=>$request->id
            ]);
            $response->message= 'Berhasil ditambahkan ke favorite';
        }else{
            $error=1;
            $response->message= 'Anime sudah ada difavorite';
        }

    }else{
        $response->error = 1;
        $response->message = 'Anime tidak ditemukan';
    }
    return json_encode($response);
});
Route::post('rating',function(Request $request){
    $anime = Anime::find($request->id);
    $userId = $request->user_id;
    $response = new stdClass;
    $response->error = 0;
    $response->message='';
    if(!empty($anime)){
        Rating::create([
            'user_id'=>$userId,
            'anime_id'=>$request->id,
            'rating'=>$request->rating
        ]);
        $response->message= 'Berhasil memberikan rating';
    }else{
        $response->error = 1;
        $response->message = 'Anime tidak ditemukan';       
    }
    return json_encode($response);
});

Route::post('comment',function(Request $request){
    $anime = Anime::find($request->anime_id);
    $userId = $request->user_id;
    $response = new stdClass;
    $response->error = 0;
    $response->message='';
    if(!empty($anime)){
        Comment::create([
            'user_id'=>$userId,
            'anime_id'=>$request->anime_id,
            'comment'=>$request->comment
        ]);
        $response->message= 'Berhasil tambah comment';
    }else{
        $response->error = 1;
        $response->message = 'Anime tidak ditemukan';
    }
    return json_encode($response);
});
Route::get('getComment/{animeid}',function($anime_id){
    $comment = Comment::where('anime_id',$anime_id)->get();
    $comment =  DB::table('comments')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->where('comments.anime_id',$anime_id)
            ->select('comments.*','users.username')
            ->get();
    $response = new stdClass;
    $response->data= $comment;
    return json_encode($response);
});
Route::get('animeDetail/{animeid}',function($anime_id){
    $anime = Anime::where('id',$anime_id)->first();
    $response = new stdClass;
    $data = DB::table('ratings')->where('anime_id',$anime->id)->avg('rating');
    $anime->rating = round($data);
    $response->data= $anime;
    return json_encode($response);

});

Route::post('add/anime',function(Request $request){
    $response = new stdClass;
    $response->error = 0;
    $response->message='';
    $post = Anime::create([
                    'title'     => $request->title,
                    'img_url'   => $request->img_url,
                    'type'      => $request->type,
                    'episode'   => $request->episode,
                    'members'   => $request->members,
                    'genre'     => $request->genre,
                    'publish'   => $request->publish
    ]);
    if($post){
        $response->message='Berhasil tambah anime';
    }
    else{
        $response->error = 1;
        $response->message = 'Gagal Menambahkan Anime';
    }
    return json_encode($response);    
});

function transpose($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}

function randomData($x,$y){
    $all=[];
    for($i=0;$i<$x;$i++){
        $temp = [];
        for($j=0;$j<$y;$j++){
            $temp[] = rand(0, 10) / 10;
        }
        $all[] = $temp;
    }   
    return $all;
}
function randomVektor($n){
    $temp=[];
    for($i=0;$i<$n;$i++){
        $temp[] = rand(0,10)/10;
    }
    return $temp;
}
function findSimilar($a,$b,$F){
    // global $F;
    $atas = 0;
    $bawah=0;
    for($i=0;$i<count($F[$a]);$i++){
        $atas += ($F[$a][$i]*$F[$b][$i]);
    }
    $bawah = findBawahSimilar($a,$F)*findBawahSimilar($b,$F);
    if($bawah==0){
        return 0;
    }
    return $atas/$bawah;
}

function findBawahSimilar($u,$F){
    // global $F;
    $total = 0;
    for($i=0;$i<count($F[$u]);$i++){
        $total += pow($F[$u][$i],2);
    }
    return sqrt($total);
}
function findTetangga($id,$similarUser){
    // global $similarUser;
    $tetangga = [];
    $dia = $similarUser[$id];
    $nBesar = $dia[$id];
    asort($dia);
    $i=0;
    foreach($dia as $key => $value){
        if($i>count($dia)-2){
            $tetangga[] = $key;
        }
        else if($i==count($dia)-2){
            $temp = array_search($dia[$key],$dia);
            if($temp<$key)
                $tetangga[] = $temp;
            else
                $tetangga[] = $key;
        }
        $i++;
    }
    return $tetangga;
}
function findP($id,$F){
    // global $F;
    $temp = [];
    for($i=0;$i<count($F[$id]);$i++){
        if($F[$id][$i]>0){
            $temp[] = $i;
        }
    }
    return $temp;
}
function findC($id,$F,$similarUser){
    // global $F;
    $tetangga   = findTetangga($id, $similarUser);
    $tempA      = findP($tetangga[0],$F);
    $tempB      = findP($tetangga[1],$F);
    $temp       = findP($id,$F);
    $result     = array_diff($tempA, $temp);
    $temp       = array_merge($temp,$result);
    $result2    = array_diff($tempB,$temp);
    $result     = array_merge($result,$result2);
    return $result;
}
function findL($id,$F,$nItem,$similarUser){
    // global $F,$nItem;
    $result=[];
    $temp  = array_merge(findP($id,$F),findC($id,$F,$similarUser));
    for($i=0;$i<$nItem;$i++){
        $result[] = $i;     
    }
    $result = array_diff($result,$temp);
    $result = array_values($result);
    return $result;
}
function findSui($user,$itemAcakP,$similarUser,$F){
    $total=0;
    $tetangga = findTetangga($user,$similarUser);
    for($i=0;$i<count($tetangga);$i++){
        $nilai=in_array($itemAcakP,findP($tetangga[$i],$F)) ?  1 : 0;
        $total += $similarUser[$user][$tetangga[$i]]*$nilai;
    }
    return $total;  
}
function findSut($user,$itemAcakC,$similarUser,$F){
    $total=0;
    $tetangga = findTetangga($user,$similarUser);
    for($i=0;$i<count($tetangga);$i++){
        $nilai=in_array($itemAcakC,findP($tetangga[$i],$F)) ? 1 : 0;
        $total += $similarUser[$user][$tetangga[$i]] * $nilai;
    }
    return $total;      
}
function findCuit($Sui,$Sut){
    return ( 1 + $Sui )/( 1 + $Sut);
}
function findRui($d,$u,$W,$Vt,$B,$itemAcakP){
    $total=0;
    for($i=0;$i<$d;$i++){
        $total += ($W[$u][$i]*$Vt[$itemAcakP][$i]);
    }
    return $total+$B[$itemAcakP];
}

function findRut($d,$u,$W,$Vt,$B,$itemAcakC){
    $total=0;
    for($i=0;$i<$d;$i++){
        $total += ($W[$u][$i]*$Vt[$itemAcakC][$i]);
    }
    return $total+$B[$itemAcakC];
}
function findRuj($d,$u,$W,$Vt,$B,$itemAcakL){
    $total=0;
    for($i=0;$i<$d;$i++){
        $total += ($W[$u][$i]*$Vt[$itemAcakL][$i]);
    }
    return $total+$B[$itemAcakL];
}


Route::get('prosesanime',function(){
    DB::table('recommendations')->truncate();
    $F      = [];
    $animes = [];
    $users  = User::orderBy('id','asc')->get();
    foreach($users as $u){
        $animes = Anime::orderBy('id','asc')->get();
        $temp   =[];
        $nItem  = count($animes);
        foreach($animes as $a){
            $rating = Rating::where(['user_id'=>$u->id,'anime_id'=>$a->id])->get();
            $temp[] = count($rating) == 0 ? 0 : $rating[0]->rating;
        }
        $F[]=$temp;
    }
    $nUser  = count($users);
    $k      = 2;
    $T      = 3;
    $d      = 2;
    $alpha  = 1;
    $B      = 1;
    $Y      = 1;
    $lambda = 0.01;
    $n      = 0.1;
    $W      = [];    
    $W      = randomData($nUser,$d);
    $V      = randomData($d,$nItem);
    $B      = randomVektor($nItem);
    $Vt     = transpose($V);
    
    $nSimilarUser=[];
    for($i=0;$i<$nUser;$i++){
        $temp=[];
        for($j=0;$j<$nUser;$j++){
            if($i!=$j){
                $temp[] = findSimilar($i,$j,$F);
            }else{
                $temp[]= 0;
            }
        }
        $similarUser[]= $temp;
    }
    $arrP=[];
    $arrC=[];
    $arrL=[];
    for($j=0;$j<$T;$j++){
        $userAcak = rand(0,$nUser-1);
        // echo $userAcak;
        $itemAcakP1 = findP($userAcak,$F);
        $itemAcakC1 = findC($userAcak,$F,$similarUser);
        $itemAcakL1 = findL($userAcak,$F,$nItem,$similarUser);
        // echo "<pre>";
        // print_r($itemAcakP1);
        // print_r($itemAcakC1);
        // print_r($itemAcakL1);
        // exit();
        // echo "</pre>";
        if(count($itemAcakP1)>0 and count($itemAcakC1)>0 and count($itemAcakL1)>0){

        }else{
            continue;
        }

        $itemAcakP = $itemAcakP1[rand(0,count($itemAcakP1)-1)];
        $itemAcakC = $itemAcakC1[rand(0,count($itemAcakC1)-1)];
        $itemAcakL = $itemAcakL1[rand(0,count($itemAcakL1)-1)];
        // echo $itemAcakP." ".$itemAcakC." ".$itemAcakL;
        // print_r());
        // print_r(findC($userAcak[$i]));
        // print_r(findL($userAcak[$i]));

        $Sui = findSui($userAcak,$itemAcakP,$similarUser,$F);
        $Sut = findSut($userAcak,$itemAcakC,$similarUser,$F);


        $Cuit = findCuit($Sui,$Sut);
        $Cutj = 1 + $Sut;
        $Cuij = 1 + $Sui;

        $Rui = findRui($d,$userAcak,$W,$Vt,$B,$itemAcakP);
        $Rut = findRut($d,$userAcak,$W,$Vt,$B,$itemAcakC);
        $Ruj = findRuj($d,$userAcak,$W,$Vt,$B,$itemAcakL);

        $Ruit = $Cuit*($Rui-$Rut);
        $Rutj = $Cutj*($Rut-$Ruj);
        $Ruij = $Cuij*($Rui-$Ruj);
        // echo $Sui."<br>";
        // echo $Sut."<br>";
        // echo $Cuit." ".$Cutj." ".$Cuij." ".$Rui." ".$Rut." ".$Ruj;
        // echo "<br>".$Ruit." ".$Rutj." ".$Ruij;
        // Perolehan nilai gradien untuk Matriks W
        $W1=[];
        for($i=0;$i<$d;$i++){
            $W1[] = (((1*$Cuit)/(1 + pow(exp(1),$Ruit))) * ($Vt[$itemAcakP][$i]-$Vt[$itemAcakC][$i])) + (((1*$Cutj)/(1+pow(exp(1),$Rutj)))*($Vt[$itemAcakC][$i]-$Vt[$itemAcakL][$i])) + (((1*$Cuij)/(1+pow(exp(1),$Ruij)))*($Vt[$itemAcakP][$i]-$Vt[$itemAcakL][$i])) - ($lambda * $W[$userAcak][$i]);
        }
        // print_r($W1);
        // Perolehan nilai gradien untuk matriks  untuk V.
        $V1=[];
        $V2=[];
        $V3=[];
        for($i=0;$i<$d;$i++){
            $V1[] = (((1*$Cuit)/(1+pow(exp(1),$Ruit)))*($W[$userAcak][$i]))  + (((1*$Cuij)/(1+pow(exp(1),$Ruij)))*($W[$userAcak][$i])) - ($lambda*$Vt[$itemAcakP][$i]);
        }
        for($i=0;$i<$d;$i++){
            $V2[] = (((1*$Cuit)/(1+pow(exp(1),$Ruit)))*(-1*$W[$userAcak][$i]))  + (((1*$Cutj)/(1+pow(exp(1),$Rutj)))*($W[$userAcak][$i])) - ($lambda*$Vt[$itemAcakC][$i]);
        }
        for($i=0;$i<$d;$i++){
            $V3[] = (((1*$Cutj)/(1+pow(exp(1),$Rutj)))*(-1*$W[$userAcak][$i]))  + (((1*$Cuij)/(1+pow(exp(1),$Ruij)))*(-1*$W[$userAcak][$i])) - ($lambda*$Vt[$itemAcakL][$i]);
        }
        // print_r($V1);
        // print_r($V2);
        // print_r($V3);
        $B1     = [];
        $B2     = [];
        $B3     = [];
        $B1[] = ((1*$Cuit)/(1+pow(exp(1),$Ruit)))  + ((1*$Cuij)/(1+pow(exp(1),$Ruij))) - ($lambda*$B[$itemAcakP]);
        $B2[] = ((1*$Cuit)/(1+pow(exp(1),$Ruit)))*(-1)  + ((1*$Cutj)/(1+pow(exp(1),$Rutj))) - ($lambda*$B[$itemAcakP]);
        $B3[] = ((1*$Cutj)/(1+pow(exp(1),$Rutj)))*(-1)  + ((1*$Cuij)/(1+pow(exp(1),$Ruij)))*(-1) - ($lambda*$B[$itemAcakP]);
        // print_r($B1);
        // print_r($B2);
        // print_r($B3);

        // pembaruan nilai pada matriks Wuf
        $WBaru = [];
        for($i=0;$i<$d;$i++){
            $WBaru[] = $W[$userAcak][$i] + ($n*$W1[$i]);
        }
        // print_r($WBaru);
        $VBaru    = [];
        $V2Baru   =[];
        $V3Baru   = [];
        for($i=0;$i<$d;$i++){
            $VBaru[] = $Vt[$itemAcakP][$i]+($n*$V1[$i]);
        }
        for($i=0;$i<$d;$i++){
            $V2Baru[] = $Vt[$itemAcakC][$i]+($n*$V2[$i]);
        }
        for($i=0;$i<$d;$i++){
            $V3Baru[] = $Vt[$itemAcakL][$i]+($n*$V3[$i]);
        }
        // print_r($VBaru);
        // print_r($V2Baru);
        // print_r($V3Baru);
        //pembaharuan nilai b
        $B1Baru   =[];
        $B2Baru   =[];
        $B3Baru   =[];
        $B1Baru[] = $B[$itemAcakP] + ($n*$B1[0]);
        $B2Baru[] = $B[$itemAcakC] + ($n*$B2[0]);
        $B3Baru[] = $B[$itemAcakL] + ($n*$B3[0]);
        // print_r($B1Baru);
        // print_r($B2Baru);
        // print_r($B3Baru);

        for($i=0;$i<$d;$i++){
            $W[$userAcak][$i]   = $WBaru[$i];
            $Vt[$itemAcakP][$i] = $VBaru[$i];
            $Vt[$itemAcakC][$i] = $V2Baru[$i];
            $Vt[$itemAcakL][$i] = $V3Baru[$i];
        }
        $B[$itemAcakP] = $B1Baru[0];
        $B[$itemAcakC] = $B2Baru[0];
        $B[$itemAcakL] = $B3Baru[0];
        // echo "Iterasi ke - ".($j+1)." <br><br><br>";
        // print_r($W);
        // print_r($Vt);
        // print_r($B);
        // exit();
    }
    
    $hasil=[];
    $total=1;
    for($x=0;$x<$nUser;$x++)
    {

        for($y=0;$y<$nItem;$y++)
        {
            $hasil[$x][$y] = ($W[$x][0] * $Vt[$y][0]) + ($W[$x][1] * $Vt[$y][1]) + $B[$y];
        }

    }
    // echo "<br>Hasil<br><pre>";
    // print_r(transpose($hasil));
    // echo "</pre>";
    $hasil      = transpose($hasil);
    $maxHasil   = [];

    for($i=0;$i<count($hasil);$i++){
        $maxHasil[] = max($hasil[$i]);
    }
    // echo "<pre>";
    // print_r($F);
    // arsort($maxHasil);
    $index=0;
    foreach($animes as $a){
        $a->nilai = $maxHasil[$index];
        $values = array('anime_id' => $a->id,'value' => $a->nilai);
        DB::table('recommendations')->insert($values);
        $index++;
    }
    // $animes = $animes->toArray();
    // usort($animes, function($a, $b)
    // {
    //     return strcmp($b['nilai'], $a['nilai']);
    // });
    // $animes=array_slice($animes, 0, $limit);
    // $time_end = microtime(true);

    //dividing with 60 will give the execution time in minutes other wise seconds
    // $execution_time = ($time_end - $time_start)/60;

    $response = new stdClass;
    $response->error = 0;
    $response->message = "Berhasil diproses";
    // $response->data = $animes;
    // $response->waktu = $execution_time * 60;   
    // print_r($animes);
    // echo "</pre>";
    return json_encode($response);
});

Route::get('anime/rekomendasi/{limit?}/{query?}',function($limit=5,$query=""){
    $limit==null?5:$limit;
    $limit=$limit==null?5:$limit;
    $anime = DB::select("select s.id,s.title,s.members,s.img_url,s.type,s.episode,s.genre, rm.value, ROUND(avg(r.rating),2) as rating
        from animes s 
        left join ratings r on s.id = r.anime_id 
        left join recommendations rm on rm.anime_id = s.id 
        where s.title like '%".$query."%'
        group by s.id, s.title,s.members,s.img_url,s.type,s.episode,s.genre,rm.value
        order by rm.value desc limit $limit");
    $response = new stdClass;
    $response->error = 0;
    $response->data = $anime;
    return json_encode($response);
});

Route::get('mae', function()
{
    // $F=[];
    // $animes=[];
    
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
    $users = User::orderBy('id','asc')->get();
    $animes = DB::table('recommendations')->get();
    $animes = $animes->toArray();
    $rating = DB::table('ratings')->get();
    
    $total = [];
    foreach($users as $user){
        $eam = [];
        foreach($rating as $item){
            if($item->user_id == $user->id){ //if found
                $search = array_search($item->anime_id, array_column($animes, 'anime_id')); // ex : 1
                $jumlahData = DB::table('ratings')->where('user_id',$user->id)->count(); //ex : 1
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
        foreach($item as $mae){
            $counter += $mae['mae'];
        }
        $hasil[] = [
            'user_id' => $item[0]['user_id'],
            'rata_error' => (float)$counter/count($item)
        ];
    }

    $pen = 0;
    foreach($hasil as $done){
        $pen += $done['rata_error'];
    }
    $has = $pen/count($hasil);
    // dd($total,$hasil);
    $response = new stdClass;
    $response->total = $total;
    $response->hasil = $hasil; 
    $response->has = $has; 
    $response->message = "Berhasil diproses";

    return json_encode($response);

});