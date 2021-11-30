<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="0;URL=../spot/spot.php">
  <title>Document</title>
</head>
<body>
  
</body>
</html>
<?php
  $data = array();

  // DB接続情報
  $host = "localhost";
  $dbname = "proc";
  $user = "team3";
  $pass = "1192";

  // DB接続・SQL準備
  $dbh = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8mb4", "$user","$pass"); 

  $sql = "SELECT * FROM 観光地情報";
  $sth = $dbh -> prepare($sql);
  $sth -> execute();

  //データを取得する
  $data = $sth -> fetchAll(PDO::FETCH_ASSOC);

  //jsonオブジェクト化
  $json_array = json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
  echo $json_array;
  file_put_contents("tourist.json" , $json_array);


  $sql2 = "SELECT * FROM カメラ";
  $sth = $dbh -> prepare($sql2);
  $sth -> execute();

  //データを取得する
  $data2 = $sth -> fetchAll(PDO::FETCH_ASSOC);

  //jsonオブジェクト化
  $json_array2 = json_encode($data2,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
  echo $json_array2;
  file_put_contents("camera.json" , $json_array2);
?>