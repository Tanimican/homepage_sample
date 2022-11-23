<?php
//ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
$user = 'admin';
$password = 'Samurai$1';

try {
    // PHPからデータベースに接続する
    $dbh = new PDO($dsn, $user, $password);
    // SQL文を準備します。「:id」「:name」がプレースホルダーです。
    $sql = 'INSERT INTO poultryfarm (poultryfarm_1) VALUES (:poultryfarm_1)';
    // SQL文の実行準備
    $prepare = $dbh->prepare($sql);
    
    // :〇〇と記載されているSQLの部分を置き換える処理
    $prepare->bindValue(':poultryfarm_1', $_POST['inquiry'], PDO::PARAM_STR);
    // SQL文の実行
    $prepare->execute();
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}


// INSERTされたデータを確認します
/*
$sql = 'SELECT * FROM poultryfarm';
$prepare = $dbh->prepare($sql);

$prepare->execute();

$result = $prepare->fetchAll(PDO::FETCH_ASSOC);
var_dump($result);

// echo 〇〇; 文字列のみ表示が可能
// print(〇〇); 文字列のみ表示が可能
// print_r(〇〇); 配列の中身を表示、文字列も可能
// var_dump(〇〇); 配列の中身を表示、文字列も可能
*/
 echo "結果「".$_POST['inquiry']."」";
?>
