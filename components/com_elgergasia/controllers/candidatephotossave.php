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
class ElgergasiaControllerCandidatePhotosSave extends ElgergasiaController{
    public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'idUser'=> array('INT', 0)
            );
        parent::__construct($input, $app);
        $this->setRequestedValues('formData');
    }
    
    public function execute() {
        $this->request['storeFolder'] = JPATH_SITE . CommonUtils::getComponentParams()->get('candidatesPhotosFolder', '/media/com_elgergasia/candidatephotos');
        $this->request['uploadedFile1'] = $this->getInput()->files->get('candidatePhotoUpload1',null);
        $this->request['uploadedFile2'] = $this->getInput()->files->get('candidatePhotoUpload2',null);
        $this->request['uploadedFile3'] = $this->getInput()->files->get('candidatePhotoUpload3',null);
        parent::execute();
        $state = $this->model->getState();
        $redUrl =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $state->get('formData')->idUser . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        JFactory::getApplication()->redirect($redUrl);
    }

    protected function setSessionNamespace() {
         $this->sessionNamespace .=  $this->request['option'] .'candidatephotedit.data';
    }
    
}
?>
