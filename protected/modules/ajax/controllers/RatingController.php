<?php

class RatingController extends Controller
{
	public function actionNew()
    {
        Yii::import('script.models.*');
        if (Yii::app()->request->isAjaxRequest) {
            $rating = $this->validateInt($_GET['rating']);
            $sid = $this->validateInt($_GET['sid']);
            
            if ($rating < 0 || $rating > 100)
                throw new CHttpException(406, "Invalid rating");
            $script = Script::model()->findByPk($sid);
            if (!$script)
                throw new CHttpException(404, "Script not found");
            
            $rate = Rate::model()->findByAttributes(array('ipAddress'=>Yii::app()->request->getUserHostAddress()));
            if ($rate) {
                echo 'exist';
                return;
            }
            $rate = new Rate;
            $rate->script_id = $sid;
            $rate->ipAddress = Yii::app()->request->getUserHostAddress();
            $rate->ratedAt = time();
            if ($rate->save()) {
                $rateTotalNew = $script->rateTotal + $rating;
                $rateCountNew = $script->rateCount + 1;
                $script->rateScore = $rateTotalNew / $rateCountNew;
                $script->rateTotal = $rateTotalNew;
                $script->rateCount = $rateCountNew;
                $script->save(false);
            }
            
        } else 
            throw new CHttpException(403, "This is not an ajax call");
    }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}