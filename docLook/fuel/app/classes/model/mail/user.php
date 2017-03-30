<?php
/*
 * メールモデル - 差出人用
 */

/*
 * 差出人にメールを送信するクラス
 */
class Model_Mail_User extends Model_Mail_Base {

    /*
     * 初期設定
     */
    public function __construct() {
        parent::__construct();
    }

    /*
     * メール送信の準備をする
     * 
     * @param array フォーム情報
     */
    protected function prepare($mailInfo) {
        $this->sendMailObj->from($this->constant['address']['app_doclook'], mb_convert_encoding($this->constant['name_doclook'], 'jis'));

        $this->sendMailObj->to($mailInfo['mail'], $mailInfo['user']);

        $subject = '【' . $mailInfo['category'] . '】' . $mailInfo['title'];

        $this->sendMailObj->subject(mb_convert_encoding($subject, 'jis'));

        // bodyをエンコードして設定
        $body = View::forge('mailTemplate/user', $mailInfo);
        $this->sendMailObj->body(mb_convert_encoding($body, 'jis'));

    }

}