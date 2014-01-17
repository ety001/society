-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 09 月 09 日 15:07
-- 服务器版本: 5.6.10
-- PHP 版本: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `society`
--

-- --------------------------------------------------------

--
-- 表的结构 `society_acl`
--

CREATE TABLE IF NOT EXISTS `society_acl` (
  `aclid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `acl_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`aclid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='权限表' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `society_acl`
--

INSERT INTO `society_acl` (`aclid`, `name`, `controller`, `action`, `acl_name`) VALUES
(1, '社团后台信息管理', 'admin', 'societyInfo', 'GBADMIN'),
(2, '社团后台信息管理Logo上传', 'admin', 'societyInfoUploadify', 'GBADMIN'),
(3, '社团信息保存', 'admin', 'societyInfoSave', 'GBADMIN'),
(4, '社团信息Logo上传', 'admin', 'societyInfoUploadify', 'GBADMIN'),
(5, '社团信息简介中的图片上传', 'admin', 'societyInfoKindEditor', 'GBADMIN'),
(6, '添加到社团收藏页面', 'main', 'addFav', 'GBUSER'),
(7, '列表社团收藏的操作', 'main', 'listFav', 'GBUSER'),
(8, '我的报名表页面', 'main', 'myResumes', 'GBUSER'),
(9, '我的报名表保存操作', 'main', 'saveMyResumes', 'GBUSER');

-- --------------------------------------------------------

--
-- 表的结构 `society_admin`
--

CREATE TABLE IF NOT EXISTS `society_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '登录名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `level` int(11) NOT NULL DEFAULT '0' COMMENT '管理等级',
  `email` varchar(80) NOT NULL COMMENT '邮箱',
  `enable` int(11) NOT NULL DEFAULT '0' COMMENT '是否可用(1可用 0不可用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_app_recruit_resume_to_society`
--

CREATE TABLE IF NOT EXISTS `society_app_recruit_resume_to_society` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '投递关系id',
  `resume_id` int(11) NOT NULL COMMENT '用户简历id',
  `sa_id` int(11) NOT NULL COMMENT '社团id',
  `team_id` int(11) NOT NULL COMMENT '社团内部部门或小组id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='纳新应用-简历投递关系表' AUTO_INCREMENT=1 ;
ALTER TABLE  `society_app_recruit_resume_to_society` ADD  `uid` INT NOT NULL AFTER  `id`;
ALTER TABLE  `society_app_recruit_resume_to_society` ADD  `status` INT( 1 ) NOT NULL DEFAULT  '0' COMMENT  '0未处理;1录用;2未录用' AFTER  `id`;
ALTER TABLE  `society_app_recruit_resume_to_society` CHANGE  `resume_id`  `resume_content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT  '用户简历内容';

-- --------------------------------------------------------

--
-- 表的结构 `society_app_recruit_user_resume`
--

CREATE TABLE IF NOT EXISTS `society_app_recruit_user_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '个人简历id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `realname` varchar(10) NOT NULL COMMENT '姓名',
  `sex` varchar(2) NOT NULL COMMENT '性别',
  `age` varchar(8) NOT NULL COMMENT '出生年月',
  `outlook` varchar(4) NOT NULL COMMENT '精神面貌',
  `mobile_num` int(11) NOT NULL COMMENT '手机号',
  `college_id` int(11) NOT NULL COMMENT '学院id',
  `college` varchar(50) NOT NULL COMMENT '学院名',
  `major_id` int(11) NOT NULL COMMENT '专业id',
  `major` varchar(50) NOT NULL COMMENT '专业名',
  `other_info` text NOT NULL COMMENT '其他信息的序列化结果(个人简介，特长爱好，个人获奖情况等)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='纳新应用-用户简历' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `society_app_recruit_user_resume`
--

INSERT INTO `society_app_recruit_user_resume` (`id`, `uid`, `realname`, `sex`, `age`, `outlook`, `mobile_num`, `college_id`, `college`, `major_id`, `major`, `other_info`) VALUES
(1, 3, '于业超', '1', '1989.6', '', 186000000, 0, '数学', 0, '信计', 'a:2:{s:5:"hobby";s:9:"计算机";s:4:"desp";s:841:"<h1 style="text-align:center;font-weight:normal;font-size:22px;font-family:微软雅黑;color:#333333;background-color:#FFFFFF;">\r\n	英语翻译系毕业生求职信\r\n</h1>\r\n<div class="sm" style="color:#999999;text-align:center;font-family:Tahoma;background-color:#FFFFFF;">\r\n	来源：58.com 2013-08-30 14:12\r\n</div>\r\n<table cellpadding="0" cellspacing="0" width="100%" id="content" style="color:#333333;font-family:Tahoma;font-size:14px;background-color:#FFFFFF;">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<p style="text-indent:28px;">\r\n					英语翻译系毕业生<a href="http://www.58.com/qiuzhixin/">求职信</a>\r\n				</p>\r\n				<p style="text-indent:28px;">\r\n					致公司各位领导：\r\n				</p>\r\n				<p style="text-indent:28px;">\r\n					我即将毕业于四川外语学院英语翻译系\r\n				</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>";}');

-- --------------------------------------------------------

--
-- 表的结构 `society_college`
--

CREATE TABLE IF NOT EXISTS `society_college` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '学院id',
  `school_id` int(11) NOT NULL COMMENT '学校id',
  `name` varchar(50) NOT NULL COMMENT '学院名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学院表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_district`
--

CREATE TABLE IF NOT EXISTS `society_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '地区id',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '地区父id',
  `name` varchar(20) NOT NULL COMMENT '地区名字',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='地区表(省市)' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_follow_society`
--

CREATE TABLE IF NOT EXISTS `society_follow_society` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '关系id',
  `uid` int(11) NOT NULL COMMENT '用户id',
  `sa_id` int(11) NOT NULL COMMENT '社团id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户关注社团的关系表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `society_follow_society`
--

INSERT INTO `society_follow_society` (`id`, `uid`, `sa_id`) VALUES
(1, 3, 4),
(2, 3, 6);

-- --------------------------------------------------------

--
-- 表的结构 `society_follow_users`
--

CREATE TABLE IF NOT EXISTS `society_follow_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '关注用户id',
  `followed_uid` int(11) NOT NULL COMMENT '被关注的用户id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户之间的关注关系表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_major`
--

CREATE TABLE IF NOT EXISTS `society_major` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '专业id',
  `college_id` int(11) NOT NULL COMMENT '学院id',
  `name` varchar(50) NOT NULL COMMENT '专业名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='专业表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_school`
--

CREATE TABLE IF NOT EXISTS `society_school` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '学校id',
  `school` varchar(50) NOT NULL COMMENT '学校名',
  `provice_id` int(11) NOT NULL COMMENT '省id',
  `city_id` int(11) NOT NULL COMMENT '市id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='学校名' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_society_account`
--

CREATE TABLE IF NOT EXISTS `society_society_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '社团id',
  `society_name` varchar(30) NOT NULL COMMENT '社团名字',
  `society_login_name` varchar(40) NOT NULL COMMENT '社团登录名，用作登录和域名伪静态',
  `password` varchar(32) NOT NULL COMMENT '社团帐号登录密码',
  `email` varchar(80) NOT NULL COMMENT '社团邮箱',
  `school_id` int(11) NOT NULL DEFAULT '0' COMMENT '学校id',
  `school` varchar(50) NOT NULL COMMENT '学校名',
  `college_id` int(11) NOT NULL DEFAULT '0' COMMENT '学院id',
  `college` varchar(50) NOT NULL COMMENT '学院名',
  `logo` varchar(100) NOT NULL COMMENT '社团logo',
  `desp` mediumtext NOT NULL COMMENT '社团简介',
  `enable` int(11) NOT NULL DEFAULT '0' COMMENT '是否可用(1可用 0不可用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='社团账户表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `society_society_account`
--

INSERT INTO `society_society_account` (`id`, `society_name`, `society_login_name`, `password`, `email`, `school_id`, `school`, `college_id`, `college`, `logo`, `desp`, `enable`) VALUES
(4, '鲁大学生网', 'ldsn', '25d55ad283aa400af464c76d713c07ad', 'ety@dom.c', 0, '', 0, '', '/uploads/logo/240d255b2c5ab769d2b62a1aa53b6f7f.jpg', '<!--?php echo ''123'';?-->\r\n<div style="margin:0px;padding:0px;font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	<h2 style="font-size:18px;">\r\n		鲁大学生网 - 简介\r\n	</h2>\r\n</div>\r\n<p style="font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	　　鲁大学生网原名<a target="href=javascript:linkredwin(''鲁东大学网络信息部'');">鲁东大学网络信息部</a>，成立于2000年，是在校团委指导帮助下成立的学生组织，隶属于校宣传中心。主要通过运用电脑网络资源来完成各项任务和开展各种活动，为广大师生搭建网络互动平台，是联系团组织和广大同学的桥梁、纽带。历经10年的发展，现主要运营“鲁大学生网”，在鲁大学生中已经有了很大的影响力。\r\n</p>\r\n<div style="margin:0px;padding:0px;font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	<h2 style="font-size:18px;">\r\n		<a href="http://www.baike.com/wiki/%E9%B2%81%E5%A4%A7%E5%AD%A6%E7%94%9F%E7%BD%91#" target="_self"></a><a name="3"></a>鲁大学生网 - 部门设置\r\n	</h2>\r\n</div>\r\n<p style="font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	　　秘书处：主要负责信息的上传下达，日常各部门工作的安排、协调，考核、档案管理以及会议，以及团队文 化建设。&nbsp;<br />\r\n　　美工部：网站、刊板、海报的美工设计。&nbsp;<br />\r\n　　摄影部：新闻图片、校园照片的采集。&nbsp;<br />\r\n　　网络技术部：主要负责网站制作与管理，网络应用开发。分设网站建设技术。&nbsp;<br />\r\n　　编辑部：由文编和记者组成。文编主要负责网站内容的策划、采选、编辑和审核工作，记者主要负责校内新闻的采写和人物专访。\r\n</p>\r\n<div style="margin:0px;padding:0px;font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	<h2 style="font-size:18px;">\r\n		<a href="http://www.baike.com/wiki/%E9%B2%81%E5%A4%A7%E5%AD%A6%E7%94%9F%E7%BD%91#" target="_self"></a><a name="5"></a>鲁大学生网 - 网站文化\r\n	</h2>\r\n</div>\r\n<p style="font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	　　以“家”文化为特色，以“自由”为旗帜，以“服务鲁大”为宗旨。\r\n</p>\r\n<div style="margin:0px;padding:0px;font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	<h2 style="font-size:18px;">\r\n		<a href="http://www.baike.com/wiki/%E9%B2%81%E5%A4%A7%E5%AD%A6%E7%94%9F%E7%BD%91#" target="_self"></a><a name="7"></a>鲁大学生网 - 网站介绍\r\n	</h2>\r\n</div>\r\n<p style="font-family:宋体;font-size:14px;background-color:#FFFFFF;">\r\n	　　鲁大学生网是一个提供校园资讯，展现<a name="ref_[1]_3460191"></a>校园生活的网络平台，发布与学生密切相关的新闻资讯、社团活动，注重师生交流、社团合作、信息综合，同时兼<a href="http://www.baike.com/wiki/%E9%A1%BE%E5%9B%BD%E9%99%85">顾国际</a>国内要闻，立足于校内，面向校外。以服务广大师生为目的，丰富同学们见识，开拓眼界，广泛分享全国高校的信息、经验，追求创新和发展。\r\n</p>', 1),
(5, '鲁大电视', 'ldudst', '25d55ad283aa400af464c76d713c07ad', 'ldudst@society.im', 0, '', 0, '', '/uploads/logo/54db9bcccc9960f61e6e79a3b0caa8bd.png', '<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">鲁东年夜学年夜学生电视台成立于2005年10月，从属于鲁东年夜学团委，是鲁东年夜学第一校园媒体。电视台创立至今已经过多个音、视频及平面节目与不雅众碰头，并于新浪、优酷等多家国内知名网站获得了普遍协作，校园情形剧《某某摄制组的故事》一经推出，得到了《烟台日报》《齐鲁晚报》 、烟台电视台、山东卫视等多家媒体报道。人物纪录片《宋萧平》在中央收集电视台展播，得到专业人士的认可。曩昔的一年鲁年夜电视一无所获，新的学期，为知足电视台的开展，现向全校11级同窗纳新，部门简介如下：</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">宣传筹划部：担任电视台的校表里宣传，节目、勾当筹划及dv的编剧工作。曾推出《爱上恋爱》&nbsp;&nbsp;《那年的情书》 《迷障》 《五维游戏》在内的多部dv剧。同时还为本台多档校园节目提供筹划。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">咨询德律风：舒胜华：18766520572 赵心雯：18766528992</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">记者团：担任校园新闻采写播报。记者团成员现与校报记者团结合，并有校报编纂，原吉林电视台资深记者、国度新闻奖取得者张成良教师指导。电视台优异新闻作品得到了烟台电视台、《烟台日报》等多家媒体的采用。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">咨询德律风：侯若飞：18766520612&nbsp;&nbsp;朱程：18766515913</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">掌管部：担任综艺视频掌管、影片配音、新闻掌管、新闻播音，并为校园社团勾当保送优异掌管人。各类学院晚会、校庆80周年宣传片《远航》拍摄在内的多项年夜型勾当都曾约请电视台节目掌管人参与。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">咨询德律风：张艺艺：18766513461 腾佩利：13953541617&nbsp;</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">摄像部、制造部：担任电视台综艺、影视、新闻节目以及DV、校园晚会勾当的拍摄、制造。鲁年夜电视的摄像部、制造部是黉舍范围最年夜，手艺程度最高的影视制造团队。曾参与校庆80周年宣传片《远航》的摄制。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">咨询德律风：（摄像）胡春晖：15668013329 王卫：18766523384</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; （制造）孟&nbsp;&nbsp;斐：18766523213&nbsp; &nbsp;初岷：18766522723</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">收集部：首要担任鲁年夜电视网站论坛的┞符体运营和维护工作。以鲁年夜电视节目为根底，以收集论坛为宣传平台，传布鲁年夜校园文化，打造强势高校媒体。推出台刊、《我与电视台的故事》等多项校园媒体品牌。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">咨询德律风：张海航：18766524830&nbsp; &nbsp;丛磊：15668013912</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">鲁东年夜学年夜学生电视台纳新报名报名处、总咨询处：</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">鲁东年夜学年夜学糊口动中间（北区5餐四楼）413室——年夜学生电视台办公室。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">报名时候：本日起至本月26日晚9点截止。周一至周五午时12点半至晚9点，周六周日早9点至晚9点。</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">初试时候：9月25日——9月28日</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">注：不承受德律风、短信报名，请把填写好的报名表在规则刻日内交到电视台办公室，报名表由工作人员发放或到电视台领取（报名表可复印），各部门初复试时候另行通知。</span><br />\r\n<br />\r\n<br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">鲁年夜电视11级重生群：18856036&nbsp; &nbsp;&nbsp; &nbsp;163484686</span><br />\r\n<br />\r\n<br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">鲁年夜电视新浪官方微博：</span><a href="http://weibo.com/ludadianshi" target="_blank">http://weibo.com/ludadianshi</a><br />\r\n<br />\r\n<br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">年夜学生电视台诚邀您的参加，但愿您能脱颖而出！</span><br />\r\n<br />\r\n<br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">爱我所爱，鲁年夜电视！</span><br />\r\n<br />\r\n<span style="color:#444444;font-family:微软雅黑, Tahoma, Helvetica, SimSun, sans-serif;font-size:14px;line-height:21px;background-color:#FFFFFF;">敢作敢为，幻想起航！</span>', 1),
(6, '鲁大电台', 'ldudt', '25d55ad283aa400af464c76d713c07ad', 'ldudt@society.im', 0, '', 0, '', '/uploads/logo/5252d7c3ce66d60fece96c1f9e598edc.png', '<span style="font-family:宋体;font-size:14px;line-height:24px;">为了不断壮大广播电台的综合实力，能更好的为我校师生服务，同时也为热爱广播、关心时事的同学提供一个展现自我的舞台及梦想腾飞的跳板，经校团委同意，新一轮的纳新活动即将拉开帷幕！</span><br />\r\n<strong>一、电台简介</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">鲁东大学校园广播电台是校团委领导下的一个设施完善、组织机构合理的校园媒体。作为全校最大的宣传媒体，校园广播电台本着“用心传递好声音”的宗旨，以“关注生活、服务听众”为己任，坚持新闻立台，将讯息和关怀的声音通过有线广播传进每一个同学的耳朵，传遍校园的每一个角落。</span><br />\r\n<strong>二、部门简介</strong><br />\r\n<strong>1</strong><strong>、秘书处</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">辅佐台委会工作，统筹各部门人事安排，负责台内各种活动的统筹与策划，同时肩负同学校、校学生会及各学院的联络工作,保证电台工作的正常运行。</span><br />\r\n<strong>2</strong><strong>、网络技术部</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">网络技术部作为维护广播电台软硬件设施的团队，是鲁大电台的重要部门。负责电台日常工作中调音台和计算机的调试与故障排除，定期的线路检测及音响试音等工作。作为校园广播电台的技术人员，要秉承着对工作高度认真负责的态度，用最专业的技术保证电台节目录制及播出环节的顺利。</span><br />\r\n<strong>3</strong><strong>、网络宣传部</strong><br />\r\n<strong></strong><span style="font-family:宋体;font-size:14px;line-height:24px;">负责电台各个网络平台的信息更新和日常维护。为各种活动做必要的宣传，以及负责电台工作证设计与制作、喷绘。</span><br />\r\n<strong>4</strong><strong>、记者部</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">记者部作为鲁大电台首批打造的精英团队，奔走于校园内外，聚焦热点话题，关注生活点点滴滴。独特的视角，别样的思维，一支录音笔传递着我们思考的声音。记者部的每个人都在用全部的心血和热情打造着我们的品牌节目——《校园之声》。</span><br />\r\n<p>\r\n	<strong>5</strong><strong>、节目制作部</strong>\r\n</p>\r\n<p>\r\n	<strong>节目一部：（直播类）</strong><br />\r\n<strong>《晚新闻》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">聚焦国内外新闻资讯，博览全球时事动态，网罗最新最快文体资讯，聆听你我身边最新校园动态。给我半小时，收听全世界，同在鲁大，共观天下。鲁东大学校园广播晚新闻每晚与您不见不散！</span><br />\r\n<strong>《周末节目》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">无论你想要清新文艺还是劲爆，无论你想听电影，娱乐，音乐，心情，还是旅程。无论什么《周末节目》与您一网打尽。《周末驿站》与您相约在每周六中午。日落倾城，我们与您一起享受音乐盛典，回首彼年，拉近你我心的距离。《日落大道》在每周天傍晚期待你的聆听！</span><br />\r\n<strong>《周六轻松点》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">周六轻松点是一档集休闲，娱乐，时尚为一体的综合类广播节目。包含冷笑话时间，音乐格子铺，music</span><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">top show，资讯抢先报，娱乐宝贝淘，轻松点吧，六个小板块。在每周六傍晚时分与您一同分享周末好时光。</span><br />\r\n<strong>《周末最音乐》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">享受美妙音乐，聆听纯粹生活~这里是每个周天中午带你起航音乐旅程的主题电台节目，为你呈现当代乐坛的流行方向，更有DJ带你畅聊娱乐新鲜事。我们将站在音乐无国界的视角，用流畅动听的旋律，加入独特的音乐品味，好似一段美好的梦境，为你彩绘音乐世界的黎明和夜晚的星空，一寸寸嵌进喧哗的日光里。唯有你才是此刻的知己，和我们一起在音乐中律动，唤起彼此沉睡的耳朵，享受心头的空荡和放松。一种纯的音乐，一种享受的感觉~这里是，周末最音乐。</span>\r\n</p>\r\n<p>\r\n	<span style="font-family:宋体;font-size:14px;line-height:24px;"><strong>节目二部：（录播类）</strong><br />\r\n<strong>《体坛冲浪》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">掌握体坛动向，品味运动生活，追踪体能极限，把脉运动时尚，呼吸自由新鲜的体坛资讯，尽情享受缤纷的体坛趣闻，让我们一起去感受体育无处不在的魅力，一起去了解来自运动的精彩，更多精彩尽在体坛冲浪。</span><br />\r\n<strong>《</strong><strong>A Taste of English</strong><strong>》、</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">A Taste of&nbsp;</span><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">English----Give us 20 minutes and We will give you the whole world..Learning</span><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">on the Air、Culture</span><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">Spotlight、DVD’S and MP3’S、Happenings四个板块给所有风格的播音员提供了平台。无论你是不是学术大咖，无论你是英伦播报风还是娱乐主持范儿，我们都欢迎你的加入！We want you!</span><br />\r\n<strong>《</strong><strong>POP</strong><strong>·FM</strong><strong>》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">流行主宰世界，时尚无处不在。POP.FM，带您体验时尚的饕餮盛宴！想变身流行达人吗？想捕捉最新的娱乐资讯吗？想聆听最潮的 音乐吗？那就锁定我们吧！POP.FM,让你一秒变身潮装，美妆，数码，流行各种达人；POP.FM,让你瞬间了解娱乐动态，为您带来最权威、搞笑、正点的娱乐新闻；POP.FM，让你收听最美妙的音乐，为您准备最新鲜的音乐排行！POP.FM,让你玩转，让你好看！</span><br />\r\n<strong>《步履琼音》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">翻一页书，精心细读，可体味文字中的惊涛骇浪；留一种心情，埋一枚故事，可将回忆贮立于时光之上。品味文字醇美，感受故事时光。来，把我们的感悟讲给你听，把你们的故事留于电波里。这里是文学之声，步履琼音。</span><br />\r\n<strong>《本周》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">关注社会风云变幻，引领校园舆论先锋。以大学生的独特视角洞察时事变化，个性思维品评社会百态，尖锐，前沿，打造自己的新闻评论。如果你也拥有梦想，如果你也热爱播音主持，鲁东大学校园广播本周节目期待你的加入，快为你的声音寻找一个最准确的定位吧。</span><br />\r\n<strong>《晚安鲁大》</strong><br />\r\n<span style="font-family:宋体;font-size:14px;line-height:24px;">晚安鲁大是一档交流情感、启迪心灵的节目。【心随音跃】随着音乐述说背后的故事；【文香诗意】伴着文字感悟自己的心灵；【心情语吧】述说听众酸甜苦辣的心情；【耳朵想旅行】让耳朵去到世界各地畅游；【人物三两事】讲述或伟大或平凡的人物；周六周日两天主题节目，满足你挑剔的耳朵，给你最温馨的触动。在宁静的夜晚，总有我们最温暖的陪伴。</span><br />\r\n<strong>三、纳新介绍</strong><br />\r\n<strong>纳新部门：</strong><span style="font-family:宋体;font-size:14px;line-height:24px;">节目制作部（Ⅰ部、Ⅱ部）,秘书处,网络技术部，网络宣传部，记者部</span><br />\r\n<strong>初试时间：</strong><span style="font-family:宋体;font-size:14px;line-height:24px;">10月15日—10月19日 每天中午12：20—13:40 晚上19：00—21：00&nbsp;</span><br />\r\n<strong>初试地点：</strong><span style="font-family:宋体;font-size:14px;line-height:24px;">五餐四楼407室 广播电台办公室</span><br />\r\n</span>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', 1);

-- --------------------------------------------------------

--
-- 表的结构 `society_society_admin`
--

CREATE TABLE IF NOT EXISTS `society_society_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '登录名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `email` varchar(80) NOT NULL COMMENT '邮箱',
  `school_id` int(11) NOT NULL COMMENT '可以管理学校的id',
  `college_id` int(11) NOT NULL COMMENT '学院id',
  `enable` int(11) NOT NULL DEFAULT '0' COMMENT '是否可用(1可用 0不可用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='社团管理表(学校帐号)' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_society_introduce`
--

CREATE TABLE IF NOT EXISTS `society_society_introduce` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '社团介绍id',
  `sa_id` int(11) NOT NULL COMMENT '社团id',
  `title` varchar(40) NOT NULL COMMENT '介绍标题',
  `content` text NOT NULL COMMENT '介绍内容',
  `switch` int(11) NOT NULL DEFAULT '0' COMMENT '介绍开关',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='社团介绍' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_society_members`
--

CREATE TABLE IF NOT EXISTS `society_society_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sa_id` int(11) NOT NULL COMMENT '社团id',
  `uid` int(11) NOT NULL COMMENT '成员id',
  `level` int(11) NOT NULL COMMENT '成员级别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='社团成员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `society_society_team`
--

CREATE TABLE IF NOT EXISTS `society_society_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'team_id',
  `society_id` int(11) NOT NULL,
  `team_name` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `society_society_team`
--

INSERT INTO `society_society_team` (`id`, `society_id`, `team_name`, `status`) VALUES
(1, 4, '编辑部', 1),
(2, 4, '网络技术部', 1),
(3, 4, '美工部', 1),
(4, 4, '摄影部', 1),
(5, 4, '秘书处', 1);

-- --------------------------------------------------------

--
-- 表的结构 `society_user`
--

CREATE TABLE IF NOT EXISTS `society_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `num` mediumint(9) NOT NULL COMMENT '学号',
  `username` varchar(30) NOT NULL COMMENT '用户登录名称',
  `password` varchar(32) NOT NULL COMMENT '用户密码',
  `nickname` varchar(30) NOT NULL COMMENT '用户昵称',
  `email` varchar(80) NOT NULL COMMENT '用户email',
  `school_id` int(11) NOT NULL COMMENT '学校id',
  `college_id` int(11) NOT NULL COMMENT '学院id',
  `major_id` int(11) NOT NULL COMMENT '专业id',
  `province_id` int(11) NOT NULL COMMENT '省id',
  `city_id` int(11) NOT NULL COMMENT '市id',
  `image_path` varchar(300) NOT NULL COMMENT '头像相对路径',
  `enable` int(11) NOT NULL DEFAULT '0' COMMENT '是否可用(1可用 0不可用)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `society_user`
--

INSERT INTO `society_user` (`id`, `num`, `username`, `password`, `nickname`, `email`, `school_id`, `college_id`, `major_id`, `province_id`, `city_id`, `image_path`, `enable`) VALUES
(3, 0, 'ety001', '79bda9299604fad6b0e1c2db7aee5da8', '', 'fsf@dfs.c', 0, 0, 0, 0, 0, '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
