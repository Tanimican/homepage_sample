<?php
    session_start();
    if ($_SESSION["login"]["email"] == "") {
        header("location: login2.php");
    }
    //ドライバ呼び出しを使用して MySQL データベースに接続します
    $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
    $user = 'admin';
    $password = 'Samurai$1';
    
    try {
        // PHPからデータベースに接続する
        $dbh = new PDO($dsn, $user, $password);
        // SQL文を準備します
        $sql = 'SELECT * FROM item';
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
        <title>商品一覧</title>
    </head>
    <body>
        <a href="item_new.php">新規追加</a>
        <table border="1">
            <tr>
                <th>No</th>
                <th>商品名</th>
                <th>商品画像</th>
                <th>商品個数</th>
                <th>商品の単位</th>
                <th>商品の金額</th>
                <th>種別</th>
                <th>操作</th>
            </tr>
            <?php
                foreach ($result as $key => $val) {
                    // 文字数を調べる
                    $count = strlen($val["image_path"]);
            ?>
            <tr>
                <td><?php echo $val["id"]; ?></td>
                <td><?php echo $val["name"]; ?></td>
                <td>
                    <?php
                        if ($count > 0) {
                    ?>
                        <img src="<?php echo $val["image_path"]; ?>" width="150px" height="150px">
                    <?php } ?>
                    <?php
                        // if ($count > 0) {
                        //     echo "<img src=\"" . $val["image_path"] . "\" width=\"150px\" height=\"150px\">";
                        // }
                    ?>
                </td>
                <td><?php echo $val["item_num"]; ?></td>
                <td><?php echo $val["item_unit"]; ?></td>
                <td><?php echo $val["price"]; ?></td>
                <td><?php if ($val["item_kind"] == 0) { echo "加工品"; } else { echo "未加工品"; } ?></td>
                <td>
                    <a href="item_update.php?id=<?php echo $val["id"]; ?>">更新</a>
                    <a href="item_delete.php?id=<?php echo $val["id"]; ?>">削除</a>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>