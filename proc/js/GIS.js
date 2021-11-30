var mymap = L.map('mapid').setView([35.7102, 139.8132], 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 18,
  attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, '
}).addTo(mymap);
const url = "../json/tourist.json";   
var user_lat,user_lng;
//コンソールにjsonのデータを表示（確認用）
$.getJSON(url, (data) => {
    for (let i=0; i<data.length; i++){
        console.log(`観光地ID=${data[i].観光地ID},観光地名=${data[i].観光地名}, 緯度=${data[i].緯度}, 経度=${data[i].経度}, 住所=${data[i].住所}, 電話番号=${data[i].電話番号}, 観光地説明=${data[i].観光地説明}, 観光地画像=${data[i].観光地画像}, パズル画像=${data[i].パズル画像}`);

        //変数に入れる
        const spot_id = data[i].観光地ID;
       	const spot = data[i].観光地名;
        const lat = data[i].緯度;
        const long = data[i].経度;
        const address = data[i].住所;
        const tel = data[i].電話番号;
        const spot_ex = data[i].観光地説明;
        const spot_img = data[i].画像;
        const pazzle_img = data[i].パズル画像;

        //マーカーを値がなくなるまで表示
        var s_img = "<img src=../img/"+ spot_img +" style='width:100px;'>"
        var p_img = "<img src=../img/"+ pazzle_img +" style='width:100px;'>"
        var newline = "<br>"

        var marker = L.marker([lat, long]).addTo(mymap);
        marker.bindPopup(spot_id + newline + spot + newline + address + newline + tel + newline + spot_ex + newline + s_img + newline + p_img).openPopup();


        p_lat = parseFloat(lat)
        p_long =parseFloat(long)
        p_range =parseFloat(0.0025)
        //仮の範囲誤差半径250mをコンソールに表示（確認用）
        const spot_lat_up = p_lat + p_range;
        const spot_lat_down = lat - 0.0025;
        const spot_long_up = p_long + p_range;
        const spot_long_down = long - 0.0025;
        console.log(spot_lat_up);
        console.log(spot_lat_down);
        console.log(spot_long_up);
        console.log(spot_long_down);
    }
});
const url2 = "../json/camera.json";
$.getJSON(url2, (data2) => {
  for (let i=0; i<data2.length; i++){
      console.log(`カメラID=${data2[i].カメラID}, カメラ設置場所=${data2[i].カメラ設置場所}, 緯度=${data2[i].緯度}, 経度=${data2[i].経度}, 動画埋め込み=${data2[i].動画埋め込み}`);

      //変数に入れる
      const cameraid = data2[i].カメラID;
      const cameraname = data2[i].カメラ設置場所;
      const camera_lat = data2[i].緯度;
      const camera_long = data2[i].経度;
      const movie = data2[i].動画埋め込み;

      //マーカーを値がなくなるまで表示
      var camera_movie = movie
      var newline = "<br>"

      var marker = L.marker([camera_lat, camera_long]).addTo(mymap);
      marker.bindPopup(cameraname + newline + camera_movie).openPopup();
  }
});




function setCurLocation(){
  // ユーザーの端末がGeoLocation APIに対応しているかの判定

  // 対応している場合
  if( navigator.geolocation )
  {
    // 現在地を取得
    navigator.geolocation.getCurrentPosition(

      // [第1引数] 取得に成功した場合の関数
      function( position )
      {
        // 取得したデータの整理
        var data = position.coords ;

        // データの整理
        var play_lat = data.latitude ;//プレイヤーの緯度
        var play_lng = data.longitude ;//プレイヤーの経度

        // アラート表示
        alert( "あなたの現在位置は、\n[" + play_lat + "," + play_lng + "]\nです。" ) ;

        //マーカーに反映
        mymap.setView([play_lat, play_lng], 15);
        var marker2 = L.marker([play_lat, play_lng]).addTo(mymap);
  

        $.getJSON(url, (data) => {
          for (let i=0; i<data.length; i++){
              console.log(`観光地ID=${data[i].観光地ID},観光地名=${data[i].観光地名}, 緯度=${data[i].緯度}, 経度=${data[i].経度}, 住所=${data[i].住所}, 電話番号=${data[i].電話番号}, 観光地説明=${data[i].観光地説明}, 観光地画像=${data[i].観光地画像}, パズル画像=${data[i].パズル画像}`);

              //変数に入れる
              const spot_id = data[i].観光地ID;
              const spot = data[i].観光地名;
              const lat = data[i].緯度;
              const long = data[i].経度;
              const address = data[i].住所;
              const tel = data[i].電話番号;
              const spot_ex = data[i].観光地説明;
              const spot_img = data[i].画像;
              const pazzle_img = data[i].パズル画像;

              p_lat = parseFloat(lat)
              p_long =parseFloat(long)
              p_range =parseFloat(0.0025)
              //仮の範囲誤差半径250mをコンソールに表示（確認用）
              const spot_lat_up = p_lat + p_range;
              const spot_lat_down = lat - 0.0025;
              const spot_long_up = p_long + p_range;
              const spot_long_down = long - 0.0025;
      
              console.log(spot_lat_up);
              console.log(spot_lat_down);
              console.log(spot_long_up);
              console.log(spot_long_down);

              console.log(play_lat);
              console.log(play_lng);   

              if(play_lat <= spot_lat_up && spot_lat_down <= play_lat && play_lng <= spot_long_up && spot_long_down <= play_lng){
                alert('パズルを獲得しました！');

                const data = spot_id; // 渡したいデータ
  
                $.ajax({
                    type: "POST", //　GETでも可
                    url: "pazzle_get.php", //　送り先
                    data: { '観光地データ': data }, //　渡したいデータをオブジェクトで渡す
                    dataType : "json", //　データ形式を指定
                    scriptCharset: 'utf-8' //　文字コードを指定
                })
                .then(
                    function(param){　 //　paramに処理後のデータが入って戻ってくる
                        console.log(param); //　帰ってきたら実行する処理
                    },
                    function(XMLHttpRequest, textStatus, errorThrown){ //　エラーが起きた時はこちらが実行される
                        console.log(XMLHttpRequest); //　エラー内容表示
                });
              }
            }         
      });
        // マーカーの新規出力
        /*new google.maps.Marker( {
          map: map ,
          position: latlng ,
        } ) ;*/
      },

      // [第2引数] 取得に失敗した場合の関数
      function( error )
      {
        // エラーコード(error.code)の番号
        // 0:UNKNOWN_ERROR				原因不明のエラー
        // 1:PERMISSION_DENIED			利用者が位置情報の取得を許可しなかった
        // 2:POSITION_UNAVAILABLE		電波状況などで位置情報が取得できなかった
        // 3:TIMEOUT					位置情報の取得に時間がかかり過ぎた…

        // エラー番号に対応したメッセージ
        var errorInfo = [
          "原因不明のエラーが発生しました…。" ,
          "位置情報の取得が許可されませんでした…。" ,
          "電波状況などで位置情報が取得できませんでした…。" ,
          "位置情報の取得に時間がかかり過ぎてタイムアウトしました…。"
        ] ;

        // エラー番号
        var errorNo = error.code ;

        // エラーメッセージ
        var errorMessage = "[エラー番号: " + errorNo + "]\n" + errorInfo[ errorNo ] ;

        // アラート表示
        alert( errorMessage ) ;

        // HTMLに書き出し
        document.getElementById("result").innerHTML = errorMessage;
      } ,

      // [第3引数] オプション
      {
        "enableHighAccuracy": false,
        "timeout": 8000,
        "maximumAge": 2000,
      }

    ) ;
  }

  // 対応していない場合
  else
  {
    // エラーメッセージ
    var errorMessage = "お使いの端末は、GeoLacation APIに対応していません。" ;

    // アラート表示
    alert( errorMessage ) ;

    // HTMLに書き出し
    document.getElementById( 'result' ).innerHTML = errorMessage ;
  }

}/*
//鎌倉若宮大路段葛のライブカメラ
var camera =" <iframe width='300' height='200' src='https://www.youtube.com/embed/bcScSrq9szA' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>"
var newline = "<br>"
var marker = L.marker([35.32201, 139.55376]).addTo(mymap);
marker.bindPopup("鎌倉若宮大路段葛のライブカメラ" + newline + camera).openPopup();

var camera2 ='"<iframe width="560" height="315" src="https://www.youtube.com/embed/bcScSrq9szA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>"'
var marker = L.marker([1, 1]).addTo(mymap);
marker.bindPopup("鎌倉若宮大路段葛のライブカメラ" + newline + camera2).openPopup();
*/


        //使用しない
        //var alt = data.altitude ;
        //var accLatlng = data.accuracy ;
        //var accAlt = data.altitudeAccuracy ;
        //var heading = data.heading ;			//0=北,90=東,180=南,270=西
        //var speed = data.speed ;