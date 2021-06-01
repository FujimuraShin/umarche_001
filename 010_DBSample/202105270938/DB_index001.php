<?php

//◆◇◆◇◆◇◆
//変数の初期化＆日時の取得
date_default_timezone_set('Asia/Tokyo');
$now_datetime=date('Y-m-d H:i:s');
$db_handle=null;
$statement=null;
$result=null;

$userName="root";
$passWord="";

//◆◇◆◇◆◇◆◇◆◇
//バリデーション
$error=array();


//◆◇◆◇◆◇◆◇◆◇
//POST変数の受け取り＆バリデーション
if(isset($_POST['name'])){
    $name=htmlspecialchars($_POST['name']);
}

if(empty($_POST['name'])){
    $error[]="氏名を入力してください";
}

if(isset($_POST['mailAddress'])){
    $mailAddress=htmlspecialchars($_POST['mailAddress']);

    //半角入力で全角が入力されたらエラー
    /*
    if (!preg_match("/^[a-zA-Z0-9]+$/", $mailAddress)) {
        //echo "すべて半角英数である";
        $error[]="半角で入力してください";

    } 
    */

    // バリデーションに使う正規表現
    $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";

    if (!preg_match($pattern, $mailAddress ) ) {
        //echo "正しい形式のメールアドレスです。";
        $error[]="メールアドレス形式で入力してださい";
    } 

}

if(empty($_POST['mailAddress'])){
    $error[]="メールアドレスを入力してください";
}



if(isset($_POST['num'])){
    $num=htmlspecialchars($_POST['num']);
    //echo $num;
}



if(isset($_POST['target'])){
    $target=htmlspecialchars($_POST['target']);
    //echo "target=".$target."<br>";
}

if(isset($_POST['fname'])){
    $image=htmlspecialchars($_POST['fname']);
    echo "image=".$image."<br>";
}

if(isset($_POST['checkBox001'])){
    $chk001=htmlspecialchars($_POST['checkBox001']);
    //echo "chk001=".$chk001."<br>";
}

if(isset($_POST['checkBox002'])){
    $chk002=htmlspecialchars($_POST['checkBox002']);
    //echo "chk002=".$chk002."<br>";
}

if(isset($_POST['checkBox003'])){
    $chk003=htmlspecialchars($_POST['checkBox003']);
    //echo "chk003=".$chk003."<br>";
}

//◆◇◆◇◆◇◆◇◆◇
//errorがなければ機能を実行
if(empty($error)){

    //◆◇◆◇◆◇◆◇◆◇
    //画像アップロード作業
    $tempfile=$_FILES['fname']['tmp_name'];
    $filename='./image001/'.$_FILES['fname']['name'];


    if (is_uploaded_file($tempfile)) {
        if ( move_uploaded_file($tempfile , $filename )) {
        echo $filename . "をアップロードしました。";
        } else {
            echo "ファイルをアップロードできません。";
        }
    } else {
        $filename="Null";
        //echo "ファイルが選択されていません。";
    } 



    //テスト用インサート変数
    //$name="Null";
    //$address="hanako002@gmail.com";

    //◆◇◆◇◆◇◆◇◆◇
    //PDOインスタンスを生成してDBに接続する
    try{
        $db_handle=new PDO('mysql:host=127.0.0.1;dbname=mine_test002;charset=utf8',$userName,$passWord);
    }catch(PDOException $e){
        echo '接続エラー001'.$e->getMessage();
    }

    //SQL作成
    $sql='INSERT INTO mine002(name,address,create_at)VALUES(?,?,?)';

    
    //SQL実行準備
    $statement=$db_handle->prepare($sql);

    //値を渡して実行
    $result=$statement->execute(array(
        $name,
        $mailAddress,
        $now_datetime
    ));

   
    
    //◆◇◆◇◆◇◆◇◆◇
    //登録したデータのIDを取得して出力
    
        $userID=$db_handle->lastInsertId();
        echo "userID=".$userID."<br>";
    
        $db_handle=null;
        $statement=null;
    
    //◆◇◆◇◆◇◆◇◆◇
    try{
        $db_handle002=new PDO('mysql:host=127.0.0.1;dbname=mine_test002;charset=utf8',$userName,$passWord);
    }catch(PDOException $e){
        echo '接続エラー002'.$e->getMessage();
    }

    //SQL作成
    $sql002='SELECT * FROM mine002;';

    //SQL実行
    $res=$db_handle002->query($sql002);

    //取得したデータを表示
    foreach($res as $value){
        echo "$value[id]<br>";
        echo "$value[name]<br>";
        echo "$value[address]<br>";
    }

    $db_handle002=null;
    
    

    //◆◇◆◇◆◇◆◇◆◇
    try{
        $db_handle004=new PDO('mysql:host=127.0.0.1;dbname=mine_test002;charset=utf8',$userName,$passWord);
    }catch(PDOException $e){
        echo '接続エラー004'.$e->getMessage();
    }

    //SQL文作成
    $sql004='INSERT mine003(userID,num,target,fname,create_at)VALUES(?,?,?,?,?);';

    //SQL実行
    $statement004=$db_handle004->prepare($sql004);

    //値を渡して実行
    $statement004->execute(array(
        $userID,
        $num,
        $target,
        $filename,
        $now_datetime
    ));

    $db_handle004=null;
    $statement004=null;


}

?>

<style type="text/css">
<!--

ul{
    list-style:none;
}

?/*
.error_list {	
    padding: 10px 30px;	
    color: #ff2e5a;	font-size: 86%;	
    text-align: left;	
    border: 1px solid #ff2e5a;	
    border-radius: 5px;
    }
    */
-->
</style>

<?php if(isset($error)):?>
    <ul class="error_list">
    <?php foreach($error as $value):?>
        <li style="color:#dc143c;font-weight: bold; "><?php echo $value;?></li>
    <?php endforeach;?>
    </ul>
<?php endif;?>

<form action="" method="POST" enctype="multipart/form-data">

<p>氏名：<input type="text" name="name" 
        value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>"></p>

<p>メールアドレス：<input type="text" name="mailAddress"
         value="<?php if(isset($_POST['name'])){echo $_POST['mailAddress'];}?>"></p>

<p>
<input type="radio" name="num" value="組数" checked>組数
<input type="radio" name="num" value="人数">人数
</p>

<p>
<select name="target">
<option value="人数の対象">人数の対象</option>
<option value="大人+子ども">大人+子ども</option>
<option value="大人">大人</option>
<option value="子ども">子ども</option>
</select>
</p>

<p>
<input type="file" name="fname">
</p>

<p>
<input type="checkbox" name="checkBox001" value="1" checked="checked">児童名
<input type="checkbox" name="checkBox002" value="1">性別
<input type="checkbox" name="checkBox003" value="1">生年月日
</p>

<input type="submit" value="送信内容の確認">

</form>

