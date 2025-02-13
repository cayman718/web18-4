<?php include_once "db.php";
// 加密密碼
if (isset($_POST['pw'])) {
    $_POST['pw'] = ($_POST['pw']);
}
$Mem->save($_POST);