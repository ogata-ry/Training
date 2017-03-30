<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ドキュメント確認ツール</title>
<link type="text/css" rel="stylesheet" href="//10.21.65.8/alphawave/assets/css/form_style.css?teuw" />
</head>
<body>
    <?php require_once '../fuel/app/views/doclook/header.php' ?>
    <!-- コンテンツ▼ -->
    <div class="wrap">
        <!-- タイトル▼ -->
        <h3>確認画面</h3>
        <!-- タイトル▲ -->
        <!-- 確認画面▼ -->
        <?php echo Form::open(array('action' => 'alphawave/doclook/complete')) ?>
        <div class="display">
            <p>日時：<?php echo $date; ?></p>
        </div>
        <div class="display">
            差出人<br />
            <p><?php echo $user; ?></p>
        </div>
        <div class="display">
            カテゴリ<br />
            <p><?php echo $category; ?></p>
        </div>
        <div class="display">
            タイトル<br />
            <p><?php echo $title; ?></p>
        </div>
        <div class="display">
            内容<br />
            <?php foreach($viewContent as $line) : ?>
            <div class="doclook_content"><?php echo $line; ?></div>
            <?php endforeach;?>
        </div>
        <div class="display">
            確認者<br />
            <p><?php echo $checker; ?></p>
        </div>
        <div class="display">
            <?php echo Form::submit('submit', '送信', array('class' => 'button')); ?>&nbsp;&nbsp;
            <?php echo Form::submit('back', 'キャンセル', array('class' => 'button')); ?>
            <?php echo Form::hidden('id', $id);?>
            <?php echo Form::hidden('date', $date);?>
            <?php echo Form::hidden('user', $user);?>
            <?php echo Form::hidden('category', $category);?>
            <?php echo Form::hidden('title', $title);?>
            <?php echo Form::hidden('content', $content);?>
            <?php echo Form::hidden('checker', $checker);?>
            <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token());?>
        </div>
        <?php echo Form::close(); ?>
        <!-- 確認画面▲ -->
    </div>
    <!-- コンテンツ▲ -->
</body>
</html>
