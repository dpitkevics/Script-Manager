<?php

/**
 * AJAX MENU Component made by Daniels Pitkevičs
 * Basic usage: Paste AjaxMenu folder inside protected/components directory
 * Add method:
 * 
   public function output($view, $vars = array())
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial($view, $vars);
        } else {
            $this->render($view, $vars);
        }
    }
 * 
 * to protected/components/Controller.php file inside class Controller.
 * This method will say to web application whether to choose basic rendering or rendering just part of page.
 * And in each controller, where You use $this->render, change to $this->output. Usage stays the same.
 * 
 * Exaple of calling AjaxMenu from layout:
 * 
   <?php $this->widget('application.components.AjaxMenu.AjaxMenu',array(
        'items'=>array(
            array('label'=>'Home', 'url'=>array('/site/index')),
            array('label'=>'About', 'url'=>array('/site/about', 'id'=>5, 'nid'=>7)),
            array('label'=>'Contact', 'url'=>array('/site/contact')),
            array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
        ),
    )); ?>
 * 
 * Called like basic CMenu widget.
 */

Yii::import('zii.widgets.CMenu');

class AjaxMenu extends CMenu
{
    public $loadingBox = "<p>Loading...</p>";
    
    /**
     * Runs widget like parent class, but checks for hash in URL before.
     * @author Daniels Pitkevičs <daniels.pitkevics@gmail.com>
     * @param none
     * @return none
     */
    public function run() {
        $this->checkHash();
        parent::run();
    }
    
    /**
     * Renders menu item - ajaxLink with paramters.
     * @param array $item
     * @return string generated link
     */
    protected function renderMenuItem($item) {
        if(isset($item['url']))
		{           
            $url = $item['url'];
            $route = $url[0];
            array_shift($url);
			$label=$this->linkLabelWrapper===null ? $item['label'] : '<'.$this->linkLabelWrapper.'>'.$item['label'].'</'.$this->linkLabelWrapper.'>';
            $item['linkOptions']['onclick'] = '$(".'.$this->activeCssClass.'").removeClass("'.$this->activeCssClass.'"); $(this).parent().addClass("'.$this->activeCssClass.'"); location.hash=$(this).attr("data-url");';
            $item['linkOptions']['onclick'] .= '$("#content").html("'.$this->loadingBox.'");';
            $item['linkOptions']['data-url'] = Yii::app()->createUrl($route, $url);
            return CHtml::ajaxLink($label,$item['url'], array('update'=>'#content'),isset($item['linkOptions']) ? $item['linkOptions'] : array());
		}
		else
			return CHtml::tag('span',isset($item['linkOptions']) ? $item['linkOptions'] : array(), $item['label']);
    }
    
    /**
     * Registers used Javascript
     * @param string $id Unique ID of javascript code
     * @param string $js javascript code
     */
    protected function registerJs($id, $js) {
        Yii::app()->clientScript->registerScript($id, $js, CClientScript::POS_READY);
    }
    
    /**
     * Checking for Hash tag in URL
     */
    protected function checkHash() {
        $js = 'if(window.location.hash) {
                var hash = window.location.hash.substring(1);
                $.ajax({
                    "method":"post",
                    "url":hash,
                    "success":function(data) {
                        $("#content").html(data);
                        $(".active").removeClass("active");
                        $("[data-url=\'"+hash+"\']").parent().addClass("active");
                    }
                });
            }';
        $this->registerJs('hash_check', $js);
    }
    
    /**
     * Creates specified ajax call from session
     * @return string generated button
     * @deprecated since version 1.0
     */
    protected function createAjaxCall()
    {
        return CHtml::ajax(array(
            'url'=>Yii::app()->session['ajax-menu'],
            'update'=>'#content',
        ));
    }
}