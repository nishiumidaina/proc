<?php
require_once '../dbconnect.php';

class SpotLogic
{
    /**
     *  観光地情報を登録
     * @param array $spotData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result= false;

        $sql = 'INSERT INTO 観光地情報 (観光地ID 観光地名, 緯度, 経度, 住所, 電話番号, 観光地説明, 画像, パズル画像) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
        //観光地データを配列に入れる
        $arr = [];
        $arr[] = $userData['spotid']; //spotid観光地ID
        $arr[] = $userData['spotname']; //spot観光地名
        $arr[] = $userData['lat']; //lat緯度
        $arr[] = $userData['long']; //long経度
        $arr[] = $userData['address']; //address住所
        $arr[] = $userData['tel']; //tel電話番号
        $arr[] = $userData['spot_ex']; //spot_ex観光地説明
        $arr[] = $userData['spot_img']; //img観光地画像
        $arr[] = $userData['pazzle_img']; //pazzle_imgパズル画像

        try{
            $stmt = connect()->prepare($sql);
            $result = $stmt->execute($arr);
  
            return $result;
          } catch(\Exception $e) {
            return $result;
          }


    }




}



?>