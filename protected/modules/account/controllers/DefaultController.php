<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
        $ha = $this->getHybridauth();
        $user = $this->getProfileData($ha);
        if (!$user)
            throw new CHttpException(404, "No user found");
		$this->render('view', array('user'=>$user, 'uid'=>null));
	}
    
    public function actionView($uid = null)
    {
        if ($uid === null) {
            $ha = $this->getHybridauth();
            $user = $this->getProfileData($ha);
            if (!$user)
                throw new CHttpException(404, "No user found");
        } else {
            $user = User::model()->findByPk($uid);
            if (!$user)
                throw new CHttpException(404, "No user found");
        }
        $this->render('view', array('user'=>$user, 'uid'=>$uid));
    }
}