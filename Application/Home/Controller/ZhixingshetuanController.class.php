<?php
namespace Home\Controller;
/*执行-社团模块*/

class ZhixingshetuanController extends CommonController
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
		$overlookmodel=D('Zxshetuan');
		if($overlookmodel->check($overlook)){
			$this->error("已经有此记录");
		}
		$zhixingmoneymodel=M('Zxshetuan');

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
		$overlookmodel=D('Zxshetuan');
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
		$data=M('Zxshetuan')->where(array('id'=>$get))->find();
		$this->assign('data',$data);
		$this->display();
	}
	public function usesave(){
		$post=I('post.');
		//存储概览信息
		$post['aa']['id']=$post['id'];
		$zhixingmoneymodel=M('Zxshetuan');
		if(false===$zhixingmoneymodel->create($post['aa'])){
			$this->error("create失败！");
		}
		if (false===$zhixingmoneymodel->save()) {
			$this->error($zhixingmoneymodel->getLastSql());
		}
		$this->success('插入成功');
	}
	public function look(){
		$year=M('Zxshetuan')->field('year')->distinct(true)->select();
		$this->assign('year',$year);

		if (4==session(C('ADMIN_AUTH_ID'))) {
			$post['unitid']=session(C('ADMIN_AUTH_UNITID'));
		}
		$post['year']=I('post.postyear');
		$post['month']=I('post.postmonth');
		$zxshetuanmodel=M('Zxshetuan');
		$select=$zxshetuanmodel->where($post)->select();
		foreach ($select as $value) {
			$value['inadd']=$value['inhuifei']+$value['inyewu'];
			$value['outadd']=$value['outyewu']+$value['outguanli'];
			$value['thisadd']=$value['lastadd']+$value['inadd']-$value['outadd'];
			$data[]=$value;
		}

		foreach ($data as $value) {
			$addvalue['sectionname']='合计';
			$addvalue['lastadd']+=$value['lastadd'];
			$addvalue['inhuifei']+=$value['inhuifei'];
			$addvalue['inyewu']+=$value['inyewu'];
			$addvalue['outyewu']+=$value['outyewu'];
			$addvalue['outguanli']+=$value['outguanli'];
			$addvalue['inadd']+=$value['inadd'];
			$addvalue['outadd']+=$value['outadd'];
			$addvalue['thisadd']+=$value['thisadd'];
		}
		$data[]=$addvalue;
		$this->assign('data',$data);
		$this->display();
	}
	
}
?>