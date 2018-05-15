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
require __DIR__ . '/controller.php' ;
class ElgergasiaControllerPreferenceTeamSave extends ElgergasiaController {
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        require_once JPATH_COMPONENT . '/models/preferenceteamsave.php';
        $model = new ElgergasiaModelPreferenceTeamSave();
        $state = new JRegistry($this->request);
		$state->set('idUserTeam', $this->getInput()->get('idUserTeam', 0));
		/**
		$idHours = array();
        $tmp = $this->getInput()->get('idHours', array(),'ARRAY');
        foreach($tmp as $item) {
            if(is_numeric($item)) {
                $idHours[] = $item;
            }
        }
        unset($item);
        $state->set('idHours',$idHours);
        **/
		$model->setState($state);
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $this->request['idUser'] . '&Itemid=' . $this->request['Itemid'] .'&lang=' . $this->request['lang'], false);
        JFactory::getApplication()->redirect($redUrl, Jtext::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS'));
    }

    protected function setSessionNamespace() {
        
    }
}
?>
