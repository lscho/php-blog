<?php

namespace Admin\Model;

use Think\Model;

class UsersModel extends Model {

    //登陆验证
    public function checkLogin($name, $pass) {
        $pass = md5($pass . 'eyblog');
        $map['user'] = $name;
        $rs = $this->where($map)->field('id,pass,user')->find();
        if ($pass == $rs['pass']) {
            $this->setLogin($rs['id'], $name);
            return true;
        } else {
            return false;
        }
    }
    //写入登陆信息
    public function setLogin($id,$name){
        session('ey_id',$id);
        session('ey_user',$name);
    }    
}
