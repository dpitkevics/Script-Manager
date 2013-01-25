<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    public function output($view, $vars = array())
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial($view, $vars);
        } else {
            $this->render($view, $vars);
        }
    }
    
    protected function validateInt($int) {
        return intval($int);
    }
    protected function validateString($string) {
        return CHtml::encode($string);
    }


    protected function getHybridauth()
    {
        $ha = Yii::app()->getModule('hybridauth')->getHybridAuth();
        return ($ha?$ha:null);
    }
    protected function getConnectedProviders($ha)
    {
        return ($ha?$ha->getConnectedProviders():null);
    }
    protected function getProfileData($ha, $provider = 'all')
    {
        if ($ha) {
            if ($provider === 'all') {
                $provider_list = $this->getConnectedProviders($ha);
                if (count($provider_list)==1) {
                    $provider = $provider_list[0];
                    $provider_list = null;
                }
            } else {
                $provider_list = null;
            }
            if ($provider_list) {
                $data_list = array();
                foreach ($provider_list as $provider_name) {
                    $active = $ha->getAdapter($provider_name);
                    if ($active->isUserConnected()) {
                        $data_list[] = $active->getUserProfile();
                    }
                }
                return $data_list;
            } else {
                $active = $ha->getAdapter($provider);
                if ($active->isUserConnected()) {
                    return $active->getUserProfile();
                }
            }
        }
    }
}