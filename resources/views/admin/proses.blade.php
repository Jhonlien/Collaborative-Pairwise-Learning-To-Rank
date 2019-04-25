@extends('master.master_admin')
@section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">
<div class="row">
        <div class="col-xl-11 mb-5 mb-xl-0">
            <div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style=""><i>Proses Training</i></h4>
                  <h4 style=""><i>Ditetapkan selama 3x iterasi. Tiap iterasi dilakukan pembaruan nilai pada matriks W,V, dan vektor b.</i></h4>
                </div>
              </div>
            </div>
<?php
$nUser = 5;
$nItem = 4;
$F = [
        [0,4,0,2],
        [0,5,4,0],
        [0,2,2,0],
        [2,0,3,3],
        [0,4,0,2]
    ];
// echo "<h4>Tabel Rating</h4>
// <div class=\"table-responsive\">
//              <table id=\"data-komen\" class=\"table\">
//                 <thead class=\"thead-light\">
//                         <tr>
//                             <th scope=\"col\">User/Item</th>
//                             <th scope=\"col\">Anime 1</th>
//                             <th scope=\"col\">Anime 2</th>
//                             <th scope=\"col\">Anime 3</th>
//                             <th scope=\"col\">Anime 4</th>
//                         </tr>
//                 </thead>
//                 <tbody>";

// $userF = $F[0][0];
// $userF1 = $F[0][1];
// $userF2 = $F[0][2];
// $userF3 = $F[0][3];

// $userF11 = $F[1][0];
// $userF12 = $F[1][1];
// $userF13 = $F[1][2];
// $userF14 = $F[1][3];


// $userF21 = $F[2][0];
// $userF22 = $F[2][1];
// $userF23 = $F[2][2];
// $userF24 = $F[2][3];


// $userF31 = $F[3][0];
// $userF32 = $F[3][1];
// $userF33 = $F[3][2];
// $userF34 = $F[3][3];

// $userF31 = $F[3][0];
// $userF32 = $F[3][1];
// $userF33 = $F[3][2];
// $userF34 = $F[3][3];

// echo "<tr>";

// echo "<td scope=\"col\"> User 1 </td>
//       <td scope=\"col\"> $userF </td>
//       <td scope=\"col\"> $userF1 </td>
//       <td scope=\"col\"> $userF2 </td>
//       <td scope=\"col\"> $userF3 </td>";
// echo "</tr>";
// echo "<td scope=\"col\"> User 2 </td>
//       <td scope=\"col\"> $userF11 </td>
//       <td scope=\"col\"> $userF12 </td>
//       <td scope=\"col\"> $userF13 </td>
//       <td scope=\"col\"> $userF14 </td>";
// echo "</tr>";
// echo "<td scope=\"col\"> User 3 </td>
//       <td scope=\"col\"> $userF </td>
//       <td scope=\"col\"> $userF1 </td>
//       <td scope=\"col\"> $userF2 </td>
//       <td scope=\"col\"> $userF3 </td>";
// echo "</tr>";
// echo "</tbody>";
$k=2;
$T=3;
$d=2;
$alpha = 1;
$lambda = 0.01;
$B=1;
$Y = 1;
$N = 0.01;
$n=0.1;
$W = [];

$W = [[0.3,0.5],[0.6,0.2],[0.1,1],[0.3,0.1],[0.5,0.4]];
$V = [[0.2,0.4,0.3,0.4],[0.6,0.3,0.5,0]];
$Vt = [[0.2,0.6],[0.4,0.3],[0.3,0.5],[0.4,0]];
$B = [1,0.4,0.1,0.2];


$nSimilarUser=[];
    for($i=0;$i<$nUser;$i++){
        $temp=[];
        for($j=0;$j<$nUser;$j++){
            if($i!=$j){
                $temp[] = findSimilar1($i,$j,$F);
            }else{
                $temp[]= 0;
            }
        }
        $similarUser[]= $temp;
    }
$user1 = $similarUser[0][0];
$user12 = $similarUser[0][1];
$user13 = $similarUser[0][2];
$user14 = $similarUser[0][3];
$user15 = $similarUser[0][4];

$user2 = $similarUser[1][0];
$user22 = $similarUser[1][1];
$user23 = $similarUser[1][2];
$user24 = $similarUser[1][3];
$user25 = $similarUser[1][4];

$user3 = $similarUser[2][0];
$user32 = $similarUser[2][1];
$user33 = $similarUser[2][2];
$user34 = $similarUser[2][3];
$user35 = $similarUser[2][4];

$user4 = $similarUser[3][0];
$user42 = $similarUser[3][1];
$user43 = $similarUser[3][2];
$user44 = $similarUser[3][3];
$user45 = $similarUser[3][4];

$user5 = $similarUser[4][0];
$user52 = $similarUser[4][1];
$user53 = $similarUser[4][2];
$user54 = $similarUser[4][3];
$user55 = $similarUser[4][4];

//print_r($similarUser);
echo "<h4> Similarity User</h4>
<div class=\"table-responsive\">
             <table id=\"data-komen\" class=\"table\">
                <thead class=\"thead-light\">
                        <tr>
                            <th scope=\"col\">User 1</th>
                            <th scope=\"col\">User 2</th>
                            <th scope=\"col\">User 3</th>
                            <th scope=\"col\">User 4</th>
                            <th scope=\"col\">User 5</th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                            <td scope=\"col\">$user1</td>
                            <td scope=\"col\">$user12</td>
                            <td scope=\"col\">$user13</td>
                            <td scope=\"col\">$user14</td>
                            <td scope=\"col\">$user15</td>
                    </tr>
                     <tr>
                            <td scope=\"col\">$user2</td>
                            <td scope=\"col\">$user22</td>
                            <td scope=\"col\">$user23</td>
                            <td scope=\"col\">$user24</td>
                            <td scope=\"col\">$user25</td>
                    </tr>
                       <tr>
                            <td scope=\"col\">$user3</td>
                            <td scope=\"col\">$user32</td>
                            <td scope=\"col\">$user33</td>
                            <td scope=\"col\">$user34</td>
                            <td scope=\"col\">$user35</td>
                    </tr>
                       <tr>
                            <td scope=\"col\">$user4</td>
                            <td scope=\"col\">$user42</td>
                            <td scope=\"col\">$user43</td>
                            <td scope=\"col\">$user44</td>
                            <td scope=\"col\">$user45</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$user5</td>
                            <td scope=\"col\">$user52</td>
                            <td scope=\"col\">$user53</td>
                            <td scope=\"col\">$user54</td>
                            <td scope=\"col\">$user55</td>
                    </tr>
                </tbody></table> </div>
                ";
//print_r($similarUser[0][2]);
function transpose1($array) {
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}
function findSimilar1($a,$b,$F){
    // global $F;
    $atas = 0;
    $bawah=0;
    for($i=0;$i<count($F[$a]);$i++){
        $atas += ($F[$a][$i]*$F[$b][$i]);
    }
    $bawah = findBawahSimilar1($a,$F)*findBawahSimilar1($b,$F);
    if($bawah==0){
        return 0;
    }
    return $atas/$bawah;
}

function findBawahSimilar1($u,$F){
    // global $F;
    $total = 0;
    for($i=0;$i<count($F[$u]);$i++){
        $total += pow($F[$u][$i],2);
    }
    return sqrt($total);
}
function findTetangga1($id,$similarUser){
    //global $similarUser;
    $tetangga = [];
    $dia = [];
    $dia[] = $similarUser[$id];
    //$nBesar = (array)$dia[$id];
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

function findP1($id,$F){
    //global $F;
    $temp = [];
    $F = [];
    for($i=0;$i<count((array)$F[$id]);$i++){
        if($F[$id][$i]>0){
            $temp[] = $i;
        }
    }
    return $temp;
}
function findC1($id,$F,$similarUser){
    //global $F;
    $tetangga   = findTetangga1($id, $similarUser);
    $tempA      = findP1((array)$tetangga[0],$F);
    $tempB      = findP1((array)$tetangga[1],$F);
    $temp       = findP1((array)$id,$F);
    $result     = array_diff($tempA, $temp);
    $temp       = array_merge($temp,$result);
    $result2    = array_diff($tempB,$temp);
    $result     = array_merge($result,$result2);
    return $result;
}
function findL1($id,$F,$nItem,$similarUser){
    // global $F,$nItem;
    $result=[];
    $temp  = array_merge(findP1($id,$F),findC1($id,$F,$similarUser));
    for($i=0;$i<$nItem;$i++){
        $result[] = $i;     
    }
    $result = array_diff($result,$temp);
    $result = array_values($result);
    return $result;
}
function findSui1($user,$itemAcakP,$similarUser,$F){
    $total=0;
    $tetangga = findTetangga1($user,$similarUser);
    for($i=0;$i<count($tetangga);$i++){
        $nilai=in_array($itemAcakP,findP1($tetangga[$i],$F)) ?  1 : 0;
        $total += $similarUser[$user][$tetangga[$i]]*$nilai;
    }
    return $total;  
}
function findSut1($user,$itemAcakC,$similarUser,$F){
    $total=0;
    $tetangga = findTetangga1($user,$similarUser);
    for($i=0;$i<count($tetangga);$i++){
        $nilai=in_array($itemAcakC,findP1($tetangga[$i],$F)) ? 1 : 0;
        $total += $similarUser[$user][$tetangga[$i]] * $nilai;
    }
    return $total;      
}
function findCuit1($Sui,$Sut){
    return ( 1 + $Sui )/( 1 + $Sut);
}
function findRui1($d,$u,$W,$Vt,$B,$itemAcakP){
    $total=0;
    for($i=0;$i<$d;$i++){
        $total += ($W[$u][$i]*$Vt[$itemAcakP][$i]);
    }
    return $total+$B[$itemAcakP];
}

function findRut1($d,$u,$W,$Vt,$B,$itemAcakC){
    $total=0;
    for($i=0;$i<$d;$i++){
        $total += ($W[$u][$i]*$Vt[$itemAcakC][$i]);
    }
    return $total+$B[$itemAcakC];
}
function findRuj1($d,$u,$W,$Vt,$B,$itemAcakL){
    $total=0;
    for($i=0;$i<$d;$i++){
        $total += ($W[$u][$i]*$Vt[$itemAcakL][$i]);
    }
    return $total+$B[$itemAcakL];
}

// 1,3,0
// 1 3 3
// 3 1 2
// 0   0

$userAcak = [1,3,0];
$itemAcakP1=[1,3,3];
$itemAcakC1=[3,1,2];
$itemAcakL1=[0,0,0];
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
        //echo $itemAcakP." ".$itemAcakC." ".$itemAcakL;
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
    echo "<br><br><br> <b>Iterasi ke - ".($j+1)."/ Training</b> <br>";
    echo "Untuk Iterasi " .($j+1). " Pemilihan Secara Acak User terpilih User ID = ". $userAcak;
    
    echo "<br>Pemilihan Item secara Acak melalui Himpunan P = ".$userAcak." terpilih Anime ID = ".$itemAcakP;
    echo "<br>Pemilihan Item secara Acak melalui Himpunan C = ".$userAcak." terpilih Anime ID = ".$itemAcakC;
    echo "<br>Pemilihan Item secara Acak melalui Himpunan L = ".$userAcak." terpilih Anime ID = ".$itemAcakL;
    echo "<h4>W</h4>";
$w_0    = $W[0][0];
$w_01   = $W[0][1];

$w_1    = $W[1][0]; 
$w_11   = $W[1][1]; 

$w_2    = $W[2][0]; 
$w_21   = $W[2][1]; 


$w_3    = $W[3][0]; 
$w_31   = $W[3][1]; 

$w_4    = $W[4][0]; 
$w_41   = $W[4][1]; 

echo "
<div class=\"table-responsive\">
             <table id=\"data-komen\" class=\"table\">
                <thead class=\"thead-light\">
                        <tr>
                            <th scope=\"col\">W 1</th>
                            <th scope=\"col\">W 2</th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                            <td scope=\"col\">$w_0</td>
                            <td scope=\"col\">$w_01</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$w_1</td>
                            <td scope=\"col\">$w_11</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$w_2</td>
                            <td scope=\"col\">$w_21</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$w_3</td>
                            <td scope=\"col\">$w_31</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$w_4</td>
                            <td scope=\"col\">$w_41</td>
                    </tr>
                </tbody> </table> </div><br>
                ";
                echo "<h4>Vt</h4>";
$v_0    = $Vt[0][0];
$v_01   = $Vt[0][1];

$v_1    = $Vt[1][0]; 
$v_11   = $Vt[1][1]; 

$v_2    = $Vt[2][0]; 
$v_21   = $Vt[2][1]; 


$v_3    = $Vt[3][0]; 
$v_31   = $Vt[3][1]; 
echo "
<div class=\"table-responsive\">
             <table id=\"data-komen\" class=\"table\">
                <thead class=\"thead-light\">
                        <tr>
                            <th scope=\"col\">Vt 1</th>
                            <th scope=\"col\">Vt 2</th>
                        </tr>
                </thead>
                <tbody>
                    <tr>
                            <td scope=\"col\">$v_0</td>
                            <td scope=\"col\">$v_01</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$v_1</td>
                            <td scope=\"col\">$v_11</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$v_2</td>
                            <td scope=\"col\">$v_21</td>
                    </tr>
                    <tr>
                            <td scope=\"col\">$v_3</td>
                            <td scope=\"col\">$v_31</td>
                    </tr>
                </tbody> </table> </div>
                ";

echo "<h4>B</h4>
<div class=\"table-responsive\">
             <table id=\"data-komen\" class=\"table\">
                <thead class=\"thead-light\">
                        <tr>
                            <th scope=\"col\">B</th>
                        </tr>
                </thead>
                <tbody>";
for ($i=0; $i < count($B) ; $i++) { 
    $data = $B[$i];
    echo "<tr> 
            <td>$data<td>
    </tr>";
}

echo "</tbody> </table> </div>";
  
}


   
$hasil=[];
$total=1;
for($x=0;$x<$nUser;$x++){
    for($y=0;$y<$nItem;$y++){
        $hasil[$x][$y] = ($W[$x][0]*$Vt[$y][0])+($W[$x][1]*$Vt[$y][1])+$B[$y];
    }
}

$hasil      = transpose1($hasil);
$maxHasil   = [];

for($i=0;$i<count($hasil);$i++){
    $maxHasil[] = max($hasil[$i]);
}

//print_r($hasil);
echo "<br><br><h4>Hasil Perhitungan Maximum WV + B</h4>
<div class=\"table-responsive\">
             <table id=\"data-komen\" class=\"table\">
                <thead class=\"thead-light\">
                        <tr>
                            <th scope=\"col\">Hasil Perhitungan WV + B</th>
                        </tr>
                </thead>
                <tbody>";
for ($i=0; $i <count($maxHasil); $i++) { 
    $data = $maxHasil[$i];
    echo "<tr> 
            <td>$data<td>
    </tr>";
}
?>

@endsection