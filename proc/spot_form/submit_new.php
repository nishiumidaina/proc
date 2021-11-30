<?php
//テスト用登録フォーム
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

    $sql = 'INSERT INTO 登録情報 (登録観光地名, 登録緯度, 登録経度, 登録住所, 登録電話番号, 登録観光地説明, 登録画像) VALUES (:spotname, :lat, :long, :address, :tel, :spot_ex, :spot_img)';

    //観光地画像データ（ディレクトリに保存）
    $spot_filename = $_FILES['spot_img']['name'];
    $spot_filedata = $_FILES['spot_img']['tmp_name'];
    $spot_storeDir = 'C:/xampp/htdocs/proc/img/';
    move_uploaded_file($spot_filedata,$spot_storeDir.$spot_filename);

    // DBに保存
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':spotname', $_POST['spotname']);
    $stmt->bindValue(':lat', $_POST['lat']);
    $stmt->bindValue(':long', $_POST['long']);
    $stmt->bindValue(':address', $_POST['address']);
    $stmt->bindValue(':tel', $_POST['tel']);
    $stmt->bindValue(':spot_ex', $_POST['spot_ex']);
    $stmt->bindValue(':spot_img', $spot_filename);
    $stmt->execute();
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
    <title>観光地登録</title>
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
<a href="../json/json.php">登録済み観光地一覧へ</a>
<a href="./input.php">登録フォームへ</a>
</div>
</body>
</html>
