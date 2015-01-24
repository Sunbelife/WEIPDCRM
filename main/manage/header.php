<?php
if (!defined("DCRM")) {
	header('HTTP/1.1 403 Forbidden');
	exit();
}
header("Content-Type: text/html; charset=UTF-8");

$sidebars = array(
	array(
        'title' => 'PACKAGES',
        'type'  => 'title'
    ),
	array(
        'name'  => '上传软件包',
        'id'    => 'upload',
        'type'  => 'subtitle',
    ),
	array(
        'name'  => '导入软件包',
        'id'    => 'manage',
        'type'  => 'subtitle',
    ),
	array(
        'name'  => '管理软件包',
        'id'    => 'center',
        'type'  => 'subtitle',
    ),
	array(
        'title' => 'REPOSITORY',
        'type'  => 'title'
    ),
	array(
        'name'  => '分类管理',
        'id'    => 'sections',
        'type'  => 'subtitle',
    ),
	array(
        'name'  => '源信息设置',
        'id'    => 'release',
        'type'  => 'subtitle',
    ),
	array(
        'title' => 'SYSTEM',
        'type'  => 'title'
    ),
	array(
        'name'  => '运行状态',
        'id'    => 'stats',
        'type'  => 'subtitle',
    ),
	array(
        'name'  => '关于程序',
        'id'    => 'about',
        'type'  => 'subtitle',
    )
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>DCRM - 源管理系统</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<?php
if ( isset($activeid) && ( 'manage' == $activeid || 'sections' == $activeid || 'center' == $activeid) ) 
	echo '	<link rel="stylesheet" type="text/css" href="css/corepage.css">';
if ( isset($activeid) && ( 'view' == $activeid || 'edit' == $activeid || 'center' == $activeid) ) 
	echo '	<script src="js/mbar.js" type="text/javascript"></script>';
?>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span6" id="logo">
				<p class="title">DCRM</p>
				<h6 class="underline">Darwin Cydia Repository Manager</h6>
			</div>
			<div class="top-secondary">
				<div class="btn-group pull-right">
					<a href="build.php" class="btn btn-inverse">刷新列表</a>
					<a href="settings.php" class="btn btn-info<?php if ( isset($activeid) && 'settings' == $activeid ) echo ' disabled'; ?>">设置</a>
					<a href="login.php?action=logout" class="btn btn-info">注销</a>
				</div>
			</div>
		</div>
		<br />
		<div class="row">
			<div class="span2.5" style="margin-left:0!important;">
				<div class="well sidebar-nav">
					<ul class="nav nav-list">
<?php
foreach ($sidebars as $value) {
	switch ( $value['type'] ) {
		case 'title':
			echo '<li class="nav-header">' . $value['title'] . '</li>';
			break;
		case 'subtitle':
			if( ( isset($activeid) && $value['id'] == $activeid ) || ( isset($highactiveid) && $value['id'] == $highactiveid ) ){
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="' . $value['id'] . '.php">' . $value['name'] . '</a></li>';
	}
}
?>
					</ul>
				</div>
<?php
if ( isset($activeid) && ( 'view' == $activeid || 'edit' == $activeid || 'center' == $activeid) ){
?>
				<div class="well sidebar-nav" id="mbar" <?php if ( isset($activeid) && 'center' == $activeid ) echo 'style="display: none;"'; ?>>
					<ul class="nav nav-list">
						<li class="nav-header">OPERATIONS</li>
							<li<?php if ( isset($activeid) && 'view' == $activeid ) echo ' class="active"'; ?>><a href="javascript:opt(1)">查看详情</a></li>
							<li<?php if ( isset($activeid) && 'edit' == $activeid && !isset($_GET['action']) ) echo ' class="active"'?>><a href="javascript:opt(2)">常规编辑</a></li>
							<li<?php if ( isset($activeid) && 'edit' == $activeid && isset($_GET['action']) && ($_GET['action'] == 'advance' || $_GET['action'] == 'advance_set') ) echo ' class="active"'?>><a href="javascript:opt(3)">高级编辑</a></li>
							<?php if ( isset($activeid) && 'center' == $activeid ) echo '<li id="sli"></li>'; ?>
					</ul>
				</div>
<?php
}
?>
			</div>
			<div class="content">
			<div class="wrap">