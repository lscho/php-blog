<?php
namespace Admin\Model;
use Think\Model;
class MoodsModel extends Model {
    //获取心情列表
    public function getList($where,$page_size=10){
        $count = $this->where($where)->order('time desc')->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, $page_size);
        $show = $Page->show(); // 分页显示输出
        $showPage = $Page->showPage(); // 分页显示输出
        $list = $this->where($where)
                ->field('ey_moods.*,ey_users.img,ey_users.user as name')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->join('ey_users ON ey_moods.uid=ey_users.id')
                ->order('time desc')
                ->select();
        $rs['count'] = $count;
        $rs['showPage'] = $showPage;
        $rs['list'] = $list;
        $rs['page'] = $show;
        return $rs;
    }
    //获取最新心情
    public function getNew($num=1){
        $rs=$this->order('time desc')
				->field('ey_moods.*,ey_users.user as name')
				->join('ey_users ON ey_moods.uid=ey_users.id')
                ->limit($num)
                ->select();
        return $rs;
    }

}
