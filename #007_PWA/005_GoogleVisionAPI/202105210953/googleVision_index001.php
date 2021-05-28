<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>OCR Image Caputre</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
    
</head>
<body>
    <!-- カメラ映像が描画されます。 -->
    <video id="video_area" style="background-color: #000" autoplay></video>

    <!-- 押下するとカメラ映像描画を開始します。 -->
    <button id="start_btn">映像表示開始</button>

    <!-- 押下するとカメラ映像から静止画をキャプチャします。 -->
    <button onclick="copyFrame()">静止画取得</button>

    <!-- キャプチャした静止画が描画されます。 -->
    <canvas id="capture_image"></canvas>


</body>
<script>
    
    // getUserMedia が使えないときは、『getUserMedia()が利用できないブラウザです！』と言ってね。
    if (typeof navigator.mediaDevices.getUserMedia !== 'function') {
        const err = new Error('getUserMedia()が利用できないブラウザです！');
        alert(`${err.name} ${err.message}`);
        throw err;
    }

    // 操作する画面エレメント変数定義します。
    const $start = document.getElementById('start_btn');   // スタートボタン
    const $video = document.getElementById('video_area');  // 映像表示エリア

    // 「スタートボタン」を押下したら、getUserMedia を使って映像を「映像表示エリア」に表示してね。
    $start.addEventListener('click', () => {
        navigator.mediaDevices.getUserMedia({ video: true, audio: false })
        .then(stream => $video.srcObject = stream)
        .catch(err => alert(`${err.name} ${err.message}`));
    }, false);


    // 「静止画取得」ボタンが押されたら「<canvas id="capture_image">」に映像のコマ画像を表示します。
    function copyFrame() {

        var canvas_capture_image = document.getElementById('capture_image');
        var cci = canvas_capture_image.getContext('2d');
        var va = document.getElementById('video_area');

        canvas_capture_image.width  = va.videoWidth;
        canvas_capture_image.height = va.videoHeight;
        cci.drawImage(va, 0, 0);  // canvasに『「静止画取得」ボタン』押下時点の画像を描画。
    }

    var img_js=document.getElementById('video_area');

    $.ajax({
            type: 'POST',
            url: 'index001.php',
            data: {
                'img_js' : img_js
            },
            success: function(data) {
                alert(data);
            }
        });   


</script>
</html>

<?PHP
    if(isset($_POST['img_js'])){
        echo $_POST['img_js'];
    }

    

// APIキー
$api_key = "AIzaSyCtfJXgZryAVOdAqIjcb_a5idXv1rVnR8E" ;

//画像のPATHを入力してください（URLでいいですよ）
$image_path = "C:/Users/fujim/OneDrive/デスクトップ/test.jpg";

// リクエスト用のJSONを作成
$json = json_encode( array(
        "requests" => array(
                array(
                        "image" => array(
                                "content" => base64_encode( file_get_contents( $image_path ) ) ,
                        ) ,
                        "features" => array(
                                array(
                                        "type" => "TEXT_DETECTION" ,
                                        "maxResults" => 10 ,
                                ) ,
                        ) ,
                ) ,
        ) ,
) ) ;

// リクエストを実行
$curl = curl_init() ;
curl_setopt( $curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $api_key ) ;
curl_setopt( $curl, CURLOPT_HEADER, true ) ;
curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" ) ;
curl_setopt( $curl, CURLOPT_HTTPHEADER, array( "Content-Type: application/json" ) ) ;
curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false ) ;
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ) ;
if( isset($referer) && !empty($referer) ) curl_setopt( $curl, CURLOPT_REFERER, $referer ) ;
curl_setopt( $curl, CURLOPT_TIMEOUT, 15 ) ;
curl_setopt( $curl, CURLOPT_POSTFIELDS, $json ) ;
$res1 = curl_exec( $curl ) ;
$res2 = curl_getinfo( $curl ) ;
curl_close( $curl ) ;

// 取得したデータ
$json = substr( $res1, $res2["header_size"] ) ;
$array_json=json_decode($json, true);

$text=$array_json["responses"]["0"]["textAnnotations"]["0"]["description"];

echo $text;
?>