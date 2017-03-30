<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>ドキュメント確認ツール</title>
<link type="text/css" rel="stylesheet" href="//10.21.65.8/alphawave/assets/css/form_style.css?3" />
</head>
<body>
    <?php require_once '../fuel/app/views/doclook/header.php' ?>
    <!-- コンテンツ▼ -->
    <div class="wrap">
        <!-- タイトル▼ -->
        <h3>ドキュメント確認ツール（試運転）</h3>
        <!-- タイトル▲ -->
        <!-- フォーム▼ -->
        <?php echo Form::open(array('action' => 'alphawave/doclook/confirm')) ?>
        <div class="form">
            差出人<br />
            <br />
            <?php echo Form::select('user', 
                    Session::get_flash('user'), 
                    array('' => '選択してください', 'user1' => 'user1', 'user2' => 'user2', 'ogata-ry' => 'ogata-ry'),
                    array('class' => 'formWindow')); ?>
            <?php if (isset($errMsg['user'])):?>
                <p class="alert alert-warning"><?php echo $errMsg['user']; ?></p>
            <?php endif;?>
        </div>
        <div class="form">
            カテゴリ<br />
            <br />
            <?php echo Form::select('category', 
                    Session::get_flash('category'), 
                    array('' => '選択してください', '日報' => '日報', '申請文言' => '申請文言', '外部向け文章' => '外部向け文章', 'その他' => 'その他'),
                    array('class' => 'formWindow')); ?>
            <?php if (isset($errMsg['category'])):?>
                <p class="alert alert-warning"><?php echo $errMsg['category']; ?></p>
            <?php endif;?>
        </div>
        <div class="form">
            タイトル<br />
            <br />
            <?php echo Form::input('title', Session::get_flash('title'), array('class' => 'titleFormWindow', 'placeholder' => 'ここにタイトルを入力　※50文字まで')); ?>
            <?php if (isset($errMsg['title'])):?>
                <p class="alert alert-warning"><?php echo $errMsg['title']; ?></p>
            <?php endif;?>
        </div>
        <div class="form">
            内容<br />
            <br />
            <?php echo Form::textarea('content', Session::get_flash('content'), array('rows' => '15', 'class' => 'contentFormWindow', 'placeholder' => 'ここに内容を入力　※10000文字まで')); ?>
            <?php if (isset($errMsg['content'])):?>
                <p class="alert alert-warning"><?php echo $errMsg['content'];?></p>
            <?php endif;?>
        </div>
        <div class="form">
            確認者<br />
            <br />
            <?php echo Form::select('checker', 
                    Session::get_flash('checker'), 
                    array('' => '選択してください', 'user1' => 'user1', 'user2' => 'user2', 'ogata-ry' => 'ogata-ry'),
                    array('class' => 'formWindow')); ?>
            <?php if (isset($errMsg['checker'])):?>
                <p class="alert alert-warning"><?php echo $errMsg['checker']; ?></p>
            <?php endif;?>
        </div>
        <span class="void"></span>
        <div class="submit">
            <?php echo Form::submit('submit', '確認画面', array('class' => 'button'));?>
            <?php echo Form::hidden('date', date('Y/m/d H:i:s')); ?>
            <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token());?>
        </div>
        <?php echo Form::close(); ?>
        <!-- フォーム▲ -->
    </div>

    <!-- コンテンツ▲ -->
</body>
</html>
