<?php
     $to="sfujimura2@gmail.com";
     //$to="fujimura@mediatv.ne.jp";
     $subject="Zoom面談のお知らせ";
     //$message="TEST_MAIL_CONTENT_1041";
     $headers="FROM:sfujimura2@gmail.com";




     $year=2021;
     $month=4;
     $day=6;
     $start_time=15;

     $member_name="藤村伸";
     $member_add="sfujimura2@gmail.com";

     $URL_Zoom="http://zoom.com";

     $message="本日はZoom面談のご予約ありがとうございます。
     予約されました".$year."年".$month."月".$day."日のZoom面談のお知らせをお知らせいたします。
     担当者：xxxxx
     日時：".$year."年".$month."月".$day."日の●●時から。
     参加者：".$member_name."
     参加者のメールアドレス：".$member_add."
     ZoomのURL:".$URL_Zoom."

     以上となります。日時になりましたら、上記のZoomのURLをクリックして、
     Zoomの面談に参加してください。

     ＜緊急連絡先＞
     担当者：xxxxx
     TEL：000-0000-00000
     MAIL:xxxx@xxxx.xxxx
     ";
     



     //mail($to,$subject,$message,$headers);

     if(mb_send_mail($to,$subject,$message,$headers)){
        echo "メールを送信しました";
    }else{
        echo "メールの送信に失敗しました";
    };
?>