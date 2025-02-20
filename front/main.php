<?php
$nav = '';
$typeId = $_GET['type'] ?? 0;

if ($typeId == 0) {
    // 全部商品
    $nav = "全部商品";
    $rows = $Item->all(['sh' => 1]);
} else {
    $type = $Type->find($typeId);
    if ($type['big_id'] == 0) {
        // 大分類
        $nav = $type['name'];
        switch ($typeId) {
            case 2:  // 流行皮件
                $rows = $Item->all(['sh' => 1, 'big' => 1]);
                break;
            case 3:  // 流行鞋區
                $rows = $Item->all(['sh' => 1, 'big' => 2]);
                break;
            case 24: // 流行飾品
                $rows = $Item->all(['sh' => 1, 'big' => 3]);
                break;
            case 26: // 背包
                $rows = $Item->all(['sh' => 1, 'big' => 4]);
                break;
            default:
                $rows = [];
        }
    } else {
        // 中分類
        $big = $Type->find($type['big_id']);
        $nav = $big['name'] . " > " . $type['name'];

        // 根據您的資料表，直接使用 mid 欄位查詢
        $rows = $Item->all(['sh' => 1, 'mid' => $type['id']]);
    }
}

// 除錯資訊
echo "<div style='display:none'>";
echo "當前分類ID: $typeId<br>";
echo "商品數量: " . count($rows) . "<br>";
if (isset($type)) {
    echo "分類名稱: {$type['name']}<br>";
    echo "大分類ID: {$type['big_id']}<br>";
}
echo "</div>";
?>

<h2><?= $nav; ?></h2>
<style>
    .item {
        display: flex;
        margin: 3px auto;
        width: 85%;
    }

    .item div {
        padding: 5px;
        border: 1px solid white;
    }

    .item>div:nth-child(1) {
        width: 40%;
    }

    .item>div:nth-child(2) {
        width: 60%;
    }
</style>
<?php
if (!empty($rows)) {
    foreach ($rows as $row):
?>
        <div class='item'>
            <div class='pp'>
                <a href="?do=detail&id=<?= $row['id']; ?>">
                    <img src="./img/<?= $row['img']; ?>" style="width:200px;height:160px">
                </a>
            </div>
            <div>
                <div class='tt ct'>
                    <?= $row['name']; ?>

                </div>
                <div class='pp'>
                    價錢:<?= $row['price']; ?>
                    <a href="?do=buycart&id=<?= $row['id']; ?>&qt=1">
                        <img src="./icon/0402.jpg" style="float:right">
                    </a>
                </div>
                <div class='pp'>規格:<?= $row['spec']; ?></div>
                <div class='pp'>簡介:<?= mb_substr($row['intro'], 0, 20); ?>...</div>
            </div>
        </div>
<?php
    endforeach;
} else {
    echo "<div class='ct'>目前此分類尚無商品</div>";
}
?>