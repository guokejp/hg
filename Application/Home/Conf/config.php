<?php
return array(
	'DB_TYPE'=>'mysql',
	'DB_USER'=>'root',
	'DB_HOST'=>'localhost',
	'DB_PWD'=>'root',
	'DB_PORT'=>'3306',
	'DB_PREFIX'=>'hg_',
	'DB_NAME'=>'hg',
	'URL_MODEL'=>'3',
	'TMPL_L_DELIM'=>'<{',
	'TMPL_R_DELIM'=>'}>',
	'URL_HTML_SUFFIX'=>'',

	'TMPL_L_DELIM'	=>	'<{',
	'TMPL_R_DELIM'	=>	'}>',

	'URL_HTML_SUFFIX'	=>	'',

	'ADMIN_AUTH_ID'			=>	'a33b0950bd33a719b997e7c07a28ccb4',
	'ADMIN_AUTH_NAME'		=>	'ee1acda9a1c6885ca4815b565335bf4d',
	'ADMIN_AUTH_NUMBER'		=>	'34a185f2509b9a9365360e42e1f8ccba',
	'ADMIN_AUTH_SECTIONID'	=>	'eb611c376ac9aa62672cf450b483b1b9',
	'ADMIN_AUTH_SECTIONNAME'=>	'04941313b6fcea77c27bc5545d398fe8',
	'ADMIN_AUTH_UNITID'		=>	'8daac27b48af2669aff78daca9413eae',
	'ADMIN_AUTH_UNITNAME'	=>	'473cc29f08548c4be76f4caf3628d36c',
	'ADMIN_AUTH_ROLEID'		=>	'373cc29f08548c4be76f4caf3628d36x',

	'TERM_ID'	=>	'c143a55a53523bd3d3b85d5ab0bd92c4',//修改这个同步修改View/Conference/index
	'TERM_NAME'	=>	'6937233cbc12d295feae0712d607a371',//修改这个要修改View/Special/add

	 /* 数据库备份相关 */
    'DATA_BACKUP_PATH' => './Data/',
    'DATA_BACKUP_PART_SIZE' => 20971520,
    'DATA_BACKUP_COMPRESS' => 1,
    'DATA_BACKUP_COMPRESS_LEVEL' => 9,

    
	'AUTH_CONFIG'=>array(
		'AUTH_ON'=>true,
		'AUTH_TYPE'=>1,
		'AUTH_GROUP'=>'hg_role',
		'AUTH_GROUP_ACCESS' =>'hg_staff',
		'AUTH_RULE'=>'hg_rule',
		'AUTH_USER'=>'hg_staff'
	),

	'AUTH_ACCESS'=>array(
		)
);