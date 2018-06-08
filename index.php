<?php
$INDEX = require_once __DIR__.'/config.php';
$INDEX = require_once __DIR__.'/templates/index.php';
$ICON = require_once __DIR__.'/icon/index.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,safari=1" />
		<meta name="renderer" content="webkit">
		<meta name="theme-color" content="#607d8b" />
		<title>「为所欲为」表情包在线生成</title>
		<link href="mdui.min.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/x-icon" href="https://loganlin.top/sorry/icon/icon.png" media="screen" />
		<script src="mdui.min.js"></script>
 		<script src="./script.js?version=10050"></script>
 		<style>
 			.selection {
 				padding-left: 10px;
 			}
 		</style>
	</head>

	<body class="mdui-drawer-body-left mdui-appbar-with-toolbar mdui-theme-primary-blue-grey">
		<header class="mdui-appbar mdui-appbar-fixed">
			<div class="mdui-toolbar mdui-color-grey-800">
				<span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer', swipe: true}">
					<img class="mdui-icon" src="https://loganlin.top/sorry/icon/drawer.png">
				</span>
				<a href="./" class="mdui-typo-headline mdui-hidden-xs">Sorry，PHP是真的能为所欲为的</a>
			</div>
		</header>

		<div class="mdui-drawer" id="main-drawer">
			<div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
				<?php foreach ($ICON as $icon) : ?>
					<li class="mdui-list-item mdui-ripple">
						<img class="mdui-list-item-icon mdui-icon" src="<?php echo $icon['icon']; ?>">
						<div class="selection">
							<a href="<?php echo $icon['href'];?>" target='_blank' class="mdui-ripple"><?php echo $icon['name'];?></a>
						</div>
					</li>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="mdui-tab mdui-color-brown" mdui-tab>
			<a href="#home" class="mdui-ripple get_value_class" onclick="window.location.hash='home'">
				<label>首页</label>
			</a>
			<?php foreach ($INDEX as $value) : ?>
				<a href="#<?php echo $value['template_name']; ?>" class="mdui-ripple get_value_class" onclick="window.location.hash='<?php echo $value['template_name']; ?>'">
					<label><?php echo $value['name']; ?></label>
				</a>
			<?php endforeach; ?>
		</div>

		<div id="home" class="mdui-p-a-2">
			<div class="mdui-panel" mdui-panel>
				<div class="mdui-panel-item mdui-panel-item-open">
					<div class="mdui-panel-item-body">
						<p></p>
						<div class="mdui-typo">
							<h3>为所欲为 表情包在线生成器<small></h3>
							<h4>虚拟化与云计算 第10小组实践作业</h4>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php foreach ($INDEX as $value) : ?>
			<div id="<?php echo $value['template_name']; ?>" class="mdui-p-a-2">
				<div class="mdui-panel" mdui-panel>
					<div class="mdui-row">
						<div class="mdui-col-md-8">
							<?php for($i=0; $i<$value['input_num']; $i++) : ?>
								<div class="mdui-textfield">
									<label class="mdui-textfield-label">第 <?php echo $i+1; ?> 句</label>
									<input class="mdui-textfield-input" type="text" name="<?php echo $value['template_name']; ?>_value" placeholder="<?php echo $value['input_placeholder'][$i]; ?>"/>
								</div>
							<?php endfor; ?>

							<?php if(DEFAULT_CREATE_SMALL_GIF === false) : ?>
								<?php if($value['small']  == true): ?>
									<label class="mdui-checkbox">
										<input id="<?php echo $value['template_name']; ?>-small-size" type="checkbox" value="true" checked/>
										<i class="mdui-checkbox-icon"></i>
										是否生成 [微信兼容小尺寸] GIF 图片
									</label>
								<?php else : ?>
									<label class="mdui-checkbox mdui-hidden">
										<input id="<?php echo $value['template_name']; ?>-small-size" type="checkbox" value="false"/>
										<i class="mdui-checkbox-icon"></i>
										是否生成 [微信兼容小尺寸] GIF 图片
									</label>
								<?php endif; ?>
							<?php endif; ?>
							<hr class="mdui-invisible"/>
							<button class="mdui-btn mdui-btn-block mdui-color-cyan mdui-ripple" onclick="creat_gif()">
							生成</button>
							<hr class="mdui-invisible"/>
						</div>

						<div class="mdui-col-md-4">
							<?php if ($value['preview_image'] == 'false') : ?>
								<div class="mdui-card">
								  <div class="mdui-card-content"><h3>没有预览图哦</h3></div>
								</div>
							<?php else : ?>
								<div class="mdui-card">
									<div class="mdui-card-media">
										<img src="templates/<?php echo $value['template_name']; ?>/<?php echo $value['preview_image'];?>"/>
									</div>
									<div class="mdui-card-actions">
										<a class="mdui-btn mdui-ripple" href="./templates/<?php echo $value['template_name']?>/template.mp4" target="_blank">查看模版视频</a>
										<a class="mdui-btn mdui-ripple" href="<?php echo $value['source']?>" target="_blank">查看素材来源</a>
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</body>
</html>
