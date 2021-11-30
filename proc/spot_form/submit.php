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
   $name= $_POST['spotname'];
    $stmt2 = $pdo->query('SELECT * FROM 登録情報 WHERE 登録観光地名 = "'. $name.'"');
    $result = 0;

    $result = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $user) {
 
        $lat = $user["登録緯度"];
        $long = $user["登録経度"];
        $address = $user["登録住所"];
        $tel = $user["登録電話番号"];
        $spot_ex = $user["登録観光地説明"];
        $spot_img = $user["登録画像"];
    }

    $sql = 'INSERT INTO 観光地情報 (観光地ID, 観光地名, 緯度, 経度, 住所, 電話番号, 観光地説明, 画像, パズル画像) VALUES (:spotid, :spotname, :lat, :long, :address, :tel, :spot_ex, :spot_img, :pazzle_img)';

    //パズル画像データ（ディレクトリに保存）
    $pazzle_filename = $_FILES['pazzle_img']['name'];
    $pazzle_filedata = $_FILES['pazzle_img']['tmp_name'];
    $pazzle_storeDir = 'C:/xampp/htdocs/proc/img/';
    move_uploaded_file($pazzle_filedata,$pazzle_storeDir.$pazzle_filename);

    // DBに保存
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':spotid', $_POST['spotid']);
    $stmt->bindValue(':spotname', $name);
    $stmt->bindValue(':lat', $lat);
    $stmt->bindValue(':long', $long);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':tel', $tel);
    $stmt->bindValue(':spot_ex', $spot_ex);
    $stmt->bindValue(':spot_img', $spot_img);
    $stmt->bindValue(':pazzle_img', $pazzle_filename);
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
<p>登録完了</p>
<a href="../json/json.php">登録済み観光地一覧へ</a>
<a href="./input.php">観光地の地図登録フォームへ</a>
<a href="./input.php">観光地の新規登録フォームへ</a>
</div>
</body>
</html>
