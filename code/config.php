<?php
define("APP_PATH",dirname(__FILE__));
define("SP_PATH",dirname(__FILE__).'/SpeedPHP');
$spConfig = array(
    'db' => array( // 数据库设置
        'host' => $_SERVER['SOCIETY_HOST'],  // 数据库地址
        'login' => $_SERVER['SOCIETY_USER'], // 数据库用户名
        'password' => $_SERVER['SOCIETY_PASS'], // 数据库密码
        'database' => $_SERVER['SOCIETY_DB'], // 数据库的库名称
        'prefix' => $_SERVER['SOCIETY_PREFIX'] // 表前缀
    ),
    'view' => array( // 视图配置
        'enabled' => TRUE, // 开启视图
        'config' =>array(
            'template_dir' => APP_PATH.'/tpl', // 模板目录
        ),
        'engine_name' => 'speedy', // 模板引擎的类名称
        'engine_path' => SP_PATH.'/Drivers/speedy.php', // 模板引擎主类路径
    ),
    'launch' => array( 
        'router_prefilter' => array( 
            array('spAcl','mincheck'), // 开启有限的权限控制
            array('spUrlRewrite', 'setReWrite')  // 对路由进行挂靠，处理转向地址
        ),
        'function_url' => array(
            array("spUrlRewrite", "getReWrite"),  // 对spUrl进行挂靠，让spUrl可以进行Url_ReWrite地址的生成
        ),
    ),
    'ext' => array(
        'spUrlRewrite' => array(
            'suffix' => '', 
            'sep' => '/', 
            'map' => array( 
                's' => 'main@s',
                'memberLogin' => 'login@memberLogin',
                'memberLoginCheck'=>'login@memberLoginCheck',
                'memberLogout'=>'login@memberLogout',
                'memberReg' => 'reg@memberReg',
                'memberRegSave' => 'reg@memberRegSave',
                'listMyResumes' => 'main@listMyResumes',
                'listFav'=>'main@listFav',
                'myResumedSocieties'=>'main@myResumedSocieties',
                'myResumes'=>'main@myResumes',
                'saveMyResumes'=>'main@saveMyResumes',
                'sentResumes'=>'main@sentResumes',
                'rmMyResumes'=>'main@rmMyResumes',       
            ),
            'args' => array(
                's' => array('id'),
                'listMyResumes' => array('sid','tid'),
                /*'myResumes'=> array('id','sid','tid'),*/
                'myResumes'=> array('sid','tid'),
                'sentResumes'=>array('id','sid','tid'),
                'rmMyResumes'=>array('id')
            )
        )
    )
);
