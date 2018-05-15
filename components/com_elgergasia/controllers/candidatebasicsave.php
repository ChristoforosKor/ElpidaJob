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
require 'controller.php' ;

class ElgergasiaControllerCandidateBasicSave extends ElgergasiaController {
    
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        require_once JPATH_COMPONENT . '/models/candidatebasicsave.php';
       
        $model = new ElgergasiaModelCandidateBasicSave();
        $state = $model->getState();
        $input = JFactory::getApplication()->input;
        $state->set('id', $input->getInt('id',null));
        $state->set('idUser', $input->getInt('idUser',0));
        $state->set('idCountry', $input->getInt('idCountry',0));
        $state->set('idState', $input->getInt('idState', 1));
        $state->set('city', $input->getString('city',''));
        $state->set('region', $input->getString('region',''));
        $state->set('address', $input->getString('address',''));
        $state->set('postalCode', $input->getCmd('postalCode',''));
        $state->set('phone', $input->getCmd('phone',''));
        $state->set('mobile', $input->getCmd('mobile',''));
        $state->set('fax', $input->getCmd('fax',''));
        $state->set('language', $input->post->getCmd('language', ''));
        $res = $model->setState($state);
        $redUrl =JRoute::_('index.php?model=candidate&view=candidate&Itemid=' . $input->getInt('Itemid'). '&id=' . $state->get('idUser', 0), false);
        if($res) {
           $msg = Jtext::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS') ;
        }
        else {
            $msg = '';
        }
        JFactory::getApplication()->redirect($redUrl, $msg);
    }

     protected function setSessionNamespace() {
        $this->sessionNamespace .=  $this->request['option'] .'candidatebasicedit.data';
    }
    
}
?>
