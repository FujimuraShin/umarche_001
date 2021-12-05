<?php
// ファイルを保存するディレクトリ
$save_dir = "./";

// 許可する拡張子
$array = array("jpg", "jpeg");

// ファイルがアップロードされたものなら処理をする
if (is_uploaded_file(@$_FILES["upfile"]["tmp_name"])) {

    // ファイルの拡張子を取得する
    $finfo = pathinfo($_FILES["upfile"]["name"]);
    $ext = $finfo["extension"];
    
    // 拡張子チェック
    if (in_array($ext, $array)) {
        // テンポラリファイルを保存ディレクトリにコピー
        copy($_FILES["upfile"]["tmp_name"], 
        $save_dir.$_FILES["upfile"]["name"]);
        echo "<p>ファイルアップロード完了";
        echo "<p>ファイル名：".$_FILES["upfile"]["name"];
    }
    else {
        echo "<p>許可されない拡張子です：".$ext;
        echo "<p>ファイル名：".$_FILES["upfile"]["name"];
    }
}



//header('Content-type: image/png');



// APIキー
$api_key = "AIzaSyCtfJXgZryAVOdAqIjcb_a5idXv1rVnR8E" ;



// リクエスト用のJSONを作成
$json = json_encode( array(
        "requests" => array(
                array(
                        "image" => array(
                                "content" => base64_encode(file_get_contents(  $save_dir.$_FILES["upfile"]["name"]) ) ,
                                //"content" => $save_dir.$_FILES["upfile"]["name"]  ,
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
echo "hogehoge";
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

//var_dump($array_json);

$text=$array_json["responses"]["0"]["textAnnotations"]["0"]["description"];


echo $text;

//$text1='吾輩は猫である';
$json_text = json_encode($text);

?>



<html>
<head>
<title>iPhoneで撮影した画像を保存する</title>
</head>
<body>

<form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post" enctype="multipart/form-data">
  <input type="file" name="upfile" accept="image/*">
  <input type="submit" value="アップロードする" onclick="test1()">
</form>

<textarea id="comment"></textarea>

<script type="text/javascript">
function test1(){
const  text = JSON.parse('<?php echo $json_text; ?>');
alert(text);
//let text = '吾輩は猫である'
let fromLang = 'ja'
let toLang = 'en'
let apiKey = 'AIzaSyCtfJXgZryAVOdAqIjcb_a5idXv1rVnR8E'

// 翻訳
const URL = "https://translation.googleapis.com/language/translate/v2?key="+apiKey+
    "&q="+encodeURI(text)+"&source="+fromLang+"&target="+toLang
let xhr = new XMLHttpRequest()
xhr.open('POST', [URL], false)
xhr.send();
if (xhr.status === 200) {
    const res = JSON.parse(xhr.responseText); 
    alert(res["data"]["translations"][0]["translatedText"])
    var translate=res["data"]["translations"][0]["translatedText"]

    var e = document.getElementById ('comment');
        e.value = translate;	
}
}
</script>



</body>
</html>

