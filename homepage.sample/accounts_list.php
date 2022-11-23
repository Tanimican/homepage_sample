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
        
        // PDO::FETCH_ASSOCは、連想配列として取得します。
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
         exit($e->getMessage());
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="homepage_sample.css">
        <title>アカウント一覧</title>
    </head>
    <body>
        <p>アカウント一覧</p>
        <table border="1">
            <tr>
                <th>No</th>
                <th>アカウント名</th>
                <th>メールアドレス</th>
                <th>パスワード</th>
            </tr>
            </tr>
            <?php
                foreach ($result as $key => $val) {
                    // 文字数を調べる
                    $count = strlen($val["image_path"]);
            ?>
            <tr>
            <tr>
                <td><?php echo $val["id"]; ?></td>
                <td><?php echo $val["name"]; ?></td>
                <td><?php echo $val["email"]; ?></td>
                <td><?php echo $val[""]; ?></td>
                <td>
                    <a href="login_update.php?id=<?php echo $val["id"]; ?>">更新</a>
                    <a href="login_delete.php?id=<?php echo $val["id"]; ?>">削除</a>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        <a href="login_entry.php">新規登録</a>
        <a href="login2.php">ログイン画面</a>
    </body>
</html>