<?php 
namespace Home\Controller;
	/* 
		工资模块
	*/
	class WagesgqController extends CommonController
	{
		
		public function index()
		{	
			$user=I('post.name');
			$section=I('post.section');
			$year=I('post.year');
			$condition['section']=array('LIKE','%'.$section.'%');
			$condition['name']=array('LIKE','%'.$user.'%');
				//依照时间搜索
			$model=M('Wagesgq');
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
			$model=M('Wagesgq');
			$model->create($post);
			if ($model->add()===false) {
				$this->error("添加出错".$model->getLastSql());
			}else{
				$this->success("添加成功");
			}
		}
		public function delete(){
			$id=I('get.id');
			$model=M('Wagesgq');
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
			$model=D("Wagesgq");
				//判断是否已经生成过
			$thisyearcount=$model->where(array('year'=>date('Y').date('m')))->count();
			if ($thisyearcount) {
				$this->error('已经有本月数据，请添加或导入');
			}
				//获取上月数据
			$selectwages=$model->where(array("year"=>$yeartime))->Field('num,section,name,card,level_wages,job_wages,proportion_subsidies,gaoxin_subsidies,port_subsidies,keep_subsidies,appropriate_subsidies,job_subsidies,haiguan_subsidies,onechild,phone_subsidies,giveadd,de_gongjijing,de_medicalinsurance,de_unemploy,de_onechild,de_phone,de_other,de_taxadd,individualtax,rent,deduct_add,wages')->select();
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

		public function insert(){//导入工资	
			
			$this->display();
		}
		public function edit(){
			$map=I("get.id");
			$model=M('Wagesgq')->where(array('id'=>$map))->find();
			$this->assign("data",$model);
			$this->display();
		}
		public function editinsert(){
			$post=I('post.');
			$model=M('Wagesgq');
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
				$level_wages+=$value['level_wages'];
				$job_wages+=$value["job_wages"];
			    $proportion_subsidies+=$value['proportion_subsidies'];
			    $gaoxin_subsidies+=$value['gaoxin_subsidies'];
			    $port_subsidies+=$value['port_subsidies'];
			    $keep_subsidies+=$value['keep_subsidies'];
			    $appropriate_subsidies+=$value['appropriate_subsidies'];
			    $job_subsidies+=$value['job_subsidies'];
			    $haiguan_subsidies+=$value['haiguan_subsidies'];
			    $onechild+=$value['onechild'];
			    $phone_subsidies+=$value['phone_subsidies'];
			    $giveadd+=$value['giveadd'];
			    $de_gongjijing+=$value['de_gongjijing'];
			    $de_medicalinsurance+=$value['de_medicalinsurance'];
			    $de_unemploy+=$value['de_unemploy'];
			    $de_onechild+=$value['de_onechild'];
			    $de_phone+=$value['de_phone'];
			    $de_other+=$value['de_other'];
			    $de_taxadd+=$value['de_taxadd'];
			    $individualtax+=$value['individualtax'];
			    $rent+=$value['rent'];
			    $deduct_add+=$value['deduct_add'];
			    $wages+=$value['wages'];
			}
			$add['name']="合计";
		    $add["level_wages"]=$level_wages;
			$add["job_wages"]=$job_wages;
		    $add['proportion_subsidies']=$proportion_subsidies;
		    $add['gaoxin_subsidies']=$gaoxin_subsidies;
		    $add['port_subsidies']=$port_subsidies;
		    $add['keep_subsidies']=$keep_subsidies;
		    $add['appropriate_subsidies']=$appropriate_subsidies;
		    $add['job_subsidies']=$job_subsidies;
		    $add['haiguan_subsidies']=$haiguan_subsidies;
		    $add['onechild']=$onechild;
		    $add['phone_subsidies']=$phone_subsidies;
		    $add['giveadd']=$giveadd;
		    $add['de_gongjijing']=$de_gongjijing;
		    $add['de_medicalinsurance']=$de_medicalinsurance;
		    $add['de_unemploy']=$de_unemploy;
		    $add['de_onechild']=$de_onechild;
		    $add['de_phone']=$de_phone;
		    $add['de_other']=$de_other;
		    $add['de_taxadd']=$de_taxadd;
		    $add['individualtax']=$individualtax;
		    $add['rent']=$rent;
		    $add['deduct_add']=$deduct_add;
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
			$xlsName  = "wagesgq";
			$xlsCell  = array(
			array('id','序列'),
			array('num','序号'),
			array('section','部门名称'),
			array('name','名字'),
			array('card','卡号'),
			array('level_wages','级别工资'),
			array('job_wages','职务工资'),
			array('proportion_subsidies','按比例计算的津贴'),
			array('gaoxin_subsidies','高新补贴'),
			array('port_subsidies','口岸补贴'),
			array('keep_subsidies','保留津贴'),
			array('appropriate_subsidies','适当补贴'),
			array('job_subsidies','职务补贴'),
			array('haiguan_subsidies','海关津贴'),
			array('onechild','独生子女费'),
			array('phone_subsidies','移动电话费'),
			array('giveadd','应发合计'),
			array('de_gongjijing','所得税扣除公积金'),
			array('de_medicalinsurance','所得税扣除医疗保险'),
			array('de_unemploy','所得税扣除失业保险'),
			array('de_onechild','所得税扣除独生子女'),
			array('de_phone','所得税扣除移动电话及座机'),
			array('de_other','所得税扣除其他扣款'),
			array('de_taxadd','应缴税所得额'),
			array('individualtax','个人所得税'),
			array('rent','房租'),
			array('deduct_add','应扣合计'),
			array('wages','实发工资'),
			array('year','年月份')
			);
			$xlsModel = M('Wagesgq');

				$month = date('m');
				$year = date('Y');
				$condition['year']=$year.$month;

			$xlsData  = $xlsModel->Field('id,num,section,name,card,level_wages,job_wages,proportion_subsidies,gaoxin_subsidies,port_subsidies,keep_subsidies,appropriate_subsidies,job_subsidies,haiguan_subsidies,onechild,phone_subsidies,giveadd,de_gongjijing,de_medicalinsurance,de_unemploy,de_onechild,de_phone,de_other,de_taxadd,individualtax,rent,deduct_add,wages,year,time')->where($condition)->select();
			foreach ($xlsData as $value) {
				$value['time']=date("Y-m-d", $value['time']) ;//将查出来的时间戳转换成时间
				$k[]=$value;
				//添加'合计'功能
				$level_wages+=$value['level_wages'];
				$job_wages+=$value["job_wages"];
			    $proportion_subsidies+=$value['proportion_subsidies'];
			    $gaoxin_subsidies+=$value['gaoxin_subsidies'];
			    $port_subsidies+=$value['port_subsidies'];
			    $keep_subsidies+=$value['keep_subsidies'];
			    $appropriate_subsidies+=$value['appropriate_subsidies'];
			    $job_subsidies+=$value['job_subsidies'];
			    $haiguan_subsidies+=$value['haiguan_subsidies'];
			    $onechild+=$value['onechild'];
			    $phone_subsidies+=$value['phone_subsidies'];
			    $giveadd+=$value['giveadd'];
			    $de_gongjijing+=$value['de_gongjijing'];
			    $de_medicalinsurance+=$value['de_medicalinsurance'];
			    $de_unemploy+=$value['de_unemploy'];
			    $de_onechild+=$value['de_onechild'];
			    $de_phone+=$value['de_phone'];
			    $de_other+=$value['de_other'];
			    $de_taxadd+=$value['de_taxadd'];
			    $individualtax+=$value['individualtax'];
			    $rent+=$value['rent'];
			    $deduct_add+=$value['deduct_add'];
			    $wages+=$value['wages'];
			}
			$add['name']="合计";
		    $add["level_wages"]=$level_wages;
			$add["job_wages"]=$job_wages;
		    $add['proportion_subsidies']=$proportion_subsidies;
		    $add['gaoxin_subsidies']=$gaoxin_subsidies;
		    $add['port_subsidies']=$port_subsidies;
		    $add['keep_subsidies']=$keep_subsidies;
		    $add['appropriate_subsidies']=$appropriate_subsidies;
		    $add['job_subsidies']=$job_subsidies;
		    $add['haiguan_subsidies']=$haiguan_subsidies;
		    $add['onechild']=$onechild;
		    $add['phone_subsidies']=$phone_subsidies;
		    $add['giveadd']=$giveadd;
		    $add['de_gongjijing']=$de_gongjijing;
		    $add['de_medicalinsurance']=$de_medicalinsurance;
		    $add['de_unemploy']=$de_unemploy;
		    $add['de_onechild']=$de_onechild;
		    $add['de_phone']=$de_phone;
		    $add['de_other']=$de_other;
		    $add['de_taxadd']=$de_taxadd;
		    $add['individualtax']=$individualtax;
		    $add['rent']=$rent;
		    $add['deduct_add']=$deduct_add;
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
			$month = date('m');
			$year = date('Y');
			//$last_month = $month - 1;

			/*if($month == 1){
				$last_month = 12;
				$year = $year - 1;
			}*/
			$yeartime=$year.$month;

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
					$data['level_wages']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
					$data['job_wages']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
					$data['proportion_subsidies']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
					$data['gaoxin_subsidies']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
					$data['port_subsidies']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
					$data['keep_subsidies']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
					$data['appropriate_subsidies']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
					$data['job_subsidies']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
					$data['haiguan_subsidies']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
					$data['onechild']= $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
					$data['phone_subsidies']= $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
					$data['giveadd']= $objPHPExcel->getActiveSheet()->getCell("Q".$i)->getValue();
					$data['de_gongjijing']= $objPHPExcel->getActiveSheet()->getCell("R".$i)->getValue();
					$data['de_medicalinsurance']= $objPHPExcel->getActiveSheet()->getCell("S".$i)->getValue();
					$data['de_unemploy']= $objPHPExcel->getActiveSheet()->getCell("T".$i)->getValue();
					$data['de_onechild']= $objPHPExcel->getActiveSheet()->getCell("U".$i)->getValue();
					$data['de_phone']= $objPHPExcel->getActiveSheet()->getCell("V".$i)->getValue();
					$data['de_other']= $objPHPExcel->getActiveSheet()->getCell("W".$i)->getValue();
					$data['de_taxadd']= $objPHPExcel->getActiveSheet()->getCell("X".$i)->getValue();
					$data['individualtax']= $objPHPExcel->getActiveSheet()->getCell("Y".$i)->getValue();
					$data['rent']= $objPHPExcel->getActiveSheet()->getCell("Z".$i)->getValue();
					$data['deduct_add']= $objPHPExcel->getActiveSheet()->getCell("AA".$i)->getValue();
					$data['wages']= $objPHPExcel->getActiveSheet()->getCell("AB".$i)->getValue();
					$data['year']= $objPHPExcel->getActiveSheet()->getCell("AC".$i)->getValue();

					$data['time']= time();
					//$data['year']=$yeartime;

					//$data['res_id'] =1;

					//$data['last_login_time']=0;
					//$data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
					//$data['login_count']=0;
					//$data['join']=0;
					//$data['avatar']='';
					//$data['password']=md5('123456');
					M('Wagesgq')->add($data);
				}
				$this->success('导入成功！');
			}else
			{
				$this->error("请选择上传的文件");
			}
				

		}
	}
 ?>