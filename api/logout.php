<?php
session_start();  // 啟動 session
include_once "db.php";

$table = $_GET['table'];

// 清除特定表格的 session
if (isset($_SESSION[$table])) {
    unset($_SESSION[$table]);
}

// 完全清除所有 session 資料（建議使用）
session_destroy();

// 重導向到首頁（使用 header 代替 to 函數）
header("Location: ../index.php");
exit();
