    <!-- 返信フォーム▼ -->
    <div class="response_wrap">
        <div class="form_response">
            投稿者　
            <?php echo Form::select('commenter', 
                    '', 
                    array('匿名希望' => '選択してください', 'kumagai-h' => 'kumagai-h', 'moizumi' => 'moizumi', 'nakayama-yur' => 'nakayama-yur', 'ogata-ry' => 'ogata-ry'),
                    array('class' => 'responseWindowSelect')
                    ); ?>
            <?php if (isset($errMsg['checker'])):?>
                <p class="alert alert-warning"><?php echo $errMsg['checker']; ?></p>
            <?php endif;?>
            <br />
            <br />
            コメント<br />
            <?php echo Form::textarea('response', '', array('rows' => '3', 'class' => 'responseWindow', 'placeholder' => 'ここにテキストを入力')); ?>
            <?php if (isset($err['response'])):?>
                <p class="alert alert-warning"><?php echo $err['responce'];?></p>
            <?php endif;?>
        </div>
        <div class="responseSubmit">
            <?php echo Form::submit('submit', '送信', array('class' => 'responseButton'));?>
            <?php echo Form::button('cancel', 'キャンセル', array('class' => 'responseButton', 'onclick' => 'deleteForm()'));?>
            <?php echo Form::hidden('id', '##id##'); ?>
            <?php echo Form::hidden(Config::get('security.csrf_token_key'), Security::fetch_token());?>
        </div>
        <div class="clear"><hr />
    </div>
    <!-- 返信フォーム▲ -->