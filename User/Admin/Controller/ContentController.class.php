<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class ContentController extends AdminController {

    //文章发布首页
    public function index() {
        $id = I('id');
        $this->id = $id;
        if ($id) {
            $rs = D('Contents')->getOne($id);
            $this->list = $rs;
        }
        $this->cates = D('Categorys')->getAll();
        $this->tags = D('Tags')->getAll();
        $this->display();
    }

    //文章添加
    public function add() {
        $data['title'] = I('title','未命名');
        $data['text'] = stripslashes($_POST['content']);
        $data['tid'] = I('tid',1);
        $data['cid'] = I('cid',1);
        $data['ispage'] = I('ispage',1);
        $data['iscomment'] = I('iscomment',1);
        $data['status'] = I('status',1);
        $data['uid']=session('ey_id');       
        if($_POST['abscontent']){
            $data['abscontent']=$_POST['abscontent'];
        }else{
            $data['abscontent']=mb_strcut(strip_tags($_POST['content']), 0, 200, 'utf-8');//提取前200个字符
        }
        if ($_POST['id']) {
            $rs = M('contents')->where('id=' . $_POST['id'])->save($data);
        } else {
            $data['time'] = time();
            $rs = M('contents')->add($data);
        }
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '操作失败')));
        }
    }

    //文章列表
    public function lists() {
        $title = I('t');
        if ($title) {//关键字查找
            $where['ey_contents.title'] = array('like', '%' . $title . '%');
        }
        $cid = I('cid');
        if ($cid != 'all' and $cid != "") {//分类
            $where['ey_contents.cid'] = $cid;
        }
        $where['ey_contents.uid']=session('ey_id');
        $content = D('Contents');
        $rs=$content->getList($where,10);
        $this->cates = D('Categorys')->getAll();
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->showPage=$rs['showPage'];
        $this->display();
    }

    //修改文章状态
    public function status() {
        $s = I('s');
        $id = I('id');
        $data['status'] = $s;
        $rs = M('contents')->where('id=' . $id)->save($data);
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '修改成功')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '修改失败')));
        }
    }

    //删除文章
    public function del() {
        $id = I('id');
        $rs = M('contents')->where('id=' . $id)->delete();
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '删除成功')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '删除失败')));
        }
    }

}
