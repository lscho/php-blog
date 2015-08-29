<?php

namespace Admin\Model;

use Think\Model;

class CategorysModel extends Model {

    //获取分类列表
    public function getList() {
        $where['tid']=1;
        $count = $this->where($where)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, 10);
        $show = $Page->show(); // 分页显示输出
        $showPage = $Page->showPage(); // 分页显示输出
        $list = $this->where($where)
                ->order('id desc')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->select();
        $rs['showPage'] = $showPage;
        $rs['count'] = $count;
        $rs['list'] = $list;
        $rs['page'] = $show;
        return $rs;
    }
    //获取全部分类
    public function getAll(){
        $rs=$this->where('tid=1')->select();
        return $rs;
    }

}
