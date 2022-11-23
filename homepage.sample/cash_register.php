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
        <h1 class="title_1">購入手続き<br>
        支払い方法を選んでください</h1>
        <form name="testForm">
          <label><input type="checkbox" name="cardPayment">カードで支払い</label>
          <div id="card-info" class="is-hidden">
            <p>カード表の12桁の数字を入力してください</p>
            <input type="text" name="cardNumber" placeholder="12桁の数字">
            <p>カード裏のPINコードを入力してください</p>
            <input type="text" name="cardPIN" placeholder="PINコード(3文字)">
          </div>
        </form>
        </p>
        <label><input type="checkbox" name="convenience">コンビニで支払い</label>
        <h1 class="title_1">配送方法の選択</h1>
        <p class="cash_register">佐川急便<br>
        ※配送料金は地域によって異なります<br>
        料金一覧は<a href="shipping_fee.html">こちら</a>
        <input type="radio" name="delivery" value="配送方法">
        <input type="button" onclick="location.href='./cart.php'" value="カートの中身を確認する">
        <input type="button" onclick="location.href='/homepage.sample/purchase.php'" value="購入確認画面">
      </div>
    </div>
    <div class="sp-copyright">Copyright © 2022 Corporation all rights reserved.</div>
    <script>
    // 必要な要素を取得
    const cardInfoContainer = document.querySelector('#card-info');
    const testForm = document.testForm;
    const cardPayment = document.testForm.cardPayment;
    const cardNumber = document.testForm.cardNumber;
    const cardPIN = document.testForm.cardPIN;
    
    // チェックボックスのチェック状態が切り替わった時にイベント発火
    cardPayment.addEventListener('change', toggleCardInfo, false);
    
    // カード情報入力欄の有効化／無効化を切り替える関数
    function toggleCardInfo(event) {
      // チェックが入っているかどうかの判定
      const isChecked = event.target.checked;
    
      // チェックが入ったら
      if (isChecked) {
        cardInfoContainer.classList.remove('is-hidden'); // is-hiddenクラスを外す（表示させる）
        cardNumber.required = true; // カード番号入力欄を必須項目にする
        cardPIN.required = true; // PINコード入力欄を必須項目にする
      } else { // チェックがはずれたら
        cardInfoContainer.classList.add('is-hidden'); // is-hiddenクラスをつける（非表示にする）
        cardNumber.required = false; // カード番号入力欄を任意にする
        cardPIN.required = false; // PINコード入力欄を任意にする
      }
    }
    </script>
</body>
</html>