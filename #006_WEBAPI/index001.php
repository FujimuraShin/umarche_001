<?php

$host="mysql:host=127.0.0.1;dbname=test;charset=utf8";
$username="root";
$pass="";

//PDOインスタンスの生成、DBに接続
try{
    $db=new PDO($host,$username,$pass);
}catch(PDOException $e){
    echo "接続エラー：".$e->getMessage();
}

$name="次郎";
$age=56;
$today=date("Y-m-d H:i:s");


//INSERT
//$sql="INSERT INTO mine_test(name,age,create_at)values(?,?,?);";

//SQL実行準備
$statement=$db->prepare($sql);

//SQL実行
$result=$statement->execute(array(
    $name,
    $age,
    $today
));

//DB接続の解除
//$statement=null;
//$db=null;

//SELECE


try{
$sql="SELECT * FROM mine_test;";

//SQL実行
$res=$db->query($sql);

    //取得したデータを表示
    foreach($res as $value){
        $nameArr[]=$value[name];
        $ageArr[]=$value[age];
        echo "$value[name]<br>";
    }

}catch(PDOException $e){
    echo $e->getMessage();
    die();
}

$db=null;

//var_dump($nameArr);
//var_dump($ageArr);

//連想配列を作成する処理
//https://hirashimatakumi.com/blog/3016.html
for($i=0;$i<count($nameArr);$i++){
    //$rensou['name']=$rensou['name']+$nameArr[$i];
    //$rensou['age']=$rensou['age']+$ageArr[$i];
    $rensou[$i]=array(
        'name'=>$nameArr[$i],
        'age'=>$ageArr[$i],
    );
}


//var_dump($rensou);

$json=json_encode($rensou);

var_dump($json);

?>


<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>WEBAPI_001</title>
</head>
<body>
    <h1>WEBAPI_001</h1>




</body>
</html>