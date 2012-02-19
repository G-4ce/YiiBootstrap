<?php $this->beginContent('//layouts/main'); ?>

<?php 
/*
 * Fill sidebar via controller, database or manually
 *
 * New option `access`. For details see http://www.yiiframework.com/doc/api/1.1/CAuthItem#checkAccess-detail
 *
 */
$this->menu = array(
	array(
		'label' => Yii::t('Admin', 'Administration'), 'url' => $this->createUrl('/admin/'), 'icon' => 'home',
	),
	array(
		'label' => 'User', 'items' => array(
			array('label' => 'Manage', 'url' => '#', 'icon' => 'user'),
			array('label' => 'Groups', 'url' => '#', 'icon' => 'th'),
		),
	),
	array(
		'label' => 'Top Secret', 'access' => 'admin', 'items' => array(
			array('label' => 'Can you see?', 'url' => '#', 'icon' => 'lock'),
		),
	),
	array(
		'label' => 'Finances', 'items' => array(
			array('label' => 'Statistic', 'url' => '#', 'icon' => 'signal'),
			array('label' => 'Billing', 'url' => '#', 'icon' => 'shopping-cart'),
			array('label' => 'Voucher', 'url' => '#', 'icon' => 'tag'),
		),
	),
);
?>

<div class="row">

	<div class="span3" id="sidebar">
		<?php
			$this->widget('EBootstrapSidebar', array(
				'items'=>$this->menu,
			));
		?>
	</div>
	
	<div class="span9" id="main">
		<?php echo $content; ?>
	</div>
		
</div>
<?php $this->endContent(); ?>