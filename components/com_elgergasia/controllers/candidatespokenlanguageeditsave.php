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
class ElgergasiaControllerCandidateSpokenLanguageEditSave extends ElgergasiaController{
     public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'id'=> array('INT', 0),
            'idUser'=> array('INT', 0),
            'spokenLanguage'=> array('STRING', ''),
            'idRank'=> array('INT', 0),
            'language'=>array('CMD', '')
        );
        parent::__construct($input, $app);
        $this->setRequestedValues('formData');
    }
    
    public function execute() {
        parent::execute();
        $state= $this->model->getState();
        $errors = $state->get('errors');
        $hasErrors= CommonUtils::canQueueErrorsMessages($errors, JText::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS'));
//        if($hasErrors) {
         //   $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid',0) . ' &lang=' . $state->get('lang'), false);
			
			$redUrl =JRoute::_('index.php?id=' . $state->get('idUser') . '&view=candidate&Itemid=' . $state->get('Itemid'), false);
			
		//echo $redUrl;
		
//        else {
//            $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidateexperience&layout=candidateexperience&id=' . $state->get('id') . '&idUser=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid',0) . '&lang=' . $state->get('lang'), false);
//        }
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
           $this->sessionNamespace = $this->request['option'] . '.candidatespokenlanguageedit.data';
    }
    
    
}
?>
