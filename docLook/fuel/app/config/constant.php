<?php

return array(

    'mail' => array(

        'name_doclook' => '確認ツールアプリ',

        'address' => array(
            'app_doclook' => 'doclook_app@hogehoge.co.jp',
        ),

        'subject' => array(
            'client' => 'お問い合わせありがとうございます。',
            'server' => '新着のお問い合わせ情報を受信しました。',
            'sales' => '件のお問い合わせがありました。',
            'checker' => '【確認ツール】ドキュメント確認のご依頼が来ています。',
            'user' => '【確認ツール】ドキュメント確認のお返事が来ています。'
        ),

        'errMsg' => array(
            'validationFailed' => 'メール送信先のアドレスが正しくありません。',
            'sendingFailed' => 'メール送信に失敗しました。',

    ),
    
    'doclook' => array(

        'fields' => array(
            'user',
            'category',
            'title',
            'content',
            'checker',
            'date',
        ),

    ),

);