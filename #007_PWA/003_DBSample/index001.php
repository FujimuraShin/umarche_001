<?php

if(isset($_POST['name'])){
    $name=htmlspecialchars($_POST['name']);
    //echo $name."<br>";
}

if(isset($_POST['mail'])){
    $address=htmlspecialchars($_POST['mail']);
    //echo $address;
}

//変数の初期化＆日時の取得
//DB情報の登録
date_default_timezone_set('Asia/Tokyo');
$now_datetime=date('Y-m-d H:i:s');

$userName="azuredog88";
$pass="newyork25";

$db_handle=null;
$statement=null;
$result=null;

//PDOのインスタンスを生成し、DBに接続する
try{
    $db_handle=new PDO('mysql:host=mysql1035.db.sakura.ne.jp;dbname=azuredog88_mine_test001;charset=utf8',$userName,$pass);

}catch(PDOException $e){
    echo '接続エラー'.$e->getMessage();

if(isset($name)){
    //SQL作成
    $sql='INSERT INTO test001(name,address,create_at)VALUES(?,?,?)';

    //SQL実行準備
    $statement=$db_handle->prepare($sql);

    //値を渡して実行
    $result=$statement->execute(array(
        $name,
        $address,
        $now_datetime
    ));

    //DB接続を解除
    $statement=null;
    $db_handle=null;
}

///////////////////////////////////////////////////////////////////////////////////
//データベースの内容を取得する

//PDOのインスタンスを生成し、DBに接続する
try{
    $db_handle002=new PDO('mysql1035.db.sakura.ne.jp;dbname=azuredog88_mine_test001;charset=utf8',$userName,$pass);


}catch(PDOException $e){
    echo '接続エラー002'.$e->getMessage();
}

//SQL
$sql002='SELECT * FROM test001';

//SQL実行準備
$statement002=$db_handler002->prepare($sql002);

//値を渡して実行
$statement002->execute();

$result002=$statement002->fetchAll();

//var_dump($result002);

foreach($result002 as $value){
    $name_r[]=$value['name'];
    $address_r[]=$value['address'];
}
//var_dump($name_r);

//DB接続を解除
$statement002=null;
$db_handler002=null;


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mine DB Sample</title>
</head>
<body>
    <h1>データベースの登録</h1>
    <form action="" method="POST">
        <p>名前:<input type="text" name="name"></p>
        <p>メールアドレス:<input type="text" name="mail"></p>

        <input type="submit" value="データ登録">
    </form>

    <h1>データベース内容の表示</h1>
    <p>名前：
        <table border="1">
            <tr>
            <?php 
                if(isset($name_r)){
                    foreach($name_r as $value){
                        echo "<td>".$value."</td>";
                    }
                }
            ?>
            </tr>
        </table>
    </p>
    <p>メールアドレス:
        <table border="1">
            <tr>
            <?php 
                if(isset($address_r)){
                    foreach($address_r as $value){
                        echo "<td>".$value."</td>";
                    }
                }
               ?>
            </tr>
        </table>
    </p>

</body>
</html>