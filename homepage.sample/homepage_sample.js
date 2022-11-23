function removeExample(element, value) {
    // elementにはbuttonタグの要素情報が入ってくる
    // valueには$keyの情報が入ってくる
    // ajaxを利用して押下されたボタンのセッション情報を削除する
    $.ajax({
        type: "POST",
        url: "cart_ajax.php",
        data: { "key" : value }
    }).done(function(data){
        // セッション情報の削除に成功した場合、削除ボタン押下した行を削除する
        $(element).parents('tr').remove();
    }).fail(function(XMLHttpRequest, status, e){
        alert(e);
    });
}