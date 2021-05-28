<?php
     $to="sfujimura2@gmail.com";
     //$to="fujimura@mediatv.ne.jp";
     $subject="Zoom面談予約が入りました";
     //$message="TEST_MAIL_CONTENT_1041";
     $headers="FROM:sfujimura2@gmail.com";




     $year=2021;
     $month=4;
     $day=6;
     $start_time=15;

     $member_name="藤村伸";
     $member_add="sfujimura2@gmail.com";

     $URL_Zoom="http://zoom.com";

     $message="先ほど、Zoom面談の予約が入りました。
     Zoom面談予約の詳細は以下です。
 
     参加者:".$member_name."さま
     日時:".$year."年".$month."月".$day."日の".$start_time."時から。
     参加者のメールアドレス：".$member_add."
     ZoomのURL:".$URL_Zoom."

     以上となりますので、当日の日時になりましたら、
     パソコンの準備をしておまちください。";
     



     //mail($to,$subject,$message,$headers);

     if(mb_send_mail($to,$subject,$message,$headers)){
        echo "メールを送信しました";
    }else{
        echo "メールの送信に失敗しました";
    };
?>