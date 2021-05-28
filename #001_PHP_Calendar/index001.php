<?php

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

//投稿ボタンが押された時
if(!empty($_POST['post_year'] 
	&& $_POST['post_month'] 
	&& $_POST['post_day'])){

	$p_year=$_POST['post_year'];
	$p_month=$_POST['post_month'];
	$p_day=$_POST['post_day'];
	
}else{
	$p_year=$year;
	$p_month=$month;
	$p_day=date('d');
}

//投稿記録ボタンが押された時
if(!empty($_POST['postComment'])){
	$text=$_POST['postComment'];
	echo $text;
}else{
	$text=null;
}

	
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
			widht:100%;
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
	
	</style>
	
</head>
<body>
	
	<p><a href="?m=<?php echo date('Ym',mktime(0,0,0,$month-1,1,$year))?>"><<前の月</a></p>
	<p><?php echo $year; ?>年<?php echo $month; ?>月のカレンダー</p>
	<p><a href="?m=<?php echo date('Ym',mktime(0,0,0,$month+1,1,$year));?>">次の月>></a></p>
<br>
<br>
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
    <?php foreach ($calendar as $key => $value): ?>
 
        <td>
		<form method="post" action="">
        <?php $cnt++; ?>
        <?php echo $value['day']; ?>
			<?php if(!empty($value['day'])):?>
			<textarea>
					<?php if($value['day']==$p_day):?>
					<?php echo $text;?>
					<?php endif;?>
			</textarea>
					
					
			<input type="submit" value="投稿">
			<input type="hidden" name="post_year" 
						value="<?php echo $year;?>">
			<input type="hidden" name="post_month"
						value="<?php echo $month;?>">
			<input type="hidden" name="post_day"
						value="<?php echo $value['day'];?>">
		<?php endif;?>
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

<form method="post" action="">
	<label><?php echo $p_year;?>年<?php echo $p_month;?>月<?php echo $p_day;?>日の投稿</label>
	<br/>
	<textarea name="postComment"></textarea>
	
	<br/>
	<input type="submit" value="投稿する">
	
</form>


	
</body>
</html>