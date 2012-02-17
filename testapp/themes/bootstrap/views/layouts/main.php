<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl ?>/css/main.css">

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl.'/js/bootstrap/bootstrap-dropdown.js'); ?>
</head>

<body>

	<header>
		<?php $this->widget('EBootstrapNavigation',array(
			'items'=>array(
				array('label'=>CHtml::encode(Yii::app()->name), 'url'=>array('/'), 'template' => '{brand}'),
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'Sidebar', 'url'=>array('/site/page', 'view'=>'sidebar')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('template' => '{divider}'),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Base CSS', 'url'=>'#', 'items' => array(
					array('label'=>'Typography', 'url'=>array('/site/page', 'view'=>'typography')),
					array('label'=>'Buttons', 'url'=>array('/site/page', 'view'=>'buttons')),
					array('label'=>'Labels', 'url'=>array('/site/page', 'view'=>'labels')),
				)),
				array('label'=>'Components', 'url'=>'#', 'items' => array(
					array('label'=>'Navigation', 'url'=>array('/site/page', 'view'=>'navigation')),
				)),
			),
			'fixed' => true,
		)); ?>
	</header>

	<div class="container" id="content">
	
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('EBootstrapBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?>
		<?php endif?>
	
		<?php echo $content; ?>
	
	</div>
	
	<footer class="container">
		<?php echo Yii::powered(); ?> Visit us on <a href="https://github.com/VisualAppeal/YiiBootstrap">GitHub</a>.
	</footer>

</body>
</html>
