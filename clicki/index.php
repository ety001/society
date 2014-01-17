<?php
$info = array(
	'pageviews' =>'浏览量(pv)' ,
	'new_pageviews' => 'new浏览量(pv)',
	'sessions' => '访问次数',
	'ips' => 'IP数量(ip)',
	'visitors' => '访客数(uv)',
	'active_visitors' => 'active_visitors',
	'new_visitors' => '新访客数量',
	'old_visitors' => '旧访客数量',
	'new_visitor_rate' => '新访客比例',
	'old_visitor_rate' => '旧访客比例',
	'entrances' => '入口次数',
	'exits' => '出口次数',
	'avg_loadtime' => '平均访问速度',
	'avg_staytime' => '平均停留时间',
	'avg_pageviews' => '平均访问深度',
	'bounces' => '跳出次数uv',
	'bounce_rate' => 'bounce_rate',
	'click' => '点击次数',
	'input' => '输入次数',
	'inclick' => '站内链接点击次数',
	'outclick' => '站内链接点击次数',
	'stop' => '静止时间'
	);

	$c = '';
	$t = fopen('http://www.clicki.cn/api/summary?token=94d2199c0fc5a66ab9a72c158a40c0cc','r');
	while (!feof($t)) {
		$c.=fgets($t,8000);
	}
	$r = json_decode($c,true);
	//var_dump($r);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clicki统计系统</title>
<script src="./jquery.min.js"></script>
</head>
<body>
	<div id="r">
		<h3>Today</h3>
		<?php foreach ($r['today'] as $k => $v) {
			if(array_key_exists($k, $info)){
				echo '<div>'.$info[$k].':'.$v.'</div>';
			}
		}
		?>
		<h3>Yesterday</h3>
		<?php foreach ($r['yesterday'] as $k => $v) {
			if(array_key_exists($k, $info)){
				echo '<div>'.$info[$k].':'.$v.'</div>';
			}
		}
		?>
	</div>
	<script type="text/javascript">
		$(function(){});
	</script>
</body>
</html>