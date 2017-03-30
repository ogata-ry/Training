<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ドキュメント確認ツール</title>
<link type="text/css" rel="stylesheet" href="//10.21.65.8/alphawave/assets/css/form_style.css?teuwe" />
<script type="text/javascript" src="//10.21.65.8/alphawave/assets/js/doclook.js">
</script>
</head>
<body>
    <?php require_once '../fuel/app/views/doclook/header.php' ?>
    <!-- コンテンツ▼ -->
    <div class="wrap">
        <?php echo Form::open(array('action' => 'alphawave/doclook/response_process')) ?>
        <!-- タイトル▼ -->
        <!--<h3>チェック</h3>-->
        <!-- タイトル▲ -->
        <!-- 確認画面▼ -->
        <div class="display">
            差出人<br />
            <p><?php echo $user; ?></p>
        </div>
        <div class="display">
            内容<br />
            <br />
            <div class="attention">コメントしたい行をクリックするとコメントフォームが生成されます。</div>
            <div class="docArea">
                <?php foreach($content as $key => $line) : ?>
                <div class="check_content"
                     id="<?=$key ?>"
                     onclick="createForm('<?=$key ?>')">
                <?=$line ?></div>
                <?php if (isset($responses[$key])) : ?>
                <div class="response_line" id="r_<?=$key ?>">
                    <?php foreach ($responses[$key]['response'] as $line) : ?>
                        <?=$line ?><br />
                    <?php endforeach;?><br />
                        <div class="responseMenu">
                            投稿者：<?=$responses[$key]['commenter'] , '　', $responses[$key]['date']?><br />
                            <!--<a href="delete_response?id=<?=$key ?>&urlId=<?=$id ?>">削除</a>-->
                            <a href="#"
                               onClick="deleteResponse('<?=$key ?>', '<?=$id ?>')">
                                削除
                            </a>
<!--                            <button onClick="editForm('r_<?=$key ?>'); return false">編集</button>
                            <button onClick="createForm('r_<?=$key ?>')">返信</button>-->
                        </div>
                </div>
                <?php endif ?>
                <?php endforeach;?>
            </div>
        </div>
        <?php echo Form::hidden('urlId', $id); ?>
        <?php echo Form::close(); ?>
        <div class="display">
            <a href="stacklist">戻る</a>
        </div>
        <!-- 確認画面▲ -->
    </div>
    <!-- コンテンツ▲ -->
</body>
</html>
