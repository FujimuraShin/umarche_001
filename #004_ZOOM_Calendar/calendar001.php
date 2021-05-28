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



//◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆◇◆
//変数の初期化
//前月、次月ボタンが押された時、GETで来る
if(empty($_GET['m'])){
	//現在の年月を取得
	$year=date('Y');
	$month=date('n');
}else{
	$m=$_GET['m'];
	$year=substr($m,0,4);
	$month=substr($m,5,6);

}


	$p_year=$year;
	$p_month=$month;
	$p_day=date('d');


	//月末日を取得
	$last_day=date('j',mktime(0,0,0,$month+1,0,$year));
	
	$calendar=array();
	$j=0;
	
	//月末日までループ
	for($i=1;$i<$last_day;$i++){
		
		//曜日を取得
		$week=date('w',mktime(0,0,0,$month,$i,$year));
		
		//1日の場合
		if($i==1){
			//1日目の曜日までループ
			for($s=1;$s<=$week;$s++){
				//前半に空文字をセット
				$calendar[$j]['day']='';
				$j++;
			}
		}
		
		//配列に日付をセット
		$calendar[$j]['day']=$i;
		$j++;
		
		//月末日の場合
		if($i==$last_day){
			//月末日から残りをループ
			for($e=1;$e<=6-$week;$e++){
				//後半に空文字をセット
				$calendar[$j]['day']='';
				$j++;
			}
		}
	}
	
	
?>

<!DOCTYPE>
<html>
<head>
	<meta charset="utf-8">
	<title>PHPカレンダー</title>
	
	<style rel="stylesheet" type="text/css">
		table{
			width:50%;
			float:left;
		}
		
		table th{
			bakcground:#eeeeee;
		}
		
		table th,
		table td{
			border:1px solid #cccccc;
			text-align:center;
			padding:5px;
		}
		
		
		#today{
			text-align:center;
			font-size:180%;
		}
		
		#form{
			float:right;
			text-align:center;
			background:#c6e2ff;
			border:1px solid black;
			border-radius:5px;
			margin-right:40px
		}
		
	
	</style>
	
</head>
<body>
	
	<div id="today">
		<p><a href="?m=<?php echo date('Ym',mktime(0,0,0,$month-1,1,$year))?>"><<前の月</a>
		<?php echo $year; ?>年<?php echo $month; ?>月のカレンダー
		<a href="?m=<?php echo date('Ym',mktime(0,0,0,$month+1,1,$year));?>">次の月>></a></p>
	</div>
	
<table>
	
	
    <tr>
        <th>日</th>
        <th>月</th>
        <th>火</th>
        <th>水</th>
        <th>木</th>
        <th>金</th>
        <th>土</th>
    </tr>
 
    <tr>
    <?php $cnt = 0; ?>
	<?php $i=0;?>
    <?php foreach ($calendar as $key => $value): ?>
 
        <td>
		<form method="post" action="index001.php">
        <?php $cnt++; ?>
        	<?php echo $value['day']; ?>
			<br>
		<?php
			//echo $result=array_keys($regi_day,$value['day']);
			
			if($result=array_keys($regi_day,$value['day'])){
				$j=0;
				//echo $i;
				//echo $value['day'];
				//var_dump($result);
				//echo $j;
				//echo $result[$j];
				if($year==$regi_year[$i] && $month==$regi_month[$i]){
					echo $start_time[$result[$j]]."時から";
					$j++;
				}
				$i++;
			}
		?>

			<?php if(!empty($value['day'])):?>
			<input type="hidden" name="post_year" 
						value="<?php echo $year;?>">
			<input type="hidden" name="post_month"
						value="<?php echo $month;?>">
			<input type="hidden" name="post_day"
						value="<?php echo $value['day'];?>">
			<br>
			<input type="submit" value="予約">
			<?php endif;?>
			<br>
			

		</form>
        </td>
 
    <?php if ($cnt == 7): ?>
    </tr>
    <tr>
    <?php $cnt = 0; ?>
    <?php endif; ?>
 
    <?php endforeach; ?>
    </tr>
</table>

</body>
</html>