<?php
class admin extends spController
{
	function index(){
		$this->jump(spUrl('admin','societyInfo'));
	}

    function societyInfo(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $societyUserObj = spClass('libSocietyAccount');
        $info = $societyUserObj->findBy('id',$_SESSION['societyInfo']['id']);
        $this->societyInfo = $info;
        $this->display('adminSocietyInfo.html');
    }

    function societyInfoQrCode(){
        $id = (int)$this->spArgs('id');
        $pix = (int)$this->spArgs('pix');
        $pix = $pix?$pix:50;
        if($id){
            import('phpqrcode/qrlib.php');
            header('Content-type:image/png');
            QRcode::png('http://'.$_SERVER['SERVER_NAME'].spUrl('main','s',array('id'=>$id)),false,'H',$pix,5);
        } else {
            $this->jump(spUrl('main','index'));
        }
    }

    function societyInfoSave(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $societyUserObj = spClass('libSocietyAccount');
        $societyUserObj->verifier = $societyUserObj->verifierSocietyInfoSave;
        $verifier = $societyUserObj->spVerifier($this->spArgs());
        if( false == $verifier){
            $conditions['id'] = $_SESSION['societyInfo']['id'];
            $societyInfo['logo'] = $this->spArgs('logo');
            $societyInfo['desp'] = $this->spArgs('desp');
            if( $societyUserObj->update($conditions,$societyInfo) ){
                $this->success('更新成功',spUrl('admin','index'));
                return;
            } else {
                $this->error('unkonwn error');
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
    }

    function societyTeam(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $societyID = $_SESSION['societyInfo']['id'];
        $this->societyID = $societyID;
        $this->teams = spClass('libSocietyTeam')->findAll(array('society_id'=>$societyID));
        $this->display('adminSocietyTeam.html');
    }

    function societyTeamAdd(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $info['team_name'] = $this->spArgs('team_name');
        $info['society_id'] = (int)$this->spArgs('society_id');
        if(empty($info['society_id']) || empty($info['team_name'])){
            $this->error('不能为空');
            return;
        } else {
            $info['status'] = 1;
            if(spClass('libSocietyTeam')->create($info)){
                $this->success('添加成功',spUrl('admin','societyTeam'));
                return;
            } else {
                $this->error('添加失败');
                return;
            }
        }
    }

    function societyTeamEdit(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $info['team_name'] = $this->spArgs('team_name');
        $conditions['id'] = (int)$this->spArgs('team_id');
        if(empty($conditions['id']) || empty($info['team_name'])){
            $this->error('不能为空');
            return;
        } else {
            if(spClass('libSocietyTeam')->update($conditions,$info)){
                $this->success('修改成功',spUrl('admin','societyTeam'));
                return;
            } else {
                $this->error('修改失败');
                return;
            }
        }
    }

    function societyTeamChangeState(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $conditions['id'] = (int)$this->spArgs('tid');
        $info['status'] = (int)$this->spArgs('status');
        if($info['status']){
            $msg = '启用';
        } else {
            $msg = '停用';
        }
        if(empty($conditions['id']) ){
            $this->error('不能为空');
            return;
        } else {
            if(spClass('libSocietyTeam')->update($conditions,$info)){
                $this->success('已'.$msg,spUrl('admin','societyTeam'));
                return;
            } else {
                $this->error($msg.'失败');
                return;
            }
        }
    }

    function appRecruitAdmin(){
        $societyID = $_SESSION['societyInfo']['id'];
        if(!$societyID)$this->error('请先登录',spUrl('login','societyLogin'));
        $recruitObj = spClass('libAppRecruitResumeToSociety');
        $this->recruitInfo = $recruitObj->findAllRelations(array('sa_id'=>$societyID));
        $this->display('appRecruitAdmin.html');
    }

    function appRecruitDetail(){
        $societyID = $_SESSION['societyInfo']['id'];
        if(!$societyID)$this->error('请先登录',spUrl('login','societyLogin'));

        $id = (int)$this->spArgs('id');
        if(!$id)return;
        $recruitObj = spClass('libAppRecruitResumeToSociety');
        $result = $recruitObj->findAllRelations(array('id'=>$id));
        $this->recruitInfo = $result[0];
        $this->display('appRecruitDetail.html');

    }

    function appRecruitRm(){
        $societyID = $_SESSION['societyInfo']['id'];
        if(!$societyID)$this->error('请先登录',spUrl('login','societyLogin'));

        $id = (int)$this->spArgs('id');
        if( spClass('libAppRecruitResumeToSociety')->delete(array('id'=>$id)) ){
            $this->success('删除成功',spUrl('admin','appRecruitAdmin'));
            return;
        } else {
            $this->error('删除失败',spUrl('admin','appRecruitAdmin'));
            return;
        }
    }

    function changeRecruitStatus(){
        $societyID = $_SESSION['societyInfo']['id'];
        if(!$societyID)$this->error('请先登录',spUrl('login','societyLogin'));

        $status = (int)$this->spArgs('status');
        $id = (int)$this->spArgs('id');

        if(!$id || !$status)return;

        $recruitObj = spClass('libAppRecruitResumeToSociety');
        if( $recruitObj->update(array('id'=>$id),array('status'=>$status)) ){
            $this->success('状态更改成功',spUrl('admin','appRecruitAdmin'));
        } else {
            $this->error('状态更改失败',spUrl('admin','appRecruitAdmin'));
        }
    }

    function password(){
        $societyID = $_SESSION['societyInfo']['id'];
        if(!$societyID)$this->error('请先登录',spUrl('login','societyLogin'));

        $t = (int)$this->spArgs('t',0);
        if($t){
            $oriPass = $this->spArgs('ori_pass');
            $pass = $this->spArgs('pass');
            $repass = $this->spArgs('repass');
            if(!$oriPass){
                $this->error('请输入旧密码',spUrl('admin','password'));
                return;
            }
            if(!$pass){
                $this->error('请输入新密码',spUrl('admin','password'));
                return;
            }
            if(strlen($pass) < 8){
                $this->error('密码长度需要大于8位',spUrl('admin','password'));
                return;
            }
            if(!$repass){
                $this->error('请再输入一遍你的新密码',spUrl('admin','password'));
                return;
            }
            if(md5($pass) !== md5($repass)){
                $this->error('两遍密码输入不一致',spUrl('admin','password'));
                return;
            }

            $adminObj = spClass('libSocietyAccount');
            $ori = $adminObj->find(array('id'=>$societyID));
            if($ori['password'] !== md5($oriPass)){
                $this->error('旧密码错误',spUrl('admin','password'));
                return;
            }
            $adminObj->updateField(array('id'=>$societyID),'password',md5($pass));
            $this->success('修改密码成功');
            return;
        } else {
            $this->display('adminPassword.html');
        }
            
    }

    private function alert($msg) {
        echo json_encode(array('error' => 1, 'message' => $msg));
        exit;
    }


/* 上传处理函数，后期可能单独开一个类来存放 */
    function societyInfoUploadify(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $targetFolder = '/uploads/logo'; // Relative to the root
        $timestamp = $this->spArgs('timestamp');
        $verifyToken = md5('society_unique_salt_' . $timestamp);

        if (!empty($_FILES) && $this->spArgs('token') == $verifyToken) {
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            
            // Validate the file type
            $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
            $fileParts = pathinfo($_FILES['Filedata']['name']);
            if (in_array($fileParts['extension'],$fileTypes)) {
                $targetFile = rtrim($targetPath,'/') . '/' . md5($_SESSION['societyInfo']['society_login_name'].$timestamp) . '.' . $fileParts['extension'];
                move_uploaded_file($tempFile,$targetFile);
                chmod($targetFile, 0644);
                echo 1;
            } else {
                echo 'Invalid file type.';
            }
        }
    }

    function societyInfoKindEditor(){
        $uid = $_SESSION['societyInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','societyLogin'));
        $php_url = dirname($_SERVER['PHP_SELF']) . '/';
        //文件保存目录路径
        $save_path = APP_PATH . '/uploads/attached/';
        //文件保存目录URL
        $save_url = $php_url . '/uploads/attached/';
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png'),
        );
        //最大文件大小
        $max_size = 2000000;

        $save_path = realpath($save_path) . '/';

        //PHP上传失败
        if (!empty($_FILES['imgFile']['error'])) {
            switch($_FILES['imgFile']['error']){
                case '1':
                    $error = '超过php.ini允许的大小。';
                    break;
                case '2':
                    $error = '超过表单允许的大小。';
                    break;
                case '3':
                    $error = '图片只有部分被上传。';
                    break;
                case '4':
                    $error = '请选择图片。';
                    break;
                case '6':
                    $error = '找不到临时目录。';
                    break;
                case '7':
                    $error = '写文件到硬盘出错。';
                    break;
                case '8':
                    $error = 'File upload stopped by extension。';
                    break;
                case '999':
                default:
                    $error = '未知错误。';
            }
            $this->alert($error);
        }

        //有上传文件时
        if (empty($_FILES) === false) {
            //原文件名
            $file_name = $_FILES['imgFile']['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            //文件大小
            $file_size = $_FILES['imgFile']['size'];
            //检查文件名
            if (!$file_name) {
                $this->alert("请选择文件。");
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                $this->alert("上传目录不存在。");
            }
            //检查目录写权限
            if (@is_writable($save_path) === false) {
                $this->alert("上传目录没有写权限。");
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                $this->alert("上传失败。");
            }
            //检查文件大小
            if ($file_size > $max_size) {
                $this->alert("上传文件大小超过限制。");
            }
            //检查目录名
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name])) {
                $this->alert("目录名不正确。");
            }
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                $this->alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path);
                }
            }
            $ymd = date("Ymd");
            $save_path .= $ymd . "/";
            $save_url .= $ymd . "/";
            if (!file_exists($save_path)) {
                mkdir($save_path);
            }
            //新文件名
            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                $this->alert("上传文件失败。");
            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;

            echo json_encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }
}