<?php
$user = $Mem->find(['acc' => $_SESSION["Mem"]]);
?>
<h2 class="ct">填寫資料</h2>
<table class="all" style="margin-bottom:0px">
    <tr>
        <td class="tt ct">登入帳號</td>
        <td class="pp"><?= $user['acc']; ?></td>
    </tr>
    <tr>
        <td class="tt ct">姓名</td>
        <td class="pp"><input type="text" name="name" id="name" value='<?= $user['name']; ?>'></td>
    </tr>
    <tr>
        <td class="tt ct">電子信箱</td>
        <td class="pp"><input type="text" name="email" id="email" value='<?= $user['email']; ?>'></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡地址</td>
        <td class="pp"><input type="text" name="addr" id="addr" value='<?= $user['addr']; ?>'></td>
    </tr>
    <tr>
        <td class="tt ct">聯絡電話</td>
        <td class="pp"><input type="text" name="tel" id="tel" value='<?= $user['tel']; ?>'></td>
    </tr>
</table>
<table class="all" style="margin-top:0">
    <tr class="tt ct">
        <td>商品名稱</td>
        <td>編號</td>
        <td>數量</td>
        <td>單價</td>
        <td>小計</td>
    </tr>
    <?php
    $sum = 0;
    foreach ($_SESSION['cart'] as $id => $qt):
        $item = $Item->find($id);
    ?>
        <tr class="pp">
            <td><?= $item['name']; ?></td>
            <td class="ct"><?= $item['no']; ?></td>
            <td class="ct"><?= $qt; ?></td>
            <td class="ct"><?= $item['price']; ?></td>
            <td class="ct">
                <?php
                echo $item['price'] * $qt;
                $sum = $sum + ($item['price'] * $qt);
                ?>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
</table>
<div class="all tt ct" style="padding:5px;margin-top:0">總價:<?= $sum; ?></div>
<div class="ct">
    <button onclick="checkout()">確定送出</button>
    <button onclick="location.href='?do=buycart'">返回修改訂單</button>
</div>
<script>
    function checkout() {
        if ($("#name").val() == "" || $("#email").val() == "" || $("#addr").val() == "" || $("#tel").val() == "") {
            alert("請填寫完整訂購資料");
            return;
        }

        let data = {
            name: $("#name").val(),
            email: $("#email").val(),
            addr: $("#addr").val(),
            tel: $("#tel").val(),
            total: <?= $sum ?>
        }

        $.post("./api/checkout.php", data, function(response) {
            if (response == 1) {
                alert("訂購成功\n感謝你的選購");
                location.reload();
                location.href = '?do=main';
            } else {
                alert("訂購失敗，請聯繫客服");
            }
        })
    }
</script>