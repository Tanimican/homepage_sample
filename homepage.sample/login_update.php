<?php
    session_start();
    $id = $_GET["id"];
    $message = "";
    echo $_SESSION["sample"];
    echo $_COOKIE["aaa"];
    if ($_POST["send"] == "送信") {
        $err = array();
        // 入力チェック
        $name = $_POST["name"];
        if ($name == "") {
            $err["name"] = "入力してください";
        }
        
        $email = $_POST["email"];
        if ($email == "") {
            $err["email"] = "入力してください";
        }
        
        $password = $_POST["password"];
        if ($password == "") {
            $err["password"] = "入力してください";
        }
       
        // エラーがなければ更新処理
        if (count($err) == 0) {
            //ドライバ呼び出しを使用して MySQL データベースに接続します
            $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
            $user = 'admin';
            $password = 'Samurai$1';
            try {
                // PHPからデータベースに接続する
                $dbh = new PDO($dsn, $user, $password);
                // SQL文を準備します。「:id」「:name」がプレースホルダーです。
                $sql = 'UPDATE accounts_list SET name=:name, email=:email, password=:password, up_date=now() WHERE id=:id';
                // SQL文の実行準備
                $prepare = $dbh->prepare($sql);
                
                // :〇〇と記載されているSQLの部分を置き換える処理
                $prepare->bindValue(':name', $name, PDO::PARAM_STR);
                $prepare->bindValue(':email', $email, PDO::PARAM_STR);
                $prepare->bindValue(':password', $password, PDO::PARAM_STR);
                $prepare->bindValue(':id', $id, PDO::PARAM_STR);
                // SQL文の実行
                $prepare->execute();
                
                // 更新完了メッセージ
                $message = "更新が完了しました";
            } catch (PDOException $e) {
                echo "接続失敗: " . $e->getMessage() . "\n";
                exit();
            }
        }
        
    } else {
        //ドライバ呼び出しを使用して MySQL データベースに接続します
        $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
        $user = 'admin';
        $password = 'Samurai$1';
        
        try {
            // PHPからデータベースに接続する
            $dbh = new PDO($dsn, $user, $password);
            
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
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
       <link rel="stylesheet" href="homepage_sample.css"> 
    </head>
    <body>
        <div style="color:blue; font-size:16px;"><?php echo $message; ?></div>
        <form action="login_update.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" id="account">
            アカウント名<br><input type="text" name="name" value="<?php echo $name; ?>" id="name"><div style="color:red"><?php echo $err["name"]; ?></div><br>
            メールアドレス<br><input type="email" name="email" value="<?php echo $email; ?>" id="email"><div style="color:red"><?php echo $err["email"]; ?></div><br>
            パスワード<br><input type="password" name="password" value="<?php echo $password; ?>" id="password"><div style="color:red"><?php echo $err["password"]; ?></div><br>
            <a href="accounts_list.php">一覧に戻る</a>
            <input type="submit" name="send" value="送信" id="send">
        </form>
    </body>
</html>