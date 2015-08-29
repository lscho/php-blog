<?php

namespace Admin\Controller;

use Admin\Common\AdminController;

class ConfigController extends AdminController {

    //配置
    public function index() {
        $this->con=C('web_config');
        $this->display();
    }
    //进行配置
    public function doSet(){
        $tid=I('tid');
        switch ($tid){
            case 1://基本配置
                $data['web_title']=I('web_title');
                $data['web_f_title']=I('web_f_title');
                $data['web_key']=I('web_key');
                break; 
            case 2;//内容配置
                $data['web_cont_size']=I('web_cont_size');
                $data['web_mood_size']=I('web_mood_size');
                $data['web_iscomment']=I('web_iscomment');
                $data['web_comment_size']=I('web_comment_size');
                break;
            case 3;//友情链接
                $data['web_f_url']=I('web_f_url');
                break;
            case 4;//底部信息
                $data['web_footer']=I('web_footer');
                break;
        }
        if(!$data){
            die(json_encode(array('status' => 0, 'msg' => '没有输入任何值！')));
        }
        $data=array_merge(C('web_config'),$data);//获取之前配置并合并
        $config['web_config']=$data;
        $rs=$this->set($config);
        if($rs){
            $this->log("修改配置","error");
            die(json_encode(array('status' => 0, 'msg' => '保存失败！')));
        }else{
            $this->log("修改配置","seccess");
            die(json_encode(array('status' => 1, 'msg' => '操作成功！')));
        }
    }
}
