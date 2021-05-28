<h1>Zoom予約確認画面</h1>

<?php

    //Zoom登録画面からの遷移で、各種情報を変数に格納
    $start_time=htmlspecialchars($_POST['start_time_hour'],ENT_QUOTES);
    $member_name=htmlspecialchars($_POST['member_name'],ENT_QUOTES);
    $member_add=htmlspecialchars($_POST['member_add'],ENT_QUOTES);

    $year=htmlspecialchars($_POST['year'],ENT_QUOTES);
    $month=htmlspecialchars($_POST['month'],ENT_QUOTES);
    $day=htmlspecialchars($_POST['day'],ENT_QUOTES);




?>

<p>以下の内容でZoom予約の日時と氏名を登録して宜しいでしょうか？</p>

<?php

echo "日時<br>";
echo $year."年".$month."月".$day."日<br>";
echo "開始時間<br>";
echo $start_time."時から";
echo "参加者氏名<br>";
echo $member_name;
echo "メールアドレス<br>";
echo $member_add;

?>
        <form method="post" action="index002.php">
                    <input type="hidden" name="year"
						value="<?php echo $year;?>">
                    <input type="hidden" name="month"
						value="<?php echo $month;?>">
                    <input type="hidden" name="day"
						value="<?php echo $day;?>">
                    <input type="hidden" name="member_name"
						value="<?php echo $member_name;?>">
                    <input type="hidden" name="member_add"
						value="<?php echo $member_add;?>">
                    <input type="hidden" name="start_time"
						value="<?php echo $start_time;?>">


                    <input type="submit" value="登録">
                    <button onclick="history.back()">戻る</button>
        </form>