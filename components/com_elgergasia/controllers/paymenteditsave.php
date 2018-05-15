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
        
class   ElgergasiaControllerPaymentEditSave extends ElgergasiaController{
    public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'id'=> array('INT', 0),
            'idUser'=> array('INT', 0),
            'payDate'=>array('STRING',''),
            'payment'=>array('FLOAT', '')
            );
        parent::__construct($input, $app);
        $this->setRequestedValues('formData');
    }
    
    public function execute() {
       
        parent::execute();
        $state = $this->model->getState();
        $idPaymentType = $state->get('type',1);
        $viewTo = ($idPaymentType == 1 ? "employer": "candidate"); 
        $layout = ($viewTo == "employer" ? "default" : "candidate");
        //$state = $this->model->getState();
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=' . $viewTo . '&layout=' . $layout . '&idUser=' . $state->get('formData')->idUser . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
         $this->sessionNamespace .=  $this->request['option'] .'candidatelegalpapersave.data';
    }
    
}
?>
