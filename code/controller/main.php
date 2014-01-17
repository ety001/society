<?php
class main extends spController
{
	function index(){
        //查找所有的社团帐号信息
        $societyUserObj = spClass('libSocietyAccount');
        $allSocieties = $societyUserObj->findAll();
        $this->allSocieties = $allSocieties;
        $this->isLogin = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
		$this->display('main/index.html');
	}

    //society's Info
    function s(){
        $this->isLogin = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        $societyID = (int)$this->spArgs('id');
        if($societyID){
            //查询当前社团id的社团信息
            $societyUserObj = spClass('libSocietyAccount');
            $societyInfo = $societyUserObj->find(array('id'=>$societyID));
            if($societyInfo['enable']!=1)$this->jump(spUrl('main','index'));
            //获取是否已关注
            $isFav = spClass('libFollowSociety')->isFav($_SESSION['userInfo']['id'],$societyID);
            //获取可以报名的小组名
            $this->teams = spClass('libSocietyTeam')->findAll(array('society_id'=>$societyID));
            //判断该用户是否已报名该社团
            if($this->isLogin){
                $this->hasResume = spClass('libAppRecruitResumeToSociety')->find(array('uid'=>$this->isLogin,'sa_id'=>$societyID));
            }

            $this->isFav = $isFav;
            $this->societyInfo = $societyInfo;
            $this->display('main/s.html');
        } else {
            $this->jump(spUrl('main','index'));
        }
    }

    //添加关注
    function addFav(){
        $societyID = (int)$this->spArgs('sid');
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        if($uid && $societyID){
            $info = array('uid'=>$uid,'sa_id'=>$societyID);
            $followSocietyObj = spClass('libFollowSociety');
            if($followSocietyObj->create($info)){
                $this->success('关注成功');
            } else {
                $this->error('关注失败');
            }
        } else {
            $this->error('请先登录',spUrl('login','memberLogin'));
        }
    }

    //列出当前用户的已关注列表
    function listFav(){
        $this->isLogin = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        $uid = $_SESSION['userInfo']['id'];
        if(!$uid)$this->error('请先登录',spUrl('login','memberLogin'));
        $followSocietyObj = spClass('libFollowSociety');
        $favList = $followSocietyObj->spLinker()->findAll(array('uid'=>$uid));
        $this->favList = $favList;
        $this->display('main/listFav.html');
    }

    //报名表列表
    function listMyResumes(){
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        $sid = (int)$this->spArgs('sid',0);
        $tid = (int)$this->spArgs('tid',0);
        $this->sid = $sid;
        $this->tid = $tid;
        if($uid){
            $this->isLogin = $uid;
            $conditions['uid'] = $uid;
            $resumesObj = spClass('libAppRecruitUserResume');
            if($resumes = $resumesObj->findAll($conditions)){
                $this->allResumes = $resumes;
            }
        }
        $this->display('main/listMyResumes.html');
    }

    //添加报名表--用户版
    function __myResumes(){
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        if(!$uid)$this->error('请先登录',spUrl('login','memberLogin'));
        $sid = (int)$this->spArgs('sid');
        $tid = (int)$this->spArgs('tid');
        if(!$sid || !$tid){
            $this->isNew = 0;
        } else {
            $this->isNew = 1;
        }
        $id = (int)$this->spArgs('id',0);
        if($id){
            $resumesObj = spClass('libAppRecruitUserResume');
            $conditions['id'] = $id;
            if($resume = $resumesObj->findResume($conditions)){
                $this->resume = $resume;
            }
        }
        $this->sid = $sid;
        $this->tid = $tid;
        $this->isLogin = $uid;
        $this->display('main/myResumes.html');
    }

    //添加报名表--不需注册版
    function myResumes(){
        $sid = (int)$this->spArgs('sid');
        $tid = (int)$this->spArgs('tid');
        $this->sid = $sid;
        $this->tid = $tid;
        $this->display('main/myResumes.html');
    }

    //保存报名表，如果条件满足则报名--注册用户
    function __saveMyResumes(){
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        if(!$uid)$this->error('请先登录',spUrl('login','memberLogin'));
        $info = $this->spArgs();
        $info['uid']=$uid;
        $sid = (int)$info['sid'];
        $tid = (int)$info['tid'];
        unset($info['sid']);
        unset($info['tid']);
        unset($info['c']);
        unset($info['a']);

        if(!$uid && (!$sid||!$tid) )$this->error('错误的提交信息',spUrl('main','index'));

        $resumesObj = spClass('libAppRecruitUserResume');
        $resumeToSocietyObj = spClass('libAppRecruitResumeToSociety');

        $verifier = $resumesObj->spVerifier($info);
        if( false == $verifier){
            if($sid && $tid){
                //把报名投递给社团
                $map['uid'] = $uid;
                $map['sa_id'] = $sid;
                $map['team_id'] = $tid;
                $map['resume_content'] = serialize($info);
                $r1 = $resumeToSocietyObj->create($map);
            }

            if($uid){
                //把报名表存入
                $info['isNew'] = 0;
                $r2 = $resumesObj->changeResume($info);
            }

            if($r1 && $r2){
                $this->success('保存并成功发送报名表',spUrl('main','s',array('id'=>$sid)));
                return;
            }

            if($r2){
                $this->success('成功保存报名表',spUrl('main','listMyResumes'));
                return;
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
    }

    //保存报名表，如果条件满足则报名--无注册
    function saveMyResumes(){
        $info = $this->spArgs();
        $info['uid']=0;
        $sid = (int)$info['sid'];
        $tid = (int)$info['tid'];
        unset($info['sid']);
        unset($info['tid']);
        unset($info['c']);
        unset($info['a']);

        if(!$sid && !$tid)$this->error('错误的提交信息',spUrl('main','index'));

        $resumesObj = spClass('libAppRecruitUserResume');
        $resumeToSocietyObj = spClass('libAppRecruitResumeToSociety');

        $verifier = $resumesObj->spVerifier($info);
        if( false == $verifier){
            if($sid && $tid){
                //把报名投递给社团
                $map['uid'] = 0;
                $map['sa_id'] = $sid;
                $map['team_id'] = $tid;
                $map['resume_content'] = serialize($info);
                $r1 = $resumeToSocietyObj->create($map);
            }

            if($r1){
                $this->success('报名成功',spUrl('main','s',array('id'=>$sid)));
                return;
            }
        } else {
            $msg = array_pop($verifier);
            $this->error(array_pop($msg));
        }
    }

    function rmMyResumes(){
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        if(!$uid)$this->error('请先登录',spUrl('login','memberLogin'));
        $id = (int)$this->spArgs('id');
        if( spClass('libAppRecruitUserResume')->delete(array('id'=>$id)) ){
            $this->success('删除成功',spUrl('main','listMyResumes'));
            return;
        } else {
            $this->error('删除失败',spUrl('main','listMyResumes'));
            return;
        }
    }

    //直接读取指定的报名表进行报名
    function sentResumes(){
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        if(!$uid)$this->error('请先登录',spUrl('login','memberLogin'));
        $id = (int)$this->spArgs('id');//报名表id
        $sid = (int)$this->spArgs('sid');
        $tid = (int)$this->spArgs('tid');

        if(!$id || !$sid || !$tid ) $this->error('错误的参数',spUrl('main','index'));

        $conditions['id'] = $id;
        $resumesObj = spClass('libAppRecruitUserResume');
        if($resume = $resumesObj->findResume($conditions)){
            $info = array(
                'uid'=>$uid,
                'resume_content'=>serialize($resume),
                'sa_id'=>$sid,
                'team_id'=>$tid
            );
            $resumeToSocietyObj = spClass('libAppRecruitResumeToSociety');
            unset($conditions);
            $conditions['sa_id'] = $sid;
            $conditions['uid'] = $uid;
            if($resumeToSocietyObj->find($conditions)){
                $this->error('该社团你已经报过名啦，请看看别的社团吧~',spUrl('main','index'));
                return;
            } else {
                if($resumeToSocietyObj->create($info)){
                    $this->success('报名成功',spUrl('main','s',array('id'=>$sid)));
                    return;
                } else {
                    $this->error('报名失败',spUrl('main','listMyResumes',array('sid'=>$sid,'tid'=>$tid)));
                    return;
                }
            }
        } else {
            $this->error('未找到指定的报名表',spUrl('main','listMyResumes',array('sid'=>$sid,'tid'=>$tid)));
            return;
        }
    }

    //已报名信息
    function myResumedSocieties(){
        $uid = $_SESSION['userInfo']['id']?$_SESSION['userInfo']['id']:'';
        if(!$uid)$this->error('请先登录',spUrl('login','memberLogin'));
        $conditions['uid'] = $uid;
        $resumeToSocietyObj = spClass('libAppRecruitResumeToSociety');
        $this->allInfo = $resumeToSocietyObj->spLinker()->findAll($conditions);
        $this->isLogin = $uid;
        $this->display('main/myResumedSocieties.html');
    }
}