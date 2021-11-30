<?php
session_start();

require_once '../functions.php';
require_once '../classes/SpotLogic.php';
require_once '../classes/ManagerLogic.php';
/*result = SpotLogic::checkLogin();
if($result) {
  header('Location: managerpage.php');
  return;
}
*/

$result = ManagerLogic::checkLogin();

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

    $stmt = $dbh->query('SELECT * FROM カメラ');
    $result = 0;

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>登録済み観光地情報一覧</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
                <div class="container">
                    <a class="text-white navbar-brand" href="/proc/public/mypage.php">観光地の過密対策アプリケーション開発プロジェクト</a>
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
      <h2>登録済み観光地情報一覧</h2>
      <?php
            echo "<table>\n";
              echo "<tr>\n";
              echo "<th>カメラ設置場所</th><th>緯度</th><th>経度</th><th>動画埋め込み</th>>\n";
              echo "</tr>\n";
              foreach ($result as $user) {
                echo "<tr>\n";
                echo "<td>" . $user["カメラ設置場所"] . "</td>\n";
                echo "<td>" . $user["緯度"] . "</td>\n";
                echo "<td>" . $user["経度"] . "</td>\n";
                echo "<td>" . $user["動画埋め込み"] . "</td>\n";
                echo "<td>\n";
                echo "<a href=camera_delete.php?id=". $user["カメラID"] . ">削除</a>\n";
                echo "</td>\n";
                echo "</td>\n";
                echo "</tr>\n";
              }
            echo "</table>\n";
        ?>
        <a href="../json/json.php">マップに追加・更新</a>
        <a href="../spot_form/input.php">観光地登録画面へ戻る</a>
        <a href="../camera/camera_input.php">ライブカメラ登録フォームへ</a>
      </div>
  </body>
</html>
