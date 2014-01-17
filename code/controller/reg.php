<?php
class reg extends spController
{
	function index(){
		$this->jump(spUrl('main', 'index'));
	}

	function memberReg(){
        $this->display('memberReg.html');
	}

	function memberRegSave(){
        $memberObj = spClass('libMemberAccount');
        $memberObj->verifier = $memberObj->verifierReg;
        $verifier = $memberObj->spVerifier($this->spArgs());
        if( false == $verifier){
            $memberInfo = $this->spArgs();
            $memberInfo['enable'] = 1;
            $memberInfo['password'] = md5($memberInfo['password']);
            if( $memberObj->create($memberInfo) ){
                $this->success('注册成功',spUrl('login','memberLogin'));
                return;
            } else {
                $this->error('unkonwn error');
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
	}

	function societyReg(){
		$this->display('societyReg.html');
	}

	function societyRegSave(){
        $societyUserObj = spClass('libSocietyAccount');
        $societyUserObj->verifier = $societyUserObj->verifierReg;
        $verifier = $societyUserObj->spVerifier($this->spArgs());
        if( false == $verifier){
            $societyInfo = $this->spArgs();
            $societyInfo['enable'] = 0;
            $societyInfo['password'] = md5($societyInfo['password']);
            if( $societyUserObj->create($societyInfo) ){
                $this->success('注册成功',spUrl('login','societyLogin'));
                return;
            } else {
                $this->error('unkonwn error');
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
	}
}