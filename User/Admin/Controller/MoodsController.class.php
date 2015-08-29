<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class MoodsController extends AdminController {

    //心情列表
    public function index() {
        $title = I('key');
        if ($title) {//关键字查找
            $where['ey_moods.mood'] = array('like', '%' . $title . '%');
        }
        $where['ey_moods.uid']=session('ey_id');
        $moods = D('Moods');
        $rs=$moods->getList($where);
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];  
        $this->showPage=$rs['showPage'];
        $this->display();
    }

    //添加心情
    public function add() {
        $data['mood'] = I('mood');
        $data['uid'] = session('ey_id');
        $id = I("id");
        if ($id) {
            $rs = M('moods')->where('id=' . $id)->save($data);
        } else {
            $data['time'] = time();
            $rs = M('moods')->add($data);
        }
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

    //删除心情
    public function del() {
        $id = I('id');
        $rs = M('moods')->where('id=' . $id)->delete();
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

}
