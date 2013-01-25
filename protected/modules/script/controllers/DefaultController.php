<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $scripts = Script::model()->findAllByAttributes(array('user_id'=>Yii::app()->user->id));
        
		$this->render('index', array('script_list'=>$scripts));
	}
    
    public function actionCreate() 
    { 
        $model=new Script('create'); 

        // uncomment the following code to enable ajax-based validation 
         
        if(isset($_POST['ajax']) && $_POST['ajax']==='script-create-form') 
        { 
            echo CActiveForm::validate($model); 
            Yii::app()->end(); 
        } 
        

        if(isset($_POST['Script'])) 
        { 
            $model->attributes=$_POST['Script']; 
            $model->user_id = Yii::app()->user->id;
            $model->isDeleted = 0;
            $model->lastUpdate = time();
            $model->createdAt = time();
            if($model->save()) 
            { 
                // form inputs are valid, do something here 
                $this->redirect(Yii::app()->user->returnUrl); 
            } 
        } 
        $this->render('create',array('model'=>$model)); 
    }
    
    public function actionView($sid = null)
    {
        $script = Script::model()->findByPk($sid);
        $this->render('view', array('script'=>$script));
    }
}