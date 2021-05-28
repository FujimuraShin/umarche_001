<?php
    // 文字列をURL-Safe Base64でエンコードする関数
function urlsafe_base64_encode($str){
    return str_replace(array('+', '/', '='), array('-', '_', ''), base64_encode($str));
  }
   
   
  $zoom_url = 'https://api.zoom.us/v2/users/sfujimura2@gmail.com/meetings';
  $zoom_api_key ='IhqZSyJiTbec2YT-yP1GnA'; //ご自分のAPI Key
  $zoom_api_secret = 'rknffdIvkDDtabvSv8GMxqvtdqKxglhYNRcA'; //ご自分のAPI Secret
   
  $expiration = time() + 20; //Tokenの有効期限（秒）
   
  $header = urlsafe_base64_encode('{"alg":"HS256","typ":"JWT"}');
  $payload = urlsafe_base64_encode('{"iss":"' . $zoom_api_key . '","exp":' . $expiration . '}');
  $signature = urlsafe_base64_encode(hash_hmac('sha256', "$header.$payload", $zoom_api_secret , TRUE));
  $token = "$header.$payload.$signature";
   
  // 即時生成の場合
  $data_to_zoom_api = array(
    'type' => "1",
    'topic' => "会議室タイトル",
  );
   
  //  時刻指定の場合
  //  $data_to_zoom_api = array(
  //    "topic" => "会議室タイトル",
  //    "type" => "2",
  //    "start_time" => "2020-08-17T18:30:00",
  //    "timezone" => "Asia/Tokyo",
  //    "settings" => array(
  //      "use_pmi" => "false"
  //    )
  //  );
   
  $options = array(
    'http' => array(
      'method'=> 'POST',
      'header'=> array(
        'Content-type: application/json',
        'Authorization: Bearer ' . $token,
      ),
      'content' => json_encode($data_to_zoom_api)
    )
  );
   
  $context = stream_context_create($options);
  $json_result = file_get_contents($zoom_url, false, $context);
  $json_result = json_decode($json_result, true);
  $message = $json_result['join_url'];
  echo $message;