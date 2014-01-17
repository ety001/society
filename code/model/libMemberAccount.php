<?php
class libMemberAccount extends spModel
{
    var $pk = "id"; // 数据表的主键
    var $table = "user"; // 数据表的名称
    // 我们定义自己的验证规则
    var $addrules = array(
                        'isUsernameExist' => array('libMemberAccount','checkUsernameExist'),
                        'isWordNum' => array('libMemberAccount','checkUsernameWordNum')
                    );
    // 定义验证规则
    var $verifierReg = array(
                        "rules" => array( // 规则
                            'username' => array(  // 这里是对username的验证规则
                                'notnull' => TRUE, // username不能为空
                                'isUsernameExist' => TRUE,
                                'isWordNum' => TRUE,
                                'minlength' => 2,  // username长度不能小于2
                                'maxlength' => 40, // username长度不能大于40
                            ),
                            'password' => array(   // 这里是对password的验证规则
                                'notnull' => TRUE, // password不能为空
                                'minlength' => 8,  // password长度不能小于8
                            ),
                            're_password' => array(  // 这里是对第二次输入的密码的验证规则
                                'equalto' => 'password', // 要等于'password'，也就是要与上面的密码相等
                            ),   
                            'email' => array(   // 这里是对email的验证规则
                                'notnull' => TRUE, // email不能为空
                                'email' => TRUE,   // 必须要是电子邮件格式
                            )
                        ),
                        "messages" => array( // 规则
                            'username' => array(
                                'notnull' => '登陆名不能为空',
                                'isUsernameExist' => '登陆名已经存在',
                                'isWordNum' => '登陆名只能包含字母或者数字',
                                'minlength' => '登陆名长度不能小于2',
                                'maxlength' => '登陆名长度不能大于40'
                            ),
                            'password' => array(
                                'notnull' => '密码不能为空',
                                'minlength' => '密码长度不能小于8'
                            ),
                            're_password' => array(
                                'equalto' => '两次密码不同'
                            ),   
                            'email' => array(
                                'notnull' => 'email不能为空',
                                'email' => '必须要是电子邮件格式'
                            )
                        )
                    );
    var $verifierLogin = array(
                        "rules" => array( // 规则
                            'username' => array(  // 这里是对username的验证规则
                                'notnull' => TRUE // username不能为空
                            ),
                            'password' => array(   // 这里是对password的验证规则
                                'notnull' => TRUE, // password不能为空
                            )
                        ),
                        "messages" => array( // 规则
                            'username' => array(
                                'notnull' => '登陆名不能为空'
                            ),
                            'password' => array(
                                'notnull' => '密码不能为空'
                            )
                        )
                    );
    public function checkUsernameExist($input, $right){
        $result = $this->findBy('username',$input);
        if($right == $result){
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function checkUsernameWordNum($input, $right){
        $regex = '/\A[\da-zA-Z]+\z/';
        if($right == preg_match($regex, $input)){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}