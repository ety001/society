<?php
class libAppRecruitUserResume extends spModel
{
    var $pk = "id"; // 数据表的主键
    var $table = "app_recruit_user_resume"; // 数据表的名称
    var $verifier = array(
                        "rules" => array( // 规则
                            'realname' => array(  // 这里是对realname的验证规则
                                'notnull' => TRUE // realname不能为空
                            ),
                            'mobile_num' => array(   // 这里是对mobile_num的验证规则
                                'notnull' => TRUE, // mobile_num不能为空
                            ),
                            'hobby' => array(
                                'notnull' => TRUE,
                            ),
                            'desp' => array(
                                'notnull' => TRUE,
                            ),
                            'college' => array(
                                'notnull' => TRUE,
                            ),
                            'major' => array(
                                'notnull' => TRUE,
                            )
                        ),
                        "messages" => array( // 规则
                            'realname' => array(
                                'notnull' => '姓名不能为空'
                            ),
                            'mobile_num' => array(
                                'notnull' => '密码不能为空'
                            ),
                            'hobby' => array(
                                'notnull' => '兴趣爱好不能为空',
                            ),
                            'desp' => array(
                                'notnull' => '简介不能为空',
                            ),
                            'college' => array(
                                'notnull' => '学院不能为空',
                            ),
                            'major' => array(
                                'notnull' => '专业不能为空',
                            )
                        )
                    );

    public function findResume($conditions=''){
        $result = $this->find($conditions);
        if($result){
            $otherInfo = unserialize($result['other_info']);
            $result['hobby'] = $otherInfo['hobby'];
            $result['desp'] = $otherInfo['desp'];
            $age = explode('.', $result['age']);
            $result['year'] = $age[0];
            $result['month'] = $age[1];
        }
        return $result;
    }

    public function findAllResumes($conditions=''){
        $result = $this->findAll($conditions);
        $sResult = array();
        if($result){
            foreach ($result as $k => $v) {
                $otherInfo = unserialize($v['other_info']);
                unset($v['other_info']);
                $v['hobby'] = $otherInfo['hobby'];
                $v['desp'] = $otherInfo['desp'];
                $age = explode('.', $v['age']);
                unset($v['age']);
                $v['year'] = $age[0];
                $v['month'] = $age[1];
                $sResult[$k] = $v;
            }
        }
        return $sResult;
    }

    public function changeResume($postInfo=''){
        $isNew = $postInfo['isNew'];
        $info['realname'] = $postInfo['realname'];
        $info['mobile_num'] = $postInfo['mobile_num'];
        $info['outlook'] = '';
        $info['college_id'] = 0;
        $info['major_id'] = 0;
        $info['sex'] = $postInfo['sex'];
        $info['age'] = $postInfo['year'].'.'.$postInfo['month'];
        $info['college'] = $postInfo['college'];
        $info['major'] = $postInfo['major'];
        $otherInfo['hobby'] = $postInfo['hobby'];
        $otherInfo['desp'] = $postInfo['desp'];
        $info['other_info'] = serialize($otherInfo);
        if($isNew == 0){
            $info['uid'] = $postInfo['uid'];
            if($this->create($info)){
                return TRUE;
            } else {
                return false;
            }
        } elseif($isNew == 1) {
            $conditions['uid'] = $postInfo['uid'];
            if($this->update($conditions,$postInfo)){
                return TRUE;
            } else {
                return false;
            }
        }
    }
}