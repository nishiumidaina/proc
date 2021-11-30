
<?php
session_start();
require_once '../classes/ManagerLogic.php';

if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエストです。');
}

//　ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
$result = ManagerLogic::checkLogin();

if (!$result) {
  exit('セッションが切れましたので、ログインし直してください。');
}

// ログアウトする
ManagerLogic::logout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>
</head>
<body>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link href="../css/main.css"rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<h2>ログアウト完了</h2>
<p>ログアウトしました！</p>
<a href="manager_login_form.php">ログイン画面へ</a>
</div>
</body>
</html>
