<h1>Zoom登録画面</h1>

<?php

    //◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
//データベースからデータを取得

 //DBに接続
 $dsn="mysql:dbname=zoom_db;host=localhost";
 $username="root";
 $password="";

 //SELECT
try{
	$db=new PDO($dsn,$username,$password);

	$sql="SELECT * FROM customers";
	$sth=$db->query($sql);
	$arrayList=$sth->fetchAll(PDO::FETCH_ASSOC);

	foreach($arrayList as $value){
		//echo $value['name'];
		$member_name[]=$value['name'];
		$member_add[]=$value['address'];
		$regi_year[]=$value['year'];
		$regi_month[]=$value['month'];
		$regi_day[]=$value['day'];
		$start_time[]=$value['start_time'];

		//echo $member_name;
		//echo $member_add;
		//echo $year;
		//echo $month;
		//echo $day;
		//echo $start_time;
	}

}catch(PDOException $e){
	echo "失敗;".$e->getMessage()."\n";
	exit();
}


    //name=htmlspecialchars($_POST['your_name'],ENT_QUOTES);

    $year=htmlspecialchars($_POST['post_year'],ENT_QUOTES);
    $month=htmlspecialchars($_POST['post_month'],ENT_QUOTES);
    $day=htmlspecialchars($_POST['post_day'],ENT_QUOTES);

    //$year=$_POST['post_year'];
    //$month=$_POST['post_month'];
    //$day=$_POST['post_day'];
    //echo $year;
    //echo $month;
    //echo $day;


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Zoom登録画面</title>
    </head>
    <body>
        <p><?php echo $year;?>年<?php echo $month;?>月<?php echo $day;?>日のZoom予約</p>
        <p>現在、以下の予約が先に入ってます。</p>
        <?php 
            for($i=0;$i<count($regi_day);$i++){
            echo $regi_month[$i]."月".$regi_day[$i]."日".$start_time[$i]."時から。";
            }
        ?>

            <form method="post" action="index003.php">
                <p>開始時間</p>
                    <select name="start_time_hour">
                    <?php
                        for($number=0;$number<=25;$number++){
                            echo '<option value="',$number,'">',$number,'</option>';
                        }
                    ?>
                    </select>
                    時
                    
                    <p>参加者の氏名とメールアドレス<br>
                    氏名
                    <input type="text" name="member_name"/>
                    メールアドレス
                    <input type="text" name="member_add"/>

                    <input type="hidden" name="year"
						value="<?php echo $year;?>">
                    <input type="hidden" name="month"
						value="<?php echo $month;?>">
                    <input type="hidden" name="day"
						value="<?php echo $day;?>">
                <br>
                <br>
                <input type="submit" value="登録">
                <button onclick="history.back()">戻る</button>
            </form>
        
    </body>
</html>