<?php include_once "db.php";

// 加密密碼
if (isset($_POST['pw'])) {
    $_POST['pw'] = ($_POST['pw']);
}

$_POST['pr'] = serialize($_POST['pr']);
$Admin->save($_POST);

to("../back.php?do=admin");