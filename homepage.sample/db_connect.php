<?php
Class Common {
    function db_connect() {
        //ドライバ呼び出しを使用して MySQL データベースに接続します
        $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
        $user = 'admin';
        $password = 'Samurai$1';
        
        try {
            // PHPからデータベースに接続する
            $dbh = new PDO($dsn, $user, $password);
            return $dbh;
         } catch (PDOException $e) {
             exit($e->getMessage());
         }
    }
    
    function db_select() {
        
    }
}
?>