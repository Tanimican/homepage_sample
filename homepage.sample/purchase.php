<?php
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="homepage_sample.css">
  <title>養鶏公式サイト</title>
</head>
<body>
    <div class="top">
      <div class="title" id="title">養鶏公式サイト</div>
      <div id="subtitle">
        <a href="homepage1.html#title">home</a>
        /
        <a href="homepage1.html#title_1">お知らせ</a>
        /
        <a href="homepage2.html#title">企業情報</a>
        /
        <a href="homepage1.html#title">お問い合わせ</a>
        /
        <a href="homepage3.html#title">事業説明</a>
        /
        <a href="homepage4_shop.php#title">ショップ</a>
      </div>
    </div>
    <div class="top">
      <div class="sidemenu">
        <ul>
          <h4>部署種類</h4>
          <li><a href="homemenu_side1.html#title">加工工場</a></li>
          <li><a href="homemenu_side2.html#title">肥育農場</a></li>
          <li><a href="homemenu_side3.html#title">種鶏農場</a></li>
          <li><a href="homemenu_side4.html#title">機動・サービス班</a></li>
          <li><a href="homemenu_side5.html#title">孵卵場</a></li>
        </ul>
      </div>
      <div class="corporateinformation">
        <h1 class="title_1">購入する品を確認してください<br>
        間違いはありませんか？<br>
        間違いがなければ購入確定ボタンを押してください</h1>
        <h1 class="title_1">カートの中身
          <div class="cart-table">
            <table border="1" style="border-collapse: collapse">
            <thead>
              <tr>
                <th>商品名</th>
                <th>価格</th>
                <th>個数</th>
                <th>小計</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $total = 0;
                foreach ($_SESSION['products'] as $key => $val) {
                  $subtotal = $val['price'] * $val['count'];
                  $total = $subtotal + $total;
              ?>
              <tr>
                <td label="商品名:"><?php echo $key; ?></td>
                <td label="価格:" class="text-right"><?php echo $val['price']; ?></td>
                <td label="個数:" class="text-right"><?php echo $val['count']; ?></td>
                <td label="小計:" class="text-right"><?php echo $subtotal; ?></td>
              </tr>
              <script type="text/javascript">
          		</script>
              <?php
                }
              ?>
              <tr class="total">
                <th colspan="">合計</th>
                <td colspan=""><?php echo $total; ?></td>
              </tr>
            </tbody>
            </table>
          </div>
        </h1>
        <input type="button" onclick="location.href='/homepage.sample/shop_completion.html'" value="購入確定">
        間違っていた場合は<a href="cart.php">こちら</a>
      </div>
    </div>
    <div class="sp-copyright">Copyright © 2022 Corporation all rights reserved.</div>
</body>
</html>