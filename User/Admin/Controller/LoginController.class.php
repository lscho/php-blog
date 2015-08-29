<?php
namespace Admin\Controller;
use Home\Common\HomeController;
class LoginController extends HomeController {
    public function index(){
       $this->display();
    }
    //用户登陆
    public function doLogin(){
        $name=I('name');
        $pass=I('pass');
        $rs=D('Users')->checkLogin($name, $pass);
        if($rs){
            $this->log("尝试进行登录","success");
            die(json_encode(array('status'=>1,'msg'=>'/admin.php')));
        }else{
            $this->log("尝试进行登录","error");
            die(json_encode(array('status'=>0,'msg'=>'登陆失败')));
        }
    }
    //注销登录
    public function logout(){
        session('ey_user',null);
        session('ey_id',null);
        $this->redirect("Home/Index/index");
    }
    //相册密码验证
    public function photo(){
        $id=I('id');
        if(I('pwd')){
            $pwd=I('pwd');
        }else{
            $pwd=session('ey_photo_'.$id);
        }
        $rs=M('photos')->where('id='.$id)->getField('pass');
        if($pwd==$rs){
            session('ey_photo_'.$id,$pwd);
            $this->log("验证相册密码成功","success");
            die(json_encode(array('status'=>1,'msg'=>'密码验证成功')));
        }else{
            $this->log("验证相册密码失败","error");
            die(json_encode(array('status'=>0,'msg'=>'密码验证失败')));
        }
    }
}