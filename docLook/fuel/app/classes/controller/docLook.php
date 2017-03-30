<?php

/*
 * 
 * ドキュメント確認ツール - コントローラー
 * 
 * @author ogata-ry
 */

Class Controller_DocLook extends Controller_Logic_Daily {

    /*
     * フォームアクション
     */
    public function action_form() {
        return View::forge('doclook/form');
    }

    /*
     * 送信内容の確認画面アクション
     */
    public function action_confirm() {
        $viewData = array();

        // フラッシュセッション設定
        $this->_sessionModel->setSession(Config::get('doclook.fields'));

        if ($this->formDataIsValid()) {
            $viewData = $this->getFormData();

            return View::forge('doclook/confirm', $viewData);

        } else {
            $viewData['errMsg'] = $this->getErrMsg();

            return View::forge('doclook/form', $viewData);
        }

    }

    /*
     * 完了画面のアクション
     */
    public function action_complete() {

        //ポストデータに'back'があればフォーム画面にリダイレクト
        if (Input::post('back')) {

            $this->_sessionModel->keepSession(Config::get('doclook.fields'));

            Response::redirect('alphawave/doclook/form');
        }

        $viewData = array();

        // トークンチェックに引っかかったらエラー文言表示
        if (Security::check_token() === false) {
            $viewData['message'] = "ページ遷移が正しくありません。";

            return View::forge('doclook/complete', $viewData);
        }

        try {

            $formData = $this->getAdmittedData();

            $this->saveFormData($formData);
            $this->sendMailToChecker($formData);

            $message = '受付が完了しました。';

        } catch (Exception $e) {
            $message = $e->getMessage();
        }

        $viewData['message'] = $message;

        return View::forge('doclook/complete', $viewData);
    }

    /*
     * スタックリスト画面のアクション
     */
    public function action_stacklist() {
        $viewData = $this->getStackList();

        return View::forge('doclook/stacklist', $viewData);
    }

    /*
     * チェック画面のアクション
     */
    public function action_check() {

        $id = filter_input(INPUT_GET, 'id');
        $viewData = $this->getCheckInfo($id);

        return View::forge('doclook/check', $viewData);
    }

    /*
     * 返信処理のアクション
     */
    public function action_response_process() {
        $this->writeResponse();
        $this->sendMailToUser();
        $urlId = Input::post('urlId');
        
        Response::redirect('alphawave/doclook/check?id=' . $urlId);
    }

    /*
     * スタックの削除アクション
     */
    public function action_delete() {
        $this->deleteFile();

        Response::redirect('alphawave/doclook/stacklist');
    }

    /*
     * 返信の削除処理アクション
     */
    public function action_delete_response() {
        $this->deleteResponse();
        $urlId = filter_input(INPUT_GET, 'urlId');

        Response::redirect('alphawave/doclook/check?id=' . $urlId);

    /*
     * 
     */

    }

}