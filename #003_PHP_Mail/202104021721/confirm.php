<?php
    mb_language("japanese");
    mb_internal_encoding("UTF-8");

    $to=$_POST['to'];
    $title=$_POST['title'];
    $content=$_POST['content'];

    if(mb_send_mail($to,$title,$content)){
        echo "メールを送信しました!";
    }else{
        echo "メール送信に失敗しました";
    };

?>