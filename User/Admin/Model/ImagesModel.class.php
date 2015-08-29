<?php
namespace Admin\Model;
use Think\Model;
class ImagesModel extends Model {
    //获取图片列表
    public function getList($where){
        $count = $this->where($where)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);
        $show = $Page->show(); // 分页显示输出
        $showPage = $Page->showPage(); // 分页显示输出
        $list = $this->where($where)
                ->order('time desc')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->select();
        $rs['count'] = $count;
        $rs['list'] = $list;
        $rs['page'] = $show;
        $rs['showPage'] = $showPage;
        return $rs;
    }
    //获取最新图片
    public function getNew($num=1){
        $list=$this->where('ey_photos.pass=""')
                ->field('ey_images.*')
                ->join('ey_photos ON ey_images.pid=ey_photos.id')
                ->order('ey_images.time desc')
                ->limit($num)
                ->select();
        return $list;
    }

}
