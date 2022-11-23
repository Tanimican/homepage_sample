<?php 
    require("./dbconnect.php");
    session_start();
     
    if (!empty($_POST)) {
        // 入力情報の不備を検知 
        if ($_POST['email'] === "") {
            $error['email'] = "blank";
        }
        if ($_POST['password'] === "") {
            $error['password'] = "blank";
        }
        
        // メールアドレスの重複を検知 
        if (!isset($error)) {
            $member = $dbh->prepare('SELECT COUNT(*) as cnt FROM acoounts_list WHERE email=?');
            $member->execute(array(
                $_POST['email']
            ));
            $record = $member->fetch();
            if ($record['cnt'] > 0) {
                $error['email'] = 'duplicate';
            }
        }
     
        // エラーがなければ次のページへ 
        if (!isset($error)) {
            // フォームの内容をセッションで保存
            $_SESSION['join'] = $_POST;
            // login_check.phpへ移動
            header('Location: login_check.php');   
            exit();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylessheet" href="homepage_sample.css">
        <title>ログイン画面</title>
    </head>
    <body>
        <div class="signin">
            <form action="login_entry.php" method="POST">
                <h1>アカウント作成</h1><br>
                <div class="control">
                    <label for="name">ユーザー名</label>
                    <input id="name" type="text" name="name">
                </div>
                
                <div class="control">
                    <label for="email">メールアドレス<span class="required">必須</span></label>
                    <input id="email" type="email" name="email">
                    <?php if (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                        <p class="error">＊メールアドレスを入力してください</p>
                    <?php elseif (!empty($error["email"]) && $error['email'] === 'duplicate'): ?>
                        <p class="error">＊このメールアドレスはすでに登録済みです</p>
                    <?php endif ?>
                </div>
                
                <div class="control">
                    <label for="password">パスワード<span class="required">必須</span></label>
                    <input id="password" type="password" name="password">
                    <?php if (!empty($error["password"]) && $error['password'] === 'blank'): ?>
                        <p class="error">＊パスワードを入力してください</p>
                    <?php endif ?>
                </div>
                
                <div class="control">
                    <button type="submit" class="btn">確認する</button>
                </div>
            </form>
        </div>
    </body>
</html>