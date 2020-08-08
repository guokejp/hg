<?php
namespace Home\Controller;
/*执行-事业模块*/

class ZhixingshiyeController extends CommonController
{
	
	public function useadd(){
		$this->display();
	}
	public function useaddinsert(){
		$post=I('post.');
		//存储概览信息
		
		$overlook['year']=$post['year'];
		$overlook['month']=$post['month'];
		$overlook['sectionname']=$post['sectionname'];
		$overlookmodel=D('Zxshiye');
		if($overlookmodel->check($overlook)){
			$this->error("已经有此记录");
		}
		$zhixingmoneymodel=M('Zxshiye');

		$post['aa']['year']=$post['year'];
		$post['aa']['month']=$post['month'];
		$post['aa']['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$post['aa']['sectionname']=$post['sectionname'];
		$post['aa']['time']=time();
		if(false===$zhixingmoneymodel->create($post['aa'])){
			$this->error("create失败！");
		}
		if (false===$zhixingmoneymodel->add()) {
			$this->error($zhixingmoneymodel->getLastSql());
		}
		$this->success('插入成功');
	}
	public function useeditoverlook(){
		$overlookmodel=D('Zxshiye');
		$count=$overlookmodel->count();
		if(I('post.numPerPage')!==''){
			$listRows=I('post.numPerPage');
		}else{
			$listRows=20;
		}
		if(I('post.pageNum') !=='') {
			$nowPage=I('post.pageNum');
		}else{
			$nowPage=1;
		}
		$_GET['p']=$nowPage;
		$p=new \Think\Page($count,$listRows);

		$map['unitid']=session(C('ADMIN_AUTH_UNITID'));
		$data=$overlookmodel->where($map)->field('id,year,month,sectionname,time')->limit($p->firstRow.','.$p->listRows)->order('id desc')->select();
		$this->assign('list',$data);
		$this->assign("totalCount",$count);
		$this->assign("numPerPage",$p->listRows);
		$this->assign("currentPage",$nowPage);
		$this->display();
	}
	public function useedit(){
		$get=I('get.id');
		$data=M('Zxshiye')->where(array('id'=>$get))->find();
		$this->assign('data',$data);
		$this->display();
	}
	public function usesave(){
		$post=I('post.');
		//存储概览信息
		$post['aa']['id']=$post['id'];
		$zhixingmoneymodel=M('Zxshiye');
		if(false===$zhixingmoneymodel->create($post['aa'])){
			$this->error("create失败！");
		}
		if (false===$zhixingmoneymodel->save()) {
			$this->error($zhixingmoneymodel->getLastSql());
		}
		$this->success('插入成功');
	}
	public function look(){
		$year=M('Zxshiye')->field('year')->distinct(true)->select();
		$this->assign('year',$year);

		if (4==session(C('ADMIN_AUTH_ID'))) {
			$post['unitid']=session(C('ADMIN_AUTH_UNITID'));
		}
		$post['year']=I('post.postyear');
		$post['month']=I('post.postmonth');
		$zxshiyemodel=M('Zxshiye');
		$select=$zxshiyemodel->where($post)->select();
		foreach ($select as $value) {
			$value['lastadd']=$value['lastshiye']+$value['lastzhuanyong'];
			$value['inadd']=$value['inshiye']+$value['injingying'];
			$value['outadd']=$value['outshiye']+$value['outjingying'];
			$value['inoutshiye']=$value['lastshiye']+$value['inshiye']-$value['outshiye'];
			$value['inoutjingying']=$value['lastzhuanyong']+$value['injingying']-$value['outjingying'];
			$value['inoutadd']=$value['inoutshiye']+$value['inoutjingying'];
			$data[]=$value;
		}

		foreach ($data as $value) {
			$addvalue['sectionname']='合计';
			$addvalue['lastshiye']+=$value['lastshiye'];
			$addvalue['lastzhuanyong']+=$value['lastzhuanyong'];
			$addvalue['inshiye']+=$value['inshiye'];
			$addvalue['injingying']+=$value['injingying'];
			$addvalue['outshiye']+=$value['outshiye'];
			$addvalue['outjingying']+=$value['outjingying'];
			$addvalue['lastadd']+=$value['lastadd'];
			$addvalue['inadd']+=$value['inadd'];
			$addvalue['outadd']+=$value['outadd'];
			$addvalue['inoutshiye']+=$value['inoutshiye'];
			$addvalue['inoutjingying']+=$value['inoutjingying'];
			$addvalue['inoutadd']+=$value['inoutadd'];
		}
		$data[]=$addvalue;
		$this->assign('data',$data);
		$this->display();
	}
	
}
?>