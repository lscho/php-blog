<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class UserController extends AdminController {

    //用户资料首页
    public function index() {
        $user=M('users')->where('id='.session('ey_id'))->find();
        $this->user=$user;
        $this->display();
    }
    //编辑资料
    public function information(){
        $user=M('users');
        $id=session('ey_id');
        if(I('img')){$data['img']=I('img');}
        if(I('user')){$data['user']=I('user');}
        if(I('qq')){$data['qq']=I('qq');}   
        if(I('email')){$data['email']=I('email');}
        if(I('weibo')){$data['weibo']=I('weibo');}
        if(I('brief')){$data['brief']=I('brief');}
        if(I('newpass')){$data['pass']=md5(I('newpass').'eyblog');}
        if(I('newpass')){//如果有新密码
            $pass=md5(I('pass').'eyblog');
            $res=M('users')->where('id='.session('ey_id'))->getField('pass');
            if($res!=$pass){
                die(json_encode(array('status' => 0, 'msg' => '原密码不正确')));
            }
        }
        $rs=M('users')->where('id='.$id)->save($data);
        if($rs){
            $this->log("修改资料","seccess");
            die(json_encode(array('status' => 1, 'msg' => '修改成功')));
        }else{
            $this->log("修改资料","error");
            die(json_encode(array('status' => 0, 'msg' => '修改失败')));
        }
    }
}
