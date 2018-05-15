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

class ElgergasiaControllerPaymentDelete extends ElgergasiaController{
    
    public function execute() {
        parent::execute();
        $state = $this->model->getState();
        $errors = $state->get('errors');
        $idPaymentType = $this->state->get('type',1);
        $viewTo = ($idPaymentType == 1 ? "employer": "candidate");
        CommonUtils::canQueueErrorsMessages($errors, JText::_('COM_ELGERGASIA_VIEW_DELETE_SUCCESS'));
        $redUrl = JRoute::_('index.php?option=com_elgergasia&view=' . $viewTo . '&layout=' . $viewTo . '&idUser=' . $state->get('idUser') . '&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
        
    }
    
}
?>
