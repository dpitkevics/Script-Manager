<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>

<div>
    <h2>
        <?php echo $script->title; ?>
    </h2>
    <h4>
        <?php echo $script->description; ?>
    </h4>
    <p>
        <?php $this->beginWidget('CTextHighlighter', array(
            'language' => $script->language,
            'showLineNumbers' => $script->isLineNumberVisible,
            'lineNumberStyle' => 'table',
            'tabSize' => $script->tabSize,
        )); ?>
        <?php echo $script->scriptSource; ?>
        <?php $this->endWidget(); ?>
    </p>
        
    <?php $this->widget('CStarRating', array(
        'name' => 'rating',
        'minRating' => 1,
        'maxRating' => 100,
        'ratingStepSize' => 1,
        'starCount' => 20,
        'value' => $script->rateScore,
        'callback' => 'function () {
            var rating = $("input[name=\"rating\"]:checked").val();
            $.ajax({
                "url":"'.$this->createUrl('/ajax/rating/new', array('sid'=>$script->id)).'",
                "data":{
                    "rating":rating
                },
                "success":function(data) {
                    if (data == "exist")
                        alert("You can only vote once for this script");
                },
                "error":function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }',
    )); ?> 
    <span style="float:right">Average rating: <?php echo $script->rateScore; ?>/100 (<?php echo $script->rateCount; ?> votes)</span>
    <div class="clearfix"></div>
    
    <p>
        By <?php echo $script->user->first_name . ' ' . $script->user->last_name; ?>. Created on <?php echo date('Y/m/d H:i', $script->createdAt); ?>. Last update on <?php echo date('Y/m/d H:i', $script->lastUpdate); ?>.
    </p>
    <p>
        Tags: <?php echo (!empty($script->tags)?$script->tags:'No tags found for this script.'); ?>
    </p>
    <p>
        Path: <?php echo (!empty($script->path)?$script->path:'No path found for this script.'); ?>
    </p>
    <p>
        Usage: <?php echo (!empty($script->usage)?$script->usage:'No usage found for this script'); ?>
    </p>
    <p>
        Remembering You about this script every <?php echo $script->accuirance; ?> day(s).
        <?php if ($script->isAlertNeeded) {
            $day = 86400;
            $seconds = $day * $script->accuirance;
            $first = $script->createdAt;
            $sum = $first + $seconds;
            while(time() > $sum) {
                $sum += $seconds;
            }
        } ?>
        <?php echo (($script->isAlertNeeded)?'Next reminder on ' . date('Y/m/d H:i', $sum):''); ?>
    </p>
</div>