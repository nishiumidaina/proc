<!DOCTYPE HTML>
<html lang ="ja">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link href="../css/main.css"rel="stylesheet" >
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<meta charset="utf-8">
<title>観光地登録フォーム</title>
<style>
h1 {
  margin-left: 50px;
}
th {
  width: 200px;
  margin: 10px 0;
}
input#send {
  margin-left: 100px;
  margin-top: 30px;
}
</style>
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
<h1>観光地登録フォーム</h1>
<h5>こちらのフォームは地図に観光地を登録する際ご利用ください。</h5>
<form method="POST" action="submit2.php" enctype="multipart/form-data">
<p>
<label for="spotname">観光地名：<label>    
<input type="text" name="spotname" placeholder="観光地名">
</p>
<p>
<label for="spotid">パズル番号：<label>    
<input type="text" name="spotid"  placeholder="パズル番号">
</p>
<p>
<label for="pazzlw_img">パズル画像：<label>
<input type="file" name="pazzle_img">
</p>

<input type="submit" value="送信する" class="btn btn-primary" name="signup">
</form>
</br>
<a href="../json/json.php">登録済み観光地一覧へ</a>
<a href="../camera/camera_input.php">ライブカメラ登録フォームへ</a>
</div>
</body>
</html>