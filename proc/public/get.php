<?PHP
header('Content-type: application/json; charset=utf-8'); // ヘッダ（データ形式、文字コードなど指定）
$data = filter_input(INPUT_POST, 'データ'); // 送ったデータを受け取る（GETで送った場合は、INPUT_GET）
 
$param = $data;	//　やりたい処理
 
echo json_encode($param); //　echoするとデータを返せる（JSON形式に変換して返す）
