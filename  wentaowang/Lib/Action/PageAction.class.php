<?php
class PageAction extends Action{
	//分页显示
	public function page(){
	
		$Book = M("Book");
		// 计算总数
		$count = $Book->count();
		// 导入分页类
		import("ORG.Util.Page");
		// 实例化分页类
		$p = new Page($count, 1);
		// 分页显示输出
		$page = $p->show();

		// 当前页数据查询
		$list = $Book->order('book_id ASC')->limit($p->firstRow.','.$p->listRows)->select();
		
		// 赋值赋值
		$this->assign('page', $page);
		$this->assign('list', $list);

		$this->display();
	}
}
?>