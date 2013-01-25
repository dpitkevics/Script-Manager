<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<div>
    <?php foreach ($script_list as $script): ?>
    <p>
        <?php echo CHtml::link($script->title, array('/script/default/view', 'sid'=>$script->id)); ?>
    </p>
    <?php endforeach; ?>
</div>