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


class ElgergasiaControllerCandidateCharacteristicsSave extends JControllerBase{
    
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        require_once JPATH_COMPONENT . '/models/candidatecharacteristicssave.php';
        $model = new ElgergasiaModelCandidateCharacteristicsSave();
        $input = $this->getInput();
        $data = $input->getArray($_REQUEST);
        $data['language'] = $input->post->getCmd('language');
        $res = $model->setState(new JRegistry($data));
        $redUrl =JRoute::_('index.php?view=candidate&id=' . $input->get('idUser', 0, 'INT') . '&Itemid=' . $input->getInt('Itemid') . '#characteristicdata', false);
		 
        if($res) {
           $msg = Jtext::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS') ;
        }
        else {
            $msg = '';
        }
        JFactory::getApplication()->redirect($redUrl, $msg);
    }
}