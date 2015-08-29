<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class CommentController extends AdminController {

    //列表
    public function index() {
        $rs = D('Comments')->getList();
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->showPage = $rs['showPage'];
        $this->display();
    }
    //删除
    public function del() {
        $rs = M('comments')->where('id=' . I('id'))->delete();
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '删除失败')));
        }
    }

}
