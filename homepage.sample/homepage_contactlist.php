<?php
    //ドライバ呼び出しを使用して MySQL データベースに接続します
    $dsn = 'mysql:dbname=poultryfarm;host=db-test.c1jerjgeqabg.ap-northeast-1.rds.amazonaws.com';
    $user = 'admin';
    $password = 'Samurai$1';
    
    try {
        // PHPからデータベースに接続する
        $dbh = new PDO($dsn, $user, $password);
        // SQL文を準備します
        $sql = 'SELECT * FROM poultryfarm';
        // PDOStatementクラスのインスタンスを生成します
        $prepare = $dbh->prepare($sql);
        
        // プリペアドステートメントを実行する
        $prepare->execute();
        
        // PDO::FETCH_ASSOCは、連想配列として取得します。
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        
        /*
        $a = array(
                array('1', '2', '3'),
                array('1', '2', '3'),
                array('1', '2', '3')
             );
        
        $a[0][0] = 1;
        $a[0][1] = 2;
        $a[0][2] = 3;
        $a[1][0] = 1;
        $a[1][1] = 2;
        $a[1][2] = 3;
        $a[2][0] = 1;
        $a[2][1] = 2;
        $a[2][2] = 3;
        
        for ($i=0; $i < count($result); $i++)) {
            $result[$i]["poultryfarm_1"];
        }
        
        foreach ($result as $val) {
            $val["poultryfarm_1"];
        }
        
        */
     } catch (PDOException $e) {
         exit($e->getMessage());
     }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>お問い合わせ一覧</title>
    </head>
    <body>
        <table border="1">
            <tr>
                <th>No</th>
                <th>内容</th>
                <th>操作</th>
            </tr>
            <?php
                foreach ($result as $key => $val) {
            ?>
            <tr>
                <td><?php echo $key+1; ?></td>
                <td><?php echo $val["poultryfarm_1"]; ?></td>
                <td>
                    <a href="">更新</a>
                    <a href="">削除</a>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </body>
</html>