<?php

namespace Admin\Model;

use Think\Model;

class ContentsModel extends Model {

    //获取指定文章
    public function getOne($id) {
        $res = $this->where('id=' . $id)->setInc('view');//阅读量+1
        $rs = $this->where('ey_contents.id=' . $id)
                ->join('ey_categorys ON ey_contents.cid=ey_categorys.id')
                ->join('ey_tags ON ey_contents.tid=ey_tags.id')
                ->field('ey_contents.*,ey_categorys.name as cate,ey_tags.name as tag')
                ->find();
        return $rs;
    }

    //获取文章列表
    public function getList($where = null, $page_size = 5) {//传入条件，显示条数
        $count = $this->where($where)->count(); // 查询满足要求的总记录数
        $Page = new \Think\Page($count, $page_size);
        $show = $Page->show(); // 分页显示输出
        $showPage = $Page->showPage(); // 分页显示输出
        $list = $this->where($where)
                ->join("ey_categorys ON ey_contents.cid=ey_categorys.id")
                ->join('ey_tags ON ey_contents.tid=ey_tags.id')
                ->join('ey_users ON ey_contents.uid=ey_users.id')
                ->field('ey_contents.*,ey_categorys.name as cate,ey_tags.name as tag,ey_users.user as name')
                ->order('time desc')
                ->limit($Page->firstRow . ',' . $Page->listRows)
                ->select();

        $rs['list'] = $list;  //集合
        $rs['page'] = $show;  //分页
        $rs['showPage'] = $showPage;  //分页
        $rs['count'] = $count; //总数
        return $rs;
    }

    //获取最新文章
    public function getNew($nums = 1) {
        $where['status'] = 1;
        $where['ispage'] = 1;
        $list = $this->limit($nums)->where($where)->order('time desc')->select();
        return $list;
    }

}
