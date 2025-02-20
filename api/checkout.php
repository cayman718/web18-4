<?php include_once "db.php";

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['addr']) || empty($_POST['tel'])) {
    echo 0;
    exit();
}

$_POST['acc'] = $_SESSION['Mem'];
$_POST['no'] = date('Ymd') . rand(100000, 999999);
$_POST['cart'] = serialize($_SESSION['cart']);
$_POST['order_time'] = date('Y-m-d H:i:s');

if ($Order->save($_POST)) {
    unset($_SESSION['cart']);  // 使用 unset 來清空購物車
    $_SESSION['cart'] = [];    // 確保購物車被重置為空陣列
    session_write_close();     // 確保 session 變更被保存
    echo 1;
} else {
    echo 0;
}
