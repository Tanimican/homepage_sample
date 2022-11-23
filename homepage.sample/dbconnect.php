<?php
    //ドライバ呼び出しを使用して MySQL データベースに接続します
    $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
    $user = 'admin';
    $password = 'Samurai$1';
    
    try {
        // PHPからデータベースに接続する
        $dbh = new PDO($dsn, $user, $password);
        // SQL文を準備します
        $sql = 'SELECT * FROM accounts_list';
        // PDOStatementクラスのインスタンスを生成します
        $prepare = $dbh->prepare($sql);
        
        // プリペアドステートメントを実行する
        $prepare->execute();
    }   catch (PDOException $e) {
        echo "データベース接続エラー　：".$e->getMessage();
    }
?>