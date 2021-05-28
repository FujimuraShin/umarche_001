<?php
//タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

//前月・翌月ボタンが押された場合、GETパラメータから年月を取得
if(isset($_GET['ym'])){
    $ym = $_GET['ym'];
} else {
//押されてなかったら今の年月を取得　(2019-07)
    $ym = date('Y-m');
}

//タイムスタンプを作成する
$timestamp = strtotime($ym . '-01'); //2019-07に"-01"を足している
if($timestamp == false){
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}
//↑これで$timestampは2019-07-01となる


//今日の日付をセット　(2019-07-13)
$today = date('Y-m-j');

//カレンダーのタイトルを設定　(2019年7月)
$title = date('Y年m月' , $timestamp);

//前月・次月の年月を取得する
$prev = date('Y-m',strtotime('-1 month',$timestamp)); //2019-06
$next = date('Y-m',strtotime('+1 month',$timestamp)); //2019-08

//該当の月の日数を取得 (31を取得)
$day_count = date('t',$timestamp);

//曜日を取得 (１:月曜日を取得)
$youbi = date('w',$timestamp);

//カレンダー作成の準備
$week = '';
$weeks = [];

//月初の曜日より前の曜日を空セルにする
$week .= str_repeat('<td></td>' , $youbi);
for($day = 1; $day <= $day_count; $day++,$youbi++){
    $date = $ym . '-' . $day; //日にちを1日ずつ足していく
    //もし今日の日付だったらクラスをつける
    if($today == $date){
    $week .= '<td class="today">' . $day;
    } else {
    //今日以外の日付は普通に出力する
    $week .= '<td>' . $day;
    }
    $week .= '</td>';

//週終わり・月終わりの処理(もし今日の日付が月の日数の最後の日付だったら)
if ($youbi % 7 == 6 || $day == $day_count) {
    if ($day == $day_count) {
        $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
    }

//$weeks(配列)の中に一週間分格納する
$weeks[]='<tr>' . $week . '</tr>';
$week = '';
}
}
?>


<!DOCTYPE html>
<html lang="la">
<head>
    <meta charset="UTF-8">
    <title>PHPカレンダー</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table border="1">
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>
</body>
</html>