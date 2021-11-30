<?php
require_once '../dbconnect.php';

try {

    $user = "team3";
    $password = "1192";

    $dbh = new PDO("mysql:host=localhost; dbname=proc; charset=utf8mb4", "$user", "$password");

    //データ削除
    $stmt = $dbh->prepare('DELETE FROM カメラ WHERE カメラID = :id');

    $stmt->execute(array(':id' => $_GET["id"]));

    echo "削除しました。";

} catch (Exception $e) {
          echo 'エラーが発生しました。:' . $e->getMessage();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="../css/main.css"rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <title>削除完了</title>
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
  <p>
      <a href="../json/json.php">登録済み観光地情報一覧へ</a>
  </p>
</div>
  </body>
</html>
