<?php

class Controller_Base extends Controller_Template
{
    public function before()
    {
        parent::before();
        //header.phpをテンプレートの$headerとbindさせる。
        $this->template->header = View::forge('parts/header');
        //footer.phpをテンプレートの$footerとbindさせる。
        $this->template->footer = View::forge('parts/footer');
    }

    public function after($response)
    {
        $response = parent::after($response); // 自身のレスポンスオブジェクトを作成する場合は必要なし
        return $response; // after() は確実に Response オブジェクトを返すように
    }
}
