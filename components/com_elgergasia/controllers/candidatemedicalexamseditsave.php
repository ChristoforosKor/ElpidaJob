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
        
class   ElgergasiaControllerCandidateMedicalExamsEditSave extends ElgergasiaController{
    public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'idUser'=> array('INT', 0),
            'examDate'=>array('STRING',''),
            'examTitle'=>array('STRING', ''),
            'language'=>array('STRING', '')
            );
        parent::__construct($input, $app);
        $this->setRequestedValues('formData');
    }
    
    public function execute() {
        $this->request['storeFolder'] = JPATH_SITE . '/media/com_elgergasia/medicalexams';
        $this->request['uploadedFile'] = $this->getInput()->files->get('examFile',null);
        parent::execute();
        $state = $this->model->getState();
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $state->get('formData')->idUser . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
         $this->sessionNamespace .=  $this->request['option'] .'candidatemedicalexamssave.data';
    }
    
}
?>
