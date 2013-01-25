<?php

class ScriptModule extends CWebModule
{
    private $_scripts;
    
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'script.models.*',
			'script.components.*',
		));
        $this->_scripts = Script::model()->findByAttributes(array('user_id'=>Yii::app()->user->id));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
    
    public function getScripts()
    {
        return $this->_scripts;
    }
}
