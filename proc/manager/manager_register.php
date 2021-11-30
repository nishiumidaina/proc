<?php
session_start();
require_once '../classes/ManagerLogic.php';

//エラーメッセージ
$err = [];

//バリデーション
if (!$username = filter_input(INPUT_POST, 'managername')) {
   $err[] = 'ユーザ名を記入してください。';
}
if (!$email = filter_input(INPUT_POST, 'm_email')) {
    $err[] = 'メールアドレスを記入してください。';
}
$password = filter_input(INPUT_POST,'m_password');
//正規表現
if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
  $err[] = 'パスワードは英数字8文字以上100文字以下にしてください。';
}@
$password_conf = filter_input(INPUT_POST,'m_password_conf');
if ($password !== $password_conf) {
    $err[] = '確認用パスワードと異なっています。';
}

if (count($err) === 0) {
    //ユーザ登録の処理
    $hasCreated = ManagerLogic::createUser($_POST);

    if(!$hasCreated) {
        $err[] = '失敗しました。';
    }

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
    <title>ユーザ登録完了画面</title>
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
<?php if (count($err) > 0) : ?>
  <?php foreach($err as $e) : ?>
    <p><?php echo $e ?></p>
  <?php endforeach ?>
<?php else : ?>
  <p>ユーザ登録が完了しました。</p>
<?php endif ?>
<a href="./manager_signup_form.php">戻る</a>

</div>
</body>
</html>
