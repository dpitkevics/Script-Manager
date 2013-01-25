<?php
/* @var $this ScriptController */ 
/* @var $model Script */ 
/* @var $form CActiveForm */ 
?> 

<div class="form"> 

<?php $form=$this->beginWidget('CActiveForm', array( 
    'id'=>'script-create-form', 
    'enableAjaxValidation'=>true, 
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p> 

    <?php echo $form->errorSummary($model); ?>

    <div class="row"> 
        <?php echo $form->labelEx($model,'title'); ?>
        <?php echo $form->textField($model,'title'); ?>
        <?php echo $form->error($model,'title'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'description'); ?>
        <?php echo $form->textArea($model,'description'); ?>
        <?php echo $form->error($model,'description'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'tags'); ?>
        <?php echo $form->textField($model,'tags'); ?>
        <?php echo $form->error($model,'tags'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'path'); ?>
        <?php echo $form->textField($model,'path'); ?>
        <?php echo $form->error($model,'path'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'usage'); ?>
        <?php echo $form->textField($model,'usage'); ?>
        <?php echo $form->error($model,'usage'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'accuirance'); ?>
        <?php echo $form->numberField($model,'accuirance'); ?>
        <?php echo $form->error($model,'accuirance'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'isAlertNeeded'); ?>
        <?php echo $form->radioButton($model,'isAlertNeeded'); ?>
        <?php echo $form->error($model,'isAlertNeeded'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'alertEmail'); ?>
        <?php echo $form->textField($model,'alertEmail'); ?>
        <?php echo $form->error($model,'alertEmail'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'isPublic'); ?>
        <?php echo $form->radioButton($model,'isPublic'); ?>
        <?php echo $form->error($model,'isPublic'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'isFinished'); ?>
        <?php echo $form->radioButton($model,'isFinished'); ?>
        <?php echo $form->error($model,'isFinished'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'isCopyable'); ?>
        <?php echo $form->radioButton($model,'isCopyable'); ?>
        <?php echo $form->error($model,'isCopyable'); ?>
    </div> 

    <div class="row"> 
        <?php echo $form->labelEx($model,'scriptSource'); ?>
        <?php echo $form->textArea($model,'scriptSource'); ?>
        <?php echo $form->error($model,'scriptSource'); ?>
    </div> 


    <div class="row buttons"> 
        <?php echo CHtml::submitButton('Submit'); ?>
    </div> 

<?php $this->endWidget(); ?>

</div><!-- form -->