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

class ElgergasiaControllerCandidatePaperDelete extends ElgergasiaController{
    
    public function execute() {
        parent::execute();
        $state = $this->model->getState();
        $errors = $state->get('errors');
        CommonUtils::canQueueErrorsMessages($errors, JText::_('COM_ELGERGASIA_VIEW_DELETE_SUCCESS'));
        $redUrl = JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&idUser=' . $state->get('idUser') . '&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
        
    }
    
}
?>
