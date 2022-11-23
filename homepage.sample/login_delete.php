<?php
    $id = $_GET["id"];
    $message = "";
    
    //ドライバ呼び出しを使用して MySQL データベースに接続します
    $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
    $user = 'admin';
    $password = 'Samurai$1';
    
    try {
        // PHPからデータベースに接続する
        $dbh = new PDO($dsn, $user, $password);
        
        if ($_POST["del_btn"] == "削除") {
            // SQL分を準備します
            $sql = 'DELETE FROM accounts_list WHERE id=:id';
            // PDOStatementクラスのインスタンスを生成します
            $prepare = $dbh->prepare($sql);
            
            // :〇〇と記載されているSQLの部分を置き換える処理
            $prepare->bindValue(':id', $id, PDO::PARAM_INT);
            
            // プリペアドステートメントを実行する
            $prepare->execute();
            
            header("location: accounts_list.php");
        }
        
        // SQL文を準備します
        $sql = 'SELECT * FROM accounts_list WHERE id=:id';
        // PDOStatementクラスのインスタンスを生成します
        $prepare = $dbh->prepare($sql);
        
        // :〇〇と記載されているSQLの部分を置き換える処理
        $prepare->bindValue(':id', $id, PDO::PARAM_INT);
        
        // プリペアドステートメントを実行する
        $prepare->execute();
        
        // PDO::FETCH_ASSOCは、連想配列として取得します。
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($result as $val) {
            $name = $val["name"];
            $email = $val["email"];
            $password = $val["password"];
        }
     } catch (PDOException $e) {
         exit($e->getMessage());
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>アカウント削除</title>
    </head>
    <body>
        <form action="login_delete.php?id=<?php echo $val["id"]; ?>" method="post">
            アカウント名：<?php echo $name; ?></br>
            メールアドレス：<?php echo $email; ?></br>
            パスワード：<?php echo $password; ?></br>
            <a href="accounts_list.php">一覧に戻る</a>
            <input type="submit" name="del_btn" value="削除">
        </form>
    </body>
</html>