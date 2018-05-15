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
class ElgergasiaControllerEmployerSave extends ElgergasiaController{
    public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'id'=> array('INT', 0),
            'idUser'=> array('INT', 0),
            'discreteTitle'=> array('STRING', ''),
            'name'=> array('STRING', ''),
            'idIndustry'=> array('INT', 0),
            'profession'=> array('STRING', ''),
            'idCountry'=> array('INT', 0),
            'city'=> array('STRING', ''),
            'address'=> array('STRING', ''),
            'postalcode'=> array('STRING', ''),
            'website'=> array('STRING', ''),
            'email'=> array('STRING', ''),
            'phone'=> array('STRING', ''),
            'mobile'=> array('STRING', ''),
            'fax'=> array('STRING', ''),
            'taxOffice'=> array('STRING', ''),
            'taxNumber'=> array('STRING', ''),
            'information'=> array('STRING', ''),
            'language'=>array('STRING')
            );
       
        
        parent::__construct($input, $app);
        $this->setRequestedValues('formData');
    }

    public function execute() {
        parent::execute();
        $state = $this->model->getState();
        $errors = $state->get('errors');
        $hasErrors= CommonUtils::canQueueErrorsMessages($errors, JText::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS'));
        if($hasErrors) {
            $redUrl = 'index.php?option=' . $state->get('option') . '&view=employeredit&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang');
        }
        else {
            $redUrl = 'index.php?option=' . $state->get('option') . '&view=employer&id=' . $state->get('idUser') . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang');
            
        }
        
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
       
        $this->sessionNamespace .=  $this->request['option'] .'employeredit.data';
    }   
}
