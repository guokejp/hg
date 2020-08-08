<?php 
namespace Home\Controller;
	/* 
		工资模块
	*/
	class WagestxController extends CommonController
	{
		
		public function index()
		{	
			$user=I('post.name');
			$section=I('post.section');
			$year=I('post.year');
			$condition['section']=array('LIKE','%'.$section.'%');
			$condition['name']=array('LIKE','%'.$user.'%');
				//依照时间搜索
			$model=M('Wagestx');
			$selectyear=$model->distinct(true)->order('year desc')->field('year')->select();
			$selectsection=$model->distinct(true)->field('section')->select();
			if (!$year) {
				$condition['year']=array('LIKE','%'.$selectyear['0']['year'].'%');
			}else{
				$condition['year']=array('LIKE','%'.$year.'%');
			}	
			
			$this->assign('year',$selectyear);
			$this->assign('sectionlist',$selectsection);

			$this->_list($model,$condition);
			//$list=$model->where($condition)->select();
			//$this->assign('data',$list);
			$this->display();
		}
		public function add(){
			$sectionmodel=M('Section');
			$section=$sectionmodel->field('name')->select();
			$this->assign('sectionlist',$section);
			$this->display();
		}
		public function addinsert(){
			$post=I('post.');
			if (!$post['section']) {
				$this->error('请选择部门');
			}
			$model=M('Wagestx');
			$model->create($post);
			if ($model->add()===false) {
				$this->error("添加出错".$model->getLastSql());
			}else{
				$this->success("添加成功");
			}
		}
		public function delete(){
			$id=I('get.id');
			$model=M('Wagestx');
			if(false === $model->where('id='.$id)->delete()){
				$this->error('删除发生错误!');
			}
			$this->success('删除成功!');
		}
		public function make(){
			$month = date('m');
			$year = date('Y');
			$last_month = $month - 1;

			if($month == 1){
				$last_month = 12;
				$year = $year - 1;
			}
			$yeartime=$year.$last_month;
			//$date1=mktime(0, 0, 0, $last_month, 0, $year);
			//$date2=mktime(0, 0, 0, $month, 0, $year);
			$model=D("Wagestx");
			//判断是否已经生成过
			$thisyearcount=$model->where(array('year'=>date('Y').date('m')))->count();
			if ($thisyearcount) {
				$this->error('已经有本月数据，请添加或导入');
			}
				//获取上月数据
			$selectwages=$model->where(array("year"=>$yeartime))->Field('num,section,name,card,retire_wages,retire_subsidies,officialphone,lawpolice_subsidies,nursing,keep_subsidies,wages,year')->select();
			foreach ($selectwages as $avalue) {
				$avalue['year']=date('Y').date('m');
				$wages[]=$avalue;
			}
			foreach ($wages as $value) {
				if ($model->create($value)===false) {
					$this->error($model->getError());
				}
				if ($model->add()===false) {
					$this->error("生成失败".$model->getLastSql());
				}
			}
			$this->success("生成成功");
		}

		public function insert(){
			
			$this->display();
		}
		public function edit(){
			$map=I("get.id");
			$model=M('Wagestx')->where(array('id'=>$map))->find();
			$this->assign("data",$model);
			$this->display();
		}
		public function editinsert(){
			$post=I('post.');
			$model=M('Wagestx');
			$model->create($post);
			if ($model->save()===false) {
				$this->error("修改出错".$model->getLastSql());
			}else{
				$this->success("修改成功");
			}
		}
		protected function _list($model,$map=array())
		{

			//if(I('post.invoiceid')!==''){
			//	$map['invoiceid']=array('LIKE','%'.I('post.invoiceid').'%');
			//}

			//获取总数
			//$count=$model->where($map)->count();

			//获取每页显示数量
			/*if(I('post.numPerPage')!==""){
				$listRows=I('post.numPerPage');
			}else{
				$listRows=20;
			}*/

			//获取当前页码
			/*if(I('post.pageNum') !=="") {
				$nowPage=I('post.pageNum');
			}else{
				$nowPage=1;
			}
			$_GET['p']=$nowPage;

			import("ORG.Util.Page");
			$p = new \Think\Page($count,$listRows);*/

			//$list = $model->where($map)->order('id desc')->limit($p->firstRow.','.$p->listRows)->select();
			$list = $model->where($map)->order('id desc')->select();
			//添加"合计"功能
			foreach ($list as $value) {
				$retire_wages+=$value["retire_wages"];
			    $retire_subsidies+=$value["retire_subsidies"];
			    $officialphone+=$value['officialphone'];
			    $lawpolice_subsidies+=$value['lawpolice_subsidies'];
			    $nursing+=$value['nursing'];
			    $keep_subsidies+=$value['keep_subsidies'];
			    $wages+=$value['wages'];
			}
			$add['name']="合计";
			$add["retire_wages"]=$retire_wages;
		    $add["retire_subsidies"]=$retire_subsidies;
		    $add["officialphone"]=$officialphone;
		    $add['lawpolice_subsidies']=$lawpolice_subsidies;
		    $add['nursing']=$nursing;
		    $add['keep_subsidies']=$keep_subsidies;
		  	$add['wages']=$wages;
		  	$add['time']=time();
		  	$list[]=$add;
			//分页显示
			//$page = $p->show();

			$this->assign('section',$section);
			$this->assign('list',$list);
			/*$this->assign("totalCount",$count);
			$this->assign("numPerPage",$p->listRows);
			$this->assign("currentPage",$nowPage);*/
		}

		

	/**
	 *
	 * 导出Excel
	 */
		function expUser(){//导出Excel
			$xlsName  = "wagestx";
			$xlsCell  = array(
			array('id','序列'),
			array('num','序号'),
			array('section','部门名称'),
			array('name','名字'),
			array('card','卡号'),
			array('retire_wages','离（退）休费'),
			array('retire_subsidies','离（退）休人员补贴'),
			array('officialphone','公务电话费'),
			array('lawpolice_subsidies','政法干警补贴'),
			array('nursing','护理费'),
			array('keep_subsidies','保留津贴'),
			array('wages','实发工资'),
			array('year','年月份')
			);
			$xlsModel = M('Wagestx');

				$month = date('m');
				$year = date('Y');
				$condition['year']=$year.$month;

			$xlsData  = $xlsModel->Field('id,num,section,name,card,retire_wages,retire_subsidies,officialphone,lawpolice_subsidies,nursing,keep_subsidies,wages,year,time')->where($condition)->select();
			foreach ($xlsData as $value) {
				$value['time']=date("Y-m-d", $value['time']) ;//将查出来的时间戳转换成时间
				$k[]=$value;
				//添加'合计'功能
				$retire_wages+=$value["retire_wages"];
			    $retire_subsidies+=$value["retire_subsidies"];
			    $officialphone+=$value['officialphone'];
			    $lawpolice_subsidies+=$value['lawpolice_subsidies'];
			    $nursing+=$value['nursing'];
			    $keep_subsidies+=$value['keep_subsidies'];
			    $wages+=$value['wages'];
			}
			$add['name']="合计";
			$add["retire_wages"]=$retire_wages;
		    $add["retire_subsidies"]=$retire_subsidies;
		    $add["officialphone"]=$officialphone;
		    $add['lawpolice_subsidies']=$lawpolice_subsidies;
		    $add['nursing']=$nursing;
		    $add['keep_subsidies']=$keep_subsidies;
		  	$add['wages']=$wages;
		  	$k[]=$add;
			$this->exportExcel($xlsName,$xlsCell,$k);//exportExcel为导出函数，在CommonAction中
				
		}
		/**
		 *
		 * 显示导入页面 ...
		 */

		
/**实现导入excel
		 **/
		function impUser(){
			if (!empty($_FILES)) {
				//import("@.ORG.UploadFile");
				import('ORG.Net.UploadFile');
				$config=array(
	                'allowExts'=>array('xlsx','xls'),
	                'savePath'=>'./Public/upload/',
	                'saveRule'=>'time',
				);
				$upload = new \Think\Upload();
				$info   =   $upload->upload();
				if (!$info) {
					$this->error($upload->getError());
				}

				import("Org.Util.PHPExcel");
				$file_name="./Uploads/".$info['import']['savepath'].$info['import']['savename'];
				$objReader = \PHPExcel_IOFactory::createReader('Excel5');
				$objPHPExcel = $objReader->load($file_name,$encode='utf-8');
				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow(); // 取得总行数
				$highestColumn = $sheet->getHighestColumn(); // 取得总列数
				for($i=3;$i<=$highestRow;$i++)
				{
					$data['num']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
					$data['section'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
					$data['name'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
					$data['card']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
					$data['retire_wages']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
					$data['retire_subsidies']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
					$data['officialphone']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
					$data['lawpolice_subsidies']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
					$data['nursing']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
					$data['keep_subsidies']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
					$data['wages']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
					$data['year']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();

					
					$data['time']= time();

					//$data['res_id'] =1;

					//$data['last_login_time']=0;
					//$data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
					//$data['login_count']=0;
					//$data['join']=0;
					//$data['avatar']='';
					//$data['password']=md5('123456');
					M('Wagestx')->add($data);
				}
				$this->success('导入成功！');
			}else
			{
				$this->error("请选择上传的文件");
			}
				

		}
	}
 ?>