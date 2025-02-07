<?php include_once "db.php";
$table = $_GET['table'];
unset($_GET['table']);
//限於只有一個傳來因為會將全部清空

$chk = $$table->count($_GET);
/* dd($_GET);
dd($chk); */
if ($chk) {
    echo 1;
    $_SESSION[$table] = $_GET['acc'];
} else {
    echo 0;
}