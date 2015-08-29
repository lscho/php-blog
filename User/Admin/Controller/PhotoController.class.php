<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class PhotoController extends AdminController {

    //后台首页
    public function index() {
        $photo = D('Photos');
        $rs = $photo->getList();
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->showPage = $rs['showPage'];
        $this->display();
    }

    //创建相册
    public function add() {
        $data["title"] = I('title');
        $data["src"] = stripslashes(I('src'));
        $data['pass'] = I('pass');
        $data['abstract'] = I('abstract');
        if (I('id')) {
            $rs = M('photos')->where('id=' . I('id'))->save($data);
        } else {
            $data['time'] = time();
            $rs = M('photos')->add($data);
        }
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

    //相册详情
    public function lists() {
        $id = I('id');
        $this->id = $id;
        $where['pid'] = $id;
        $img = D('Images');
        $rs = $img->getList($where);
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->showPage = $rs['showPage'];
        $this->display();
    }

    //上传图片
    public function upload() {
        $src = I('srcname');
        $title = I('imgname');
        $data["pid"] = I('pid');
        $data['time'] = time();
        $img = M('images');
        foreach ($src as $k => $v) {
            $data['src'] = stripslashes($v);
            $data['title'] = $title[$k];
            $rs = $img->add($data);
        }
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

    //删除相册
    public function del() {
        $id = I('id');
        $rs = M('images')->where('pid=' . $id)->delete();
        $rs1 = M('photos')->where('id=' . $id)->delete();
        if ($rs1) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

    //删除单张图片
    public function imgDel() {
        $id = I('id');
        $rs = M('images')->where('id=' . $id)->delete();
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

}
