<?php

namespace Home\Controller;
use Home\Common\HomeController;

class IndexController extends HomeController {
    
    //安装判断
    public function _before_index(){
        $install=C('install');
        if(!$install){
            redirect("./install.php");
        }
    }
     
    //首页
    public function index(){
        $this->title='首页 -';
        $config=C("web_config");
        //标签列表
        $this->taglist=D('Admin/Tags')->getAll();
        //分类列表
        $this->catelist = D('Admin/Categorys')->getAll();
        //最新留言
        $this->commentlist=D('Admin/Comments')->getNew(5);
        //最新心情
        $this->moodlist=D('Admin/Moods')->getNew(5);
        //文章列表
        if (I('s')) {//关键字查找
            $this->title='搜索 -';
            $where['title'] = array('like', '%' . I('s') . '%');
        }        
        if(I('cid')){//按分类查找
            $this->title='分类 -';
            $where['cid']=I('cid');
        }
        if(I('tid')){//按标签查找
            $this->title='标签 -';
            $where['ey_contents.tid']=I('tid');
        }        
        $content = D('Admin/Contents');//实例化Admin模块文章模型
        $where['status']=1;
        $where['ispage']=1;
        $rs=$content->getList($where,$config['web_cont_size']);
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->page_type='content';
        $this->display();
    }
    //文章详情页
    public function page(){
        $config=C("web_config");
        //查询文章内容
        $id=I('id');
        if ($id) {
            $rs = D('Admin/Contents')->getOne($id);
            $this->title=$rs['title'].' -';
            $this->list = $rs;
        }
        //查询留言
        $rs=D('Admin/Comments')->getList($id,$config['web_comment_size']);
        $this->comment=$rs;
        //标签列表
        $this->taglist=D('Admin/Tags')->getAll();
        //分类列表
        $this->catelist = D('Admin/Categorys')->getAll(); 
        //最新留言
        $this->commentlist=D('Admin/Comments')->getNew(5); 
        //最新心情
        $this->moodlist=D('Admin/Moods')->getNew(5);        
        $this->display();
    }
    //相册列表页
    public function photo(){
        $photo = D('Admin/Photos');
        $rs=$photo->getList();
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page']; 
        $this->title='相册 -';
        $this->display();
    }
     //相册详情页前置操作
    public function _before_gallery(){
        $id = I('id');
        $pass=M('photos')->where('id='.$id)->getField('pass');
        $pwd=session('ey_photo_'.$id);
        if($pwd!=$pass){
            die(json_encode(array('status'=>-1,'msg'=>'密码验证失败')));
        }
    }
    //相册详情页
    public function gallery(){
        $id = I('id');
        $this->id=$id;
        $where['pid']=$id;
        $img=D('Admin/Images');
        $rs=$img->getList($where);
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];
        $this->title='图片 -';
        $this->display();        
    }
    //心情列表页
    public function mood(){
        $config=C("web_config");
        $title = I('key');
        $moods = D('Admin/Moods');
        $rs=$moods->getList($where,$config['web_mood_size']);
        $this->count = $rs['count'];
        $this->list = $rs['list'];
        $this->page = $rs['page'];  
        $this->title='心情 -';
        $this->display();        
    }
}
