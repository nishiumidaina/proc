<?php
session_start();

require_once '../functions.php';
require_once '../classes/SpotLogic.php';
require_once '../classes/UserLogic.php';
/*result = SpotLogic::checkLogin();
if($result) {
  header('Location: managerpage.php');
  return;
}
*/


$result = UserLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: ../manager/manager_signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];

//テスト用フォーム
$dsn  = 'mysql:dbname=proc;host=localhost;charset=utf8';
$user = 'team3';
$pw   = '1192';
$driver_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];

//データベースに接続
$pdo = new PDO(
     $dsn,
     $user,
     $pw,
     $driver_options
);  
    //ユーザ名からIDを取得するための処理
    $login_user_name = $login_user['ユーザ名'];
    echo $login_user['ユーザID']; 


   //ID確認用（後で消す）
   $user_id = $login_user['ユーザID'];;
   $spot_id = $_POST['観光地データ'];
    //ユーザ名をもとにユーザIDを取得
    $sql = 'INSERT INTO ユーザid_観光地id (ユーザID, 観光地ID) VALUES (:userID, :spotID)';  
 
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userID',$user_id);
    $stmt->bindValue(':spotID',$spot_id); 
    $stmt->execute();

?>
