<?php 
    require("./dbconnect.php");
    session_start();
    $error = array();
    if (!empty($_POST)) {
        /* 入力情報の不備を検知 */
        if ($_POST['email'] === "") {
            $error['email'] = "blank";
        }
        if ($_POST['password'] === "") {
            $error['password'] = "blank";
        }
        /* メールアドレスの重複を検知 */
        if (empty($error)) {
            $member = $dbh->prepare('SELECT COUNT(*) as cnt FROM accounts_list WHERE email=?');
            $member->execute(array(
                $_POST['email']
            ));
            $record = $member->fetch();
            if (!password_verify($_POST['password'], $result['password'])) {
                $error['email'] = 'メールアドレスもしくはパスワードに誤りがあります';
            }
        }
     
        /* エラーがなければ次のページへ */
        if (empty($error)) {
            $_SESSION['login'] = $_POST;   // フォームの内容をセッションで保存
            // 成功したらトップページに戻る
            header('Location: login3.php');
            exit();
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="homepage_sample.css">
        <title>ログイン画面</title>
    </head>
    <body>
        <div class="signin">
        　　<form action="" method="POST">
                <h1>ログイン</h1>
                <div class="control">メールアドレス</label>
                <input id="email" type="email" name="email">
                <?php
                if ($error["email"] != "") {
                    echo $error["email"];
                }
                ?>
                </div>
                <div class="control">
                    <label for="password">パスワード</label>
                    <input id="password" type="password" name="password">
            　　</div>
            　　<div>
                    <input type="submit" name="login_btn" value="ログイン">
                    <a href="login_entry.php">新規アカウント登録</a>
            　　</div>
            </form>
        </div>
    </body>
</html>