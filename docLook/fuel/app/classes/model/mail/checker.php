<?php
/*
 * メールモデル - 確認者用
 */

/*
 * 確認者にメールを送信するクラス
 */
class Model_Mail_Checker extends Model_Mail_Base {

    /*
     * 初期設定
     */
    public function __construct() {
        parent::__construct();
    }

    /*
     * メール送信の準備をする
     * 
     * @param array メール情報
     */
    protected function prepare($mailInfo) {
        $this->sendMailObj->from($this->constant['address']['app_doclook'], mb_convert_encoding($this->constant['name_doclook'], 'jis'));

        $this->sendMailObj->to($mailInfo['mail'], $mailInfo['checker']);

        $subject = '【' . $mailInfo['category'] . '】' . $mailInfo['title'];

        $this->sendMailObj->subject(mb_convert_encoding($subject, 'jis'));

        // bodyをエンコードして設定
        $body = View::forge('mailTemplate/checker', $mailInfo);
        $this->sendMailObj->body(mb_convert_encoding($body, 'jis'));

    }

}