<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );
require JPATH_COMPONENT_SITE . '/controller.php';

class ElgergasiaControllerEmployeeExperienceDelete extends ElgergasiaController{
    
    public function execute() {
        //JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        require_once JPATH_COMPONENT . '/models/employeeexperiences.php';
        
        $model = new ElgergasiaModelEmployeeExperiences();
        $model->setState(new JRegistry($this->request));
        $input = $this->getInput();
        $res = $model->deleteRow();
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&id=' . $this->request['idUser'], false);
        if($res) {
           $msg = Jtext::_('COM_ELGERGASIA_VIEW_DELETE_SUCCESS') ;
        }
        else {
            $msg = '';
        }
        JFactory::getApplication()->redirect($redUrl, $msg);
    }
    
}
?>
