 <?php
    session_start();
    $id = $_GET["id"];
    $message = "";
    $err = array();
    setcookie("aaa", "bbb", time()+60*60, "/", "https://d05d5b7254674445a3aaf2d8293a0c4d.vfs.cloud9.ap-northeast-1.amazonaws.com", true, true);
    if ($_POST["send"] == "送信") {
        // 入力チェック
        $name = $_POST["name"];
        if ($name == "") {
            $err["name"] = "入力してください";
        }
        
        // ファイル選択の情報を受け取る
        $image_path = $_FILES["image_path"];
        
        $image_path_name = "";
        if ($image_path != "") {
            // ファイル名とパスを指定して受け取る
            $image_path_name = './image/' . $image_path["name"];
            
            // 一時保存場所から指定された場所にファイルを移動する
            rename($image_path["tmp_name"], $image_path_name);
        }
        
        $item_num = $_POST["item_num"];
        if ($item_num == "") {
            $err["item_num"] = "入力してください";
        }
        $item_unit = $_POST["item_unit"];
        if ($item_unit == "") {
            $err["item_unit"] = "入力してください";
        }
        $price = $_POST["price"];
        if ($price == "") {
            $err["price"] = "入力してください";
        }
        $item_kind = $_POST["item_kind"];
        if ($item_kind == "") {
            $err["item_kind"] = "入力してください";
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
                $sql = 'INSERT INTO item (name, image_path, item_num, item_unit, price, item_kind, in_date, up_date) 
                        VALUES (:name, :image_path, :item_num, :item_unit, :price, :item_kind, now(), now())';
                // SQL文の実行準備
                $prepare = $dbh->prepare($sql);
                
                // :〇〇と記載されているSQLの部分を置き換える処理
                $prepare->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
                $prepare->bindValue(':image_path', $image_path_name, PDO::PARAM_STR);
                $prepare->bindValue(':item_num', $_POST['item_num'], PDO::PARAM_STR);
                $prepare->bindValue(':item_unit', $_POST['item_unit'], PDO::PARAM_STR);
                $prepare->bindValue(':price', $_POST['price'], PDO::PARAM_STR);
                $prepare->bindValue(':item_kind', $_POST['item_kind'], PDO::PARAM_STR);
                // SQL文の実行
                $prepare->execute();
                
                // 登録完了メッセージ
                $message = "登録が完了しました";
            } catch (PDOException $e) {
                echo "接続失敗: " . $e->getMessage() . "\n";
                exit();
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
       <link rel="stylesheet" href="homepage_sample.css"> 
    </head>
    <body>
        <div style="color:blue; font-size:16"><?php echo $message; ?></div>
        <form action="item_new.php" method="post" enctype="multipart/form-data" id="item">
            商品名<br><input type="text" name="name" value="<?php echo $name; ?>" id="name"><div style="color:red"><?php echo $err["name"]; ?></div><br>
            商品画像<br><input type="file" name="image_path" id="image_path"><br>
            商品数<br><input type="text" name="item_num" value="<?php echo $item_num; ?>" id="item_num"><div style="color:red"><?php echo $err["item_num"]; ?></div><br>
            商品の単位<br><input type="text" name="item_unit" value="<?php echo $item_unit; ?>" id="item_unit"><div style="color:red"><?php echo $err["item_unit"]; ?></div><br>
            金額<br><input type="text" name="price" value="<?php echo $price; ?>" id="price">円<div style="color:red"><?php echo $err["price"]; ?></div><br>
            種別<br><input type="radio" name="item_kind" value="0" <?php if ($item_kind == 0) { echo "checked"; } ?> > 加工品
            <input type="radio" name="item_kind" value="1" <?php if ($item_kind == 1) { echo "checked"; } ?> id="item_kind"> 未加工品<br>
            <a href="item_list.php">一覧に戻る</a>
            <input type="submit" name="send" value="送信" id="send">
        </form>
    </body>
</html>