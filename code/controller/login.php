<?php
class login extends spController
{
	function index(){
		$this->jump(spUrl('main', 'index'));
	}

	function memberLogin(){
        $this->display("memberLogin.html");
        return;
	}

	function societyLogin(){
		$this->display("societyLogin.html");
        return;
	}

	function memberLoginCheck(){
        $memberObj = spClass('libMemberAccount');
        $memberObj->verifier = $memberObj->verifierLogin;
        $verifier = $memberObj->spVerifier($this->spArgs());
        if( false == $verifier){
            $username = $this->spArgs('username');
            $password = md5($this->spArgs('password'));
            $result = $memberObj->findBy('username',$username);
            if( $result['password'] == $password ){
                spClass('spAcl')->set('GBUSER');
                $_SESSION['userInfo'] = array(
                    'id'=>$result['id'],
                    'username'=>$result['username']
                    );
                $this->success('登陆成功',spUrl('main','index'));
                return;
            } else {
                $this->error('用户名或密码错误');
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
	}

	function societyLoginCheck(){
        $societyUserObj = spClass('libSocietyAccount');
        $societyUserObj->verifier = $societyUserObj->verifierLogin;
        $verifier = $societyUserObj->spVerifier($this->spArgs());
        if( false == $verifier){
            $loginName = $this->spArgs('society_login_name');
            $password = md5($this->spArgs('password'));
            $result = $societyUserObj->findBy('society_login_name',$loginName);
            if( $result['password'] == $password ){
                spClass('spAcl')->set('GBADMIN');
                $_SESSION['societyInfo'] = array(
                    'id'=>$result['id'],
                    'society_login_name'=>$result['society_login_name'],
                    'society_name'=>$result['society_name']
                    );
                $this->success('登陆成功',spUrl('admin','index'));
                return;
            } else {
                $this->error('用户名或密码错误');
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
	}

    function societyLogout(){
        spClass('spAcl')->set('');
        unset($_SESSION['societyInfo']);
        $this->success('退出成功',spUrl('login','societyLogin'));
    }

    function memberLogout(){
        spClass('spAcl')->set('');
        unset($_SESSION['userInfo']);
        $this->success('退出成功',spUrl('main','index'));
    }
}