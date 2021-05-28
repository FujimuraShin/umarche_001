<h1>Zoom予約終了画面</h1>

<?php

    //Zoom登録画面からの遷移で、各種情報を変数に格納
    $start_time=htmlspecialchars($_POST['start_time'],ENT_QUOTES);
    $member_name=htmlspecialchars($_POST['member_name'],ENT_QUOTES);
    $member_add=htmlspecialchars($_POST['member_add'],ENT_QUOTES);

    $year=htmlspecialchars($_POST['year'],ENT_QUOTES);
    $month=htmlspecialchars($_POST['month'],ENT_QUOTES);
    $day=htmlspecialchars($_POST['day'],ENT_QUOTES);


    echo $start_time.'<br>';
    echo $member_name.'<br>';
    echo $member_add.'<br>';

    echo $year.'<br>';
    echo $month.'<br>';
    echo $day.'<br>';

    //◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
    //データベースに情報を登録

    //DBに接続
    $dsn="mysql:dbname=zoom_db;host=localhost";
    $username="root";
    $password="";

    date_default_timezone_set('Asia/Tokyo');
    $now_datetime = date('Y-m-d H:i:s');

    //INSERT
    try{
        $db=new PDO($dsn,$username,$password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        //$sql="INSERT INTO customers(name,address,year,month,day,start_time,ronri,create_date)VALUES('$member_name','$member_add','$year','$month','$day','$start_time',1,NOW()) ";
        
        //$sql="INSERT INTO customers(name,address,year,month,day,start_time,ronri,create_date)VALUES(?,?,?,?,?,?,?,?)";
        
        $sql="INSERT INTO customers(name,address,year,month,day,start_time,ronri,create_date)VALUES(:name,:address,:year,:month,:day,:start_time,:ronri,:create_date) ";
        

        //SQL実行準備
        $stmt=$db->prepare($sql);

        $ronri=1;

        
        $stmt->bindValue(':name',$member_name);
        $stmt->bindValue(':address',$member_add);
        $stmt->bindValue(':year',$year);
        $stmt->bindValue(':month',$month);
        $stmt->bindValue(':day',$day);
        $stmt->bindValue(':start_time',$start_time);
        $stmt->bindValue(':ronri',$ronri);
        $stmt->bindValue(':create_date',$now_datetime);
        
        $ret=$stmt->execute();

        /*
        $result=$stmt->execute(array(
            ':name'=>$member_name,
            ':address'=>$member_add,
            ':year'=>$year,
            ':month'=>$month,
            ':day'=>$day,
            ':start_time'=>$start_time,
            ':ronri'=>$ronri,
            ':create_date'=>$now_datetime
        ));
        */

        //$result=$statement->execute(array($member_name,$member_add,$year,$month,$day,$start_time,1,$now_datetime));
        
        //$db->query($sql);

        // DB接続を解除
        $statement = null;
        $db = null;
      
        

    }catch(PDOException $e){
        echo "失敗;".$e->getMessage()."\n";
        exit();
    }




?>


//カレンダー画面に戻るボタン
<form action="calendar001.php" method="post">
    <input type="submit" value="カレンダー画面に戻る">
</form>

