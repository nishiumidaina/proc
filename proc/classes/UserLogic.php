<?php

require_once '../dbconnect.php';

class UserLogic
{
    /**
     *  ユーザを登録
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result= false;

        $sql = 'INSERT INTO ユーザ情報 (ユーザ名, メールアドレス, パスワード) VALUES (?, ?, ?)';

        //ユーザデータを配列に入れる
        $arr = [];
        $arr[] = $userData['username']; //name
        $arr[] = $userData['email']; //email
        $arr[] = password_hash($userData['password'],PASSWORD_DEFAULT); //password

        try{
          $stmt = connect()->prepare($sql);
          $result = $stmt->execute($arr);

          return $result;
        } catch(\Exception $e) {
          return $result;
        }

    }

    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email, $password)
    {
        //結果
        $result = false;
        //ユーザをemailから検索して取得
        $user = self::getUserByEmail($email);

        if (!$user) {
            $_SESSION['msg'] = 'emailが一致しません。';
            return $result;
        }

        //パスワードの照会
        if (password_verify($password, $user['パスワード'])){
            //ログイン成功
            session_regenerate_id(true);
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        }

        $_SESSION['msg'] = 'パスワードが一致しません。';
        return $result;
    }

    /**
     * emailからユーザを取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email)
    {
        //SQL準備
        //SQL実行
        //SQLの結果を返す

        $sql = 'SELECT * FROM ユーザ情報 WHERE メールアドレス = ?';

        //ユーザデータを配列に入れる
        $arr = [];
        $arr[] = $email; //name


        try{
          $stmt = connect()->prepare($sql);
          $stmt->execute($arr);
          //SQLの結果を返す
          $user = $stmt->fetch();
          return $user;
        } catch(\Exception $e) {
          return false;
        }
    }
    
  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin()
  {
    $result = false;
    
    // セッションにログインユーザが入っていなかったらfalse
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['ユーザID'] > 0) {
      return $result = true;
    }

    return $result;

  }

   /**
   * ログアウト処理
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();
  }
}