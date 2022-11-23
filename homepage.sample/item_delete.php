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
            $sql = 'DELETE FROM item WHERE id=:id';
            // PDOStatementクラスのインスタンスを生成します
            $prepare = $dbh->prepare($sql);
            
            // :〇〇と記載されているSQLの部分を置き換える処理
            $prepare->bindValue(':id', $id, PDO::PARAM_INT);
            
            // プリペアドステートメントを実行する
            $prepare->execute();
            
            header("location: item_list.php");
        }
        
        // SQL文を準備します
        $sql = 'SELECT * FROM item WHERE id=:id';
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
            $image_path = $val["image_path"];
            $item_num = $val["item_num"];
            $item_unit = $val["item_unit"];
            $price = $val["price"];
            $item_kind = $val["item_kind"];
        }
     } catch (PDOException $e) {
         exit($e->getMessage());
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>商品削除</title>
    </head>
    <body>
        <form action="item_delete.php?id=<?php echo $val["id"]; ?>" method="post">
            商品名：<?php echo $name; ?></br>
            商品画像：<?php echo $image_path; ?></br>
            商品個数：<?php echo $item_num; ?></br>
            商品の単位：<?php echo $item_unit; ?></br>
            商品の金額：<?php echo $price; ?></br>
            種別：<?php if ($item_kind == 0) { echo "加工品"; } else { echo "未加工品"; } ?></br>
            <a href="item_list.php">一覧に戻る</a>
            <input type="submit" name="del_btn" value="削除">
        </form>
    </body>
</html>