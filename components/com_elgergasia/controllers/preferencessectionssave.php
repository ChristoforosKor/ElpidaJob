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
class ElgergasiaControllerPreferencesSectionsSave extends ElgergasiaController {
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        require_once JPATH_COMPONENT . '/models/preferencessectionssave.php';
        $model = new ElgergasiaModelPreferencesSectionsSave();
        $state = new JRegistry($this->request);
        $ids = array();
        $tmp = $this->getInput()->get('idSections', array(),'ARRAY');
        foreach($tmp as $item) {
            if(is_numeric($item)) {
                $ids[] = $item;
            }
        }
        unset($item);
        $state->set('idSections',$ids);
        $model->setState($state);
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $this->request['idUser'] . '&Itemid=' . $this->request['Itemid'] .'&lang=' . $this->request['lang'], false);
        JFactory::getApplication()->redirect($redUrl, Jtext::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS'));
    }

    protected function setSessionNamespace() {
        
    }
}
?>
