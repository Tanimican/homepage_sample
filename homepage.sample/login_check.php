<?php
require("./dbconnect.php");
session_start();

// 会員登録の手続き以外のアクセスを飛ばす
if (!isset($_SESSION['join'])) {
    header('Location: login_entry.php');
    exit();
}

if (!empty($_POST['check'])) {
    //パスワードを暗号化
    $hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);
    
    //入力情報をデータベースに登録
    $statement = $dbh->prepare("INSERT INTO accounts_list SET name=?, email=?, password=?");
    $statement->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        $hash
        ));
        
        //セッションを破棄
        unset($_SESSION['join']);
        //login_thank.phpへ移動
        header('Location: login_thank.php');
        exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="vieport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>確認画面</title>
    <link rel="stylesheet" href="css/homepage_sample.css">
</head>
</head>
<body>
    <div class="content">
        <form action="login_check.php" method="POST">
            <input type="hidden" name="check" value="checked">
            <h1>入力情報の確認</h1>
            <p>ご入力情報に変更が必要な場合、下のボタンを押し、変更を行ってください</p>
            <p>登録情報は後から変更することもできます</p>
            <?php if (!empty($error) && $error === "error"): ?>
                <p class="error">＊会員登録に失敗しました。</p>
            <?php endif ?>
            <hr>
            
            <div class="control">
                <p>ニックネーム</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?></span></p>
            </div>
            
            <div class="control">
                <p>メールアドレス</p>
                <p><span class="fas fa-angle-double-right"></span> <span class="check-info"><?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?></span></p>
            </div>
            
            <br>
            <a href="login_entry.php" class="back-btn">変更する</a>
            <button type="submit" class="btn next-btn">登録する</button>
            <div class="clear"></div>
        </form>
    </div>
</body>
</html>