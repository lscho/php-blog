<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class TagController extends AdminController {

    //列表
    public function index() {
        $rs = D('Tags')->getList();
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->showPage = $rs['showPage'];
        $this->display();
    }

    //保存
    public function doSet() {
        $data['name'] = I('tag');
        $data['tid'] = 1;
        if (I('id')) {
            $rs = M('tags')->where('id=' . I('id'))->save($data);
        } else {
            $rs = M('tags')->add($data);
        }
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '保存成功')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '修改失败')));
        }
    }

    //删除
    public function del() {
        $rs = M('tags')->where('id=' . I('id'))->delete();
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '删除失败')));
        }
    }

}
