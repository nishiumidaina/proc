<?php
session_start();
require_once '../classes/ManagerLogic.php';
require_once '../functions.php';

//　ログインしているか判定し、していなかったら新規登録画面へ返す
$result = ManagerLogic::checkLogin();

if (!$result) {
  $_SESSION['login_err'] = 'ユーザを登録してログインしてください！';
  header('Location: manager_signup_form.php');
  return;
}

$login_user = $_SESSION['login_user'];
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
                          <!-- <li class="nav-item mx-0 mx-lg-1"><a class="text-white nav-link py-3 px-0 px-lg-3 rounded" href="/proc/public/logout.php">ログアウト</a></li> -->
                      </ul>
                  </div>
              </div>
          </nav>
    <div class="zentai">
<h2>マイページ</h2>
  <p>ログインユーザ:<?php echo h($login_user['管理者名']) ?></p>
  <p>メールアドレス:<?php echo h($login_user['管理者メールアドレス']) ?></p>
  <p>
  <a href="../spot_form/input.php">地図登録フォームへ</a>
  </p>
  <a href="../spot_form/input_new.php">観光地登録フォームへ</a>
  </p>
  <p>
  <a href="../camera/camera_input.php">ライブカメラ登録フォームへ</a>
  <p>

  <a href="../spot/spot.php">登録済み観光地情報一覧へ</a>
  <form action="manager_logout.php" method="POST">
  <a>
  <a href="../spot/spot_new.php">DB保管された観光地一覧へ</a>  
  </a>
  </p> 
   <p>
  <a href="../camera/camera.php">ライブカメラ一覧へ</a>
  <p>
  <input type="submit" name="logout" value="ログアウト">
</form>
</div>
</body>
</html>
