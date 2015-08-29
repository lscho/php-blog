<?php

namespace Home\Controller;

use Home\Common\HomeController;

class CommentController extends HomeController {

    //留言防水机制
    public function _before_add() {
        $ip = $_SERVER["REMOTE_ADDR"];
        if (session('time' . $ip)) {//留言15秒检测
            if (time() - session('time' . $ip) < 15) {
                die(json_encode(array('status' => 0, 'msg' => '留言太快！')));
            }
        }
        if (session('comm' . $ip)) {//留言相似度百分之80检测
            similar_text(session('comm' . $ip), I('post.comment'), $percent);
            if ($percent > 80) {
                die(json_encode(array('status' => 0, 'msg' => '两次留言相似度太高！')));
            }
        }
    }

    //添加留言
    public function add() {
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        if (I('post.name')) {
            $data['name'] = I('post.name');
        } else {
            $data['name'] = '匿名网友';
        }
        if (I('post.email')) {
            $data['email'] = I('post.email');
        } else {
            die(json_encode(array('status' => 0, 'msg' => '请填写邮箱以方便我们和您联系！')));
        }
        if (I('post.comment')) {
            $data['comment'] = I('post.comment');
        } else {
            die(json_encode(array('status' => 0, 'msg' => '请填写内容哦！')));
        }
        session('comm' . $data['ip'], $data['comment']); //保存上次留言内容
        $data['time'] = time();
        session('time' . $data['ip'], $data['time']); //保存改IP发表留言时间
        $data['address'] = I('post.address');
        $data['tid'] = 1;
        $data['pid'] = I('post.pid');
        $data['nid'] = I('post.nid');
        $rs = M('comments')->add($data);
        if ($rs) {
            die(json_encode(array('status' => 1, 'msg' => '留言成功！')));
        } else {
            die(json_encode(array('status' => 0, 'msg' => '留言失败')));
        }
    }

    //获取留言
    public function getList() {
        $config = C('web_config'); //获取系统配置
        $id = I('id');
        $rs = D('Admin/Comments')->getList($id, $config['web_comment_size']);
        $data['header'] = $rs['page'];
        $data['body'] = $rs['list'];
        $data['size'] = $config['web_comment_size'];
        echo json_encode($data);
    }

}
