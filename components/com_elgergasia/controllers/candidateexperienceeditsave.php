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
require 'controller.php';
class ElgergasiaControllerCandidateExperienceEditSave extends ElgergasiaController{
     public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'id'=> array('INT', 0),
            'idUser'=> array('INT', 0),
            'idIndustry'=> array('INT', 0),
            'idSpecialization'=> array('INT', 0),
            'employerTitle'=> array('STRING', ''),
            'monthFrom'=> array('INT', 0),
            'yearFrom'=> array('INT', 0),
            'monthTo'=> array('INT', 0),
            'yearTo'=> array('INT', 0),
            'jobDescription'=> array('STRING', ''),
            'language'=> array('CMD', '')     
        );
        parent::__construct($input, $app);
        $this->setRequestedValues('formData');
    }
    
    public function execute() {
        parent::execute();
        $state= $this->model->getState();
        $errors = $state->get('errors');
        $hasErrors= CommonUtils::canQueueErrorsMessages($errors, JText::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS'));
//        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidateexperience&layout=candidateexperience&id=' . $state->get('id') . '&idUser=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid',0) . '&lang=' . $state->get('lang'), false);
        $redUrl =JRoute::_('index.php?view=candidate&model=candidate&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid'), false);
		
		//$redUrl =JRoute::_('index.php?id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
//        if($hasErrors) {
//            $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid',0) . ' &lang=' . $state->get('lang'), false);
//        }
//        else {
//            
//        }
//        if($hasErrors) {
//            $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid',0) . ' &lang=' . $state->get('lang'), false);
//        }
//        else {
//            
//        }
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
           $this->sessionNamespace = $this->request['option'] . '.candidateedit.data';
    }
    
}
?>
