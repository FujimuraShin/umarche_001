<?PHP
header('Content-type: application/json; charset=utf-8'); // ヘッダ（JSON指定など）
$data = filter_input(INPUT_POST, 'データ'); // 送ったデータを受け取る
 
$param = $data;	//　やりたい処理
 
echo json_encode($param); 