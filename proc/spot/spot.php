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

    $stmt = $dbh->query('SELECT * FROM 観光地情報');
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
      <h2>登録済み観光地情報一覧</h2>
      <h5>こちらは現在地図に表示されている観光地の一覧です。</h5>
        <?php
            echo "<table>\n";
              echo "<tr>\n";
              echo "<th>観光地名</th><th>緯度</th><th>経度</th><th>住所</th><th>電話番号</th><th>観光地説明</th><th>画像</th><th>パズル画像</th><th>パズル番号</th>\n";
              echo "</tr>\n";
              foreach ($result as $user) {
                echo "<tr>\n";
                echo "<td>" . $user["観光地名"] . "</td>\n";
                echo "<td>" . $user["緯度"] . "</td>\n";
                echo "<td>" . $user["経度"] . "</td>\n";
                echo "<td>" . $user["住所"] . "</td>\n";
                echo "<td>" . $user["電話番号"] . "</td>\n";
                echo "<td>" . $user["観光地説明"] . "</td>\n";
                echo '<td><img src="../img/' , $user['画像'] , '" widht=100 height=100></td>';
                echo '<td><img src="../img/' , $user['パズル画像'] , '" widht=50 height=50></td>';
                echo "<td>" . $user["観光地ID"] . "</td>\n";
                echo "<td>\n";
                echo "<a href=delete.php?id=". $user["観光地ID"] . ">削除</a>\n";
                echo "</td>\n";
                echo "</td>\n";
                echo "</tr>\n";
              }
            echo "</table>\n";
        ?>
      <p>
      <a href="../json/json.php">マップに追加・更新</a>
      </p>
      <p>
      <a href="../spot_form/input_new.php">観光地登録フォーム(新規登録)へ</a>
      </p>
      <p>
      <a href="../spot_form/input.php">観光地登録フォームへ</a>
      </p>
      <p>
      <a href="../camera/camera_input.php">ライブカメラ登録フォームへ</a>
      </p>
      <p>
       <a href="../camera/camera.php">カメラ登録一覧へ</a>
      </p>
      <p>
      <a href="../spot/spot_new.php">BD保管された観光地一覧へ</a>
      </p>
       
        
        
       

         <form action="../manager/manager_logout.php" method="POST">
         <input type="submit" name="logout" value="ログアウト">
         </form>
      </div>
  </body>
</html>
