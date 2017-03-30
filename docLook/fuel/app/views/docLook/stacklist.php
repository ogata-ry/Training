<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ドキュメント確認ツール</title>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<link type="text/javascript" src="//10.21.65.8/alphawave/assets/js/fixed_midashi.js" />
<script type="text/javascript" src="//10.21.65.8/alphawave/assets/js/doclook.js">
</script>
<link type="text/css" rel="stylesheet" href="//10.21.65.8/alphawave/assets/css/form_style.css?aads3" />
</head>
<body onLoad="FixedMidashi.create();">
    <?php require_once '../fuel/app/views/doclook/header.php' ?>
    <!-- コンテンツ▼ -->
    <div class="wrapLog">
        <!-- タイトル▼ -->
        <h3>スタックリスト</h3>
        <!-- タイトル▲ -->
        <!-- 画面▼ -->
        <div class="displayLog">
            <?php if (empty($stacklist)) : ?>
            NO DATA
            <?php else : ?>
            <table _fixedhead="rows:1" id="table1">
                <thead >
                    <tr>
                        <th class="titleCol">タイトル</th>
                        <th>差出人</th>
                        <th>確認者</th>
                        <th class="dateCol">登録日時</th>
                        <th>管理・編集</th>
                    </tr>
                </thead>
                <tbody class="table2">
                    <?php foreach ($stacklist as $stack) :?>
                    <tr>
                        <td class="titleCol">
                            <a href="check?id=<?=$stack['id']?>">
                                <?=$stack['title']?>
                            </a>
                        </td>
                        <td><?=$stack['user']?></td>
                        <td><?=$stack['checker']?></td>
                        <td class="dateCol"><?=$stack['date']?></td>
                        <td>
                            <a href="#"
                               onClick="deleteStack('<?=$stack['id']?>')">
                                削除
                            </a>
                        </td>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif ?>
        </div>
        <!-- 画面▲ -->
    </div>
    <!-- コンテンツ▲ -->
</body>
</html>
