<?php
    // お問い合わせ内容を表示する
    $info = $_POST['inquiry'] . "<br>この内容で間違いないですか？";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <body>
        <form action="homepage_inquiry_2.php" method="post" target="_blank" name="inquiry">
            <?php
                 echo $info;
            ?>
            <input type="hidden" name="inquiry" value="<?php echo $_POST['inquiry']; ?>">
            <input type="submit" value="確認">
        </form>
        <table>

            <?php
                 // 配列の中身を順番に取り出し、表形式で出力する
                foreach ($results as $result) {
                 $table_row = "
                     <tr>
                     <td>{$result['poultryfarm_1']}</td>                                             
                     </tr>
                 ";
                 echo $table_row;
                }
            ?>
        </table>
        <a href="homepage1.html#title">homeに戻る</a>
    </body>

</html>
