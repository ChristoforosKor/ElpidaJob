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


class ElgergasiaControllerEmployeeCharacteristicsSave extends JControllerBase{
    
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        require_once JPATH_COMPONENT . '/models/employeecharacteristics.php';
        $model = new ElgergasiaModelEmployeeCharacteristics();
        $input = $this->getInput();
        $res = $model->setState(new JRegistry($input->getArray($_REQUEST)));
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=employee&id=' . $input->get('idUser', 0, 'INT'), false);
        if($res) {
           $msg = Jtext::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS') ;
        }
        else {
            $msg = '';
        }
        JFactory::getApplication()->redirect($redUrl, $msg);
    }
    
}
?>
