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

try {
    $user = "team3";
    $pass = "1192";

    $dbh = new PDO("mysql:host=localhost; dbname=proc; charset=utf8mb4", "$user","$pass"); 

    $login_user_name = $login_user['ユーザ名'];
    $user_id = $dbh->query("SELECT ユーザID FROM ユーザ情報 WHERE ユーザ名 = '".$login_user_name."'");
    //中間テーブルからユーザ情報とパズル画像を取得
    $stmt = $dbh->query("SELECT ユーザ情報.ユーザID as ユーザID, ユーザ情報.ユーザ名 as ユーザ名, 観光地情報.パズル画像 as パズル画像 FROM ユーザ情報 
    INNER JOIN ユーザid_観光地id ON ユーザ情報.ユーザID = ユーザid_観光地id.ユーザID 
    INNER JOIN 観光地情報 ON ユーザid_観光地id.観光地ID = 観光地情報.観光地ID 
    WHERE ユーザ情報.ユーザ名 = '".$login_user_name."'");
    
    $result = 0;

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link href="../css/main.css"rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="text-white navbar-brand" href="/proc/public/mypage.php">観光地の過密対策アプリケーション
開発プロジェクト
</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                      <!-- マイページに飛ばそうとすると管理者ページに飛んでしまうのでコメントアウトしました -->
                        <!-- <li class="nav-item mx-0 mx-lg-1"><a class="text-white nav-link py-3 px-0 px-lg-3 rounded" href="/proc/public/mypage.php">マイページ</a></li> -->
                        <li class="nav-item mx-0 mx-lg-1"><form action="logout.php" method="POST">
<input type="submit" name="logout" value="ログアウト">
</form></li>
                    </ul>
                </div>
            </div>
        </nav>
  <div class="zentai">
  <h2>リザルト画面</h2>
  <p>ログインユーザ:<?php echo $login_user_name ?></p>
  <p>メールアドレス:<?php echo h($login_user['メールアドレス']) ?></p>
<div class="tables">
        <?php
        $count = 0;
            echo "<table align='center'>\n";
              echo "<tr>\n";
              echo "<th>パズル画像</th>\n";
              echo "</tr>\n";
              foreach ($result as $user) {
                echo "<tr>\n";
                echo '<td><img src="../img/' , $user['パズル画像'] , '" class="img-fluid"

                ></td>';
                echo "<td>\n";
                //echo "<a href=delete.php?id=". $user["観光地ID"] . ">削除</a>\n";
                echo "</td>\n";
                echo "</tr>\n";
                $count = $count + 1;
              }
            echo "</table>\n";
            
             if($count>5){
             echo "クーポン表示（画像に変更予定）";
            };
        ?>
        <?php

        
        ?>
        </div>
  <script>
    


  </script>
  <form action="logout.php" method="POST">
  <a href="./GISpage.php">マップへ戻る</a>
<input type="submit" name="logout" value="ログアウト">
</form>
</div>
</body>
</html>