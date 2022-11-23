<?php
  $name = isset($_POST['name'])? htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8') : '';
  $price = isset($_POST['price'])? htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8') : '';
  $count = isset($_POST['count'])? htmlspecialchars($_POST['count'], ENT_QUOTES, 'utf-8') : '';
  
  session_start();
  // もし、sessionにproductsがあったら
  if(isset($_SESSION['products'])){
    // $_SESSION['products']を$productsという変数に入れる
    $products = $_SESSION['products'];
    // $productsをforeachで回し、キー（商品名）と値(金額・個数)取得
    foreach($products as $key => $product){
      // もし、キーとPOSTで受け取った商品名が一致したら
      if($key == $name){
        // 既に商品がカートに入っているので、個数を足し算する
        $count = (int)$count + (int)$product['count'];
      }
    }
  }
    //配列に入れるには、$name,$count,$priceの値が取得できていることが前提なのでif文で空のデータを排除する
  if($name != '' && $count != '' && $price != ''){
       $_SESSION['products'][$name]=[
            'count' => $count,
            'price' => $price
        ];
   }

  $products = isset($_SESSION['products'])? $_SESSION['products']:[];
  
  // if(isset($products)){
  //     foreach($products as $key => $product){
  //         echo $key;      //商品名
  //         echo "<br>";
  //         echo $product['count'];  //商品の個数
  //         echo "<br>";
  //         echo $product['price']; //商品の金額
  //         echo "<br>";
  //     }
  // }
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
        <h1 class="title_1">ショップ</h1>
        <input type="button" onclick="location.href='/homepage.sample/cart.php'" value="カートの中身">
        <form id="form1" action="" method="get">
        <input id="sbox1" id="s" name="s" type="text" placeholder="キーワードを入力" />
        <input id="sbtn1" type="submit" value="検索" /></form>
        <div class="shop_list">
          <h1 class="shop_font">〜未加工品〜</h1>
          <div class="homepage_shop_raw_product">
            <!--卵-->
            <div id="bird_egg"><img src="https://tokubai-news-photo-production.tokubai.co.jp/c/w=1400,h=865,a=2,f=jpg/fcbb/000a/340d/9cb5/2985/e448/4a80/fb0a/efa31c526d2d3137.png" alt="卵" width="300" height="250"><p>新鮮とれたて卵　6個セット<br><h4>¥700</h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="新鮮とれたて卵">
                <input type="hidden" name="price" value="700">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
            <!--手羽元-->
            <div id="bird_chicken_wings1"><img src="https://www.photolibrary.jp/mhd2/img850/450-20210812010622263017.jpg" alt="手羽元" width="300" height="250"><p>手羽元　10本セット<br><h4>¥1,200<h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="手羽元">
                <input type="hidden" name="price" value="1200">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
            <!--手羽先-->
            <div id="bird_chicken_wings2"><img src="https://www.photolibrary.jp/mhd1/img417/450-20151013094419156119.jpg" alt="手羽先" width="300" height="250"><p>手羽先　10本セット<br><h4>¥1,200<h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="手羽先">
                <input type="hidden" name="price" value="1200">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
            <div id="bird_thigh_meat"><img src="https://www.photolibrary.jp/mhd4/img276/450-2013010809084727109.jpg" alt="もも肉" width="300" height="250"><p>もも肉　1kg<br><h4>¥750<h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="もも肉">
                <input type="hidden" name="price" value="750">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
            <div id="bird_Bird sashimi"><img src="https://pbs.twimg.com/media/Et9B14iU0AMN3I7.jpg" alt="鳥刺し" width="300" height="250"><p>鳥刺し　500g<br><h4>¥800<h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="鳥刺し">
                <input type="hidden" name="price" value="800">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
          </div>
          <h1 class="shop_font">〜加工品〜</h1>
          <div class="homepage_shop_processed_goods">
            <div id="fried_chicken"><img src="https://cont-daidokolog.pal-system.co.jp/system/recipe/7817/img/thumbnail/pc_detail_main_PS_KCR_0793L.jpg" alt="唐揚げ" width="300" height="250"><p>唐揚げ　1kg<br><h4>¥1,400<h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="唐揚げ">
                <input type="hidden" name="price" value="1,400">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
            <div id="chicken_cutlet"><img src="https://t.pimg.jp/027/637/725/1/27637725.jpg" alt="チキンカツ" width="300" height="250"><p>チキンカツ 1kg<br><h4>¥1,200<h4></p>
              <form action="homepage4_shop.php" method="POST" class="item-form">
                <input type="hidden" name="name" value="チキンカツ">
                <input type="hidden" name="price" value="1,200">
                <input type="text" value="1" name="count">
                <button type="submit" class="btn-sm btn-blue">カートに入れる</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="sp-copyright">Copyright © 2022 Corporation all rights reserved.</div>
</body>
</html>