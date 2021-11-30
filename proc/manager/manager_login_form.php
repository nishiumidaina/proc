<?php
session_start();
require_once '../classes/ManagerLogic.php';

$result = ManagerLogic::checkLogin();
if($result) {
  header('Location: managerpage.php');
  return;
}


$err = $_SESSION;
//セッション削除
$_SESSION = array();
session_destroy();

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
    <title>管理者用ログイン画面</title>

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
<h2>管理者用ログインフォーム</h2>
    <?php if (isset($err['m_msg'])) : ?>
        <p><?php echo $err['m_msg']; ?></a>
    <?php endif; ?>
  <form action="manager_login.php" method="POST">
  <p>
    <label for="m_email">メールアドレス：<label>
    <input type="m_email" name="m_email">
    <?php if (isset($err['m_email'])) : ?>
        <p><?php echo $err['m_email']; ?></a>
    <?php endif; ?>
  </p>
  <p>
    <label for="m_password">パスワード：<label>
    <input type="password" name="m_password">
    <?php if (isset($err['m_password'])) : ?>
        <p><?php echo $err['m_password']; ?></a>
    <?php endif; ?>
  </p>
  <p>
  <input type="submit" class="btn btn-primary" value="ログイン">
</p>
  </form>
  <a href="manager_signup_form.php">新規登録はこちら</a>
</div>
</body>
</html>
