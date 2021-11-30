<?php
session_start();
date_default_timezone_set('Asia/Tokyo');

require_once '../classes/UserLogic.php';

$result = UserLogic::checkLogin();
if($result) {
  header('Location: mypage.php');
  return;
}


$err = $_SESSION;
//セッション削除
$_SESSION = array();
session_destroy();

?>
<?php
$time = intval(date('H'));
if (12 <= $time && $time <= 13) 
{ // 4時～12時の時間帯のとき 
echo "現在メンテナンス中";
 }
 else { // それ以外の時間帯のとき
  echo '"<!DOCTYPE html>
  <html lang="en">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link href="../css/main.css"rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>ログイン画面</title>
  </head>
  <body>
    <div class="wrapper">
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
  <h2>ログインフォーム</h2>
      <?php if (isset($err["msg"])) : ?>
          <p><?php echo $err["msg"]; ?></a>
      <?php endif; ?>
    <form action="login.php" method="POST">
    <p>
      <label for="email">メールアドレス：<label>
      <input type="email" name="email">
      <?php if (isset($err["email"])) : ?>
          <p><?php echo $err["email"]; ?></a>
      <?php endif; ?>
    </p>
    <p>
      <label for="password">パスワード：<label>
      <input type="password" name="password">
      <?php if (isset($err["password"])) : ?>
          <p><?php echo $err["password"]; ?></a>
      <?php endif; ?>
    </p>
    <p>
    <input type="submit" class="btn btn-primary" value="ログイン">
  </p>
  <p>
  <a href="signup_form.php">新規登録はこちら</a>
      </p>
    </form>
    </div>
  </div>
  </body>
  </html>
"';
      }
?>