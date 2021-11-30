<?php
// セッションの開始
session_start();

$spotname = htmlspecialchars($_POST['spotname'], ENT_QUOTES, 'UTF-8');
$lat = htmlspecialchars($_POST['lat'], ENT_QUOTES, 'UTF-8');
$long = htmlspecialchars($_POST['long'], ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
$spot_ex = htmlspecialchars($_POST['spot_ex'], ENT_QUOTES, 'UTF-8');
$spot_img = htmlspecialchars($_POST['spot_img'], ENT_QUOTES, 'UTF-8');
$pazzle_img = htmlspecialchars($_POST['pazzle_img'], ENT_QUOTES, 'UTF-8');
// 入力値をセッション変数に格納
$_SESSION['spotname'] = $spotname;
$_SESSION['lat'] = $lat;
$_SESSION['long'] = $long;
$_SESSION['address'] = $address;
$_SESSION['tel'] = $tel;
$_SESSION['spot_ex'] = $spot_ex;
$_SESSION['spot_img'] = $spot_img;
$_SESSION['pazzle_img'] = $pazzle_img;

?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>観光地登録フォーム(confirm)</title>
<style>
h1 {
  margin-left: 50px;
}
th {
  width: 200px;
  margin: 10px 0;
}
input#send {
  margin-left: 100px;
  margin-top: 30px;
}
</style>
</head>

<body>
<h1>ユーザー登録フォーム(confirm)</h1>
<form action="submit.php" method="post">
<table>
<tr><th>観光地名：</th><td><?php echo $spotname; ?></td></tr>
<tr><th>緯度：</th><td><?php echo $lat; ?></td></tr>
<tr><th>経度：</th><td><?php echo $long; ?></td></tr>
<tr><th>住所：</th><td><?php echo $address; ?></td></tr>
<tr><th>電話番号：</th><td><?php echo $tel; ?></td></tr>
<tr><th>観光地説明：</th><td><?php echo $spot_ex; ?></td></tr>
<tr><th>観光地画像：</th><td><?php echo $spot_img; ?></td></tr>
<tr><th>パズル画像：</th><td><?php echo $pazzle_img; ?></td></tr>
</table>
<input id="send" type="submit" value="登録">
</form>
</body>
</html>

