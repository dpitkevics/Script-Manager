<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<div>
    <?php if ($uid): ?>
    <h2>
       <?php echo $user->first_name . ' ' . $user->last_name; ?> 
    </h2>
    <p>
        Email: <?php echo $user->email; ?>
    </p>
    <p>
        User since: <?php echo date('Y-m-d H:i', $user->created_at); ?>
    </p>
    <?php else: ?>
    <h2>
        <?php echo $user->displayName; ?>
    </h2>
    <small>
        <?php echo CHtml::link('Visit Profile', $user->profileURL, array('target'=>'_blank')); ?>
    </small>
    <p>
        <?php echo CHtml::image(
                    (!empty($user->photoURL)?
                        $user->photoURL:
                        (!empty($user->gender)?
                            ($user->gender=="male"?
                                "https://psychicfriendsnetwork.com/images/profiles/profile-unknown-male.png":
                                "http://t1.gstatic.com/images?q=tbn:ANd9GcT47seF6yP8aiRZjc1p_pkkqmCoTDaQN6cXnPgVlmMDL6fTY3RL2w"):
                            "https://psychicfriendsnetwork.com/images/profiles/profile-unknown-male.png"
                        )
                    ), $user->displayName
                ); ?>
    </p>
    <?php $c = 0; ?>
    <?php foreach ($user as $fieldset => $field): ?>
    <?php $c++; if ($c <= 4 || $c == 16) continue; ?>
    <p>
        <?php $list = preg_split('/(?=[A-Z])/', $fieldset, -1, PREG_SPLIT_NO_EMPTY); ?>
        <?php if (count($list)==1): ?>
            <?php echo ucfirst($fieldset); ?>
        <?php else: ?>
            <?php foreach ($list as $word): ?>
                <?php echo ucfirst($word); ?>
            <?php endforeach; ?>
        <?php endif; ?>
        : <?php echo (!empty($field)?$field:'<small><em>Not specified</em></small>'); ?>
    </p>
    <?php endforeach; ?>
    <?php endif; ?>
</div>