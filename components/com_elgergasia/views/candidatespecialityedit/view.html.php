<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT . '/views/elgviewform.php';
 class  ElgergasiaViewCandidateSpecialityEdit extends ElgergasiaViewElgViewForm {
    public function render() {
        $state = $this->model->getState();
        $data = $state->get('data', null);
        if(isset($data)) {
            $this->form->bind($data);
        }
        else {
            $this->form->setValue('id', null, $state->get('id', 0));
            $this->form->setValue('idUser', null, $state->get('idUser', 0));
        }
        
        $this->retTo = JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' .$state->get('idUser'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        $this->state = $state;
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        $this->formActionToDelete = JRoute::_('index.php?option=com_elgergasia&view=candidatespeciality&layout=candidatespecilitydelete&id=' .$state->get('id'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        return parent::render();
     }    
    
 }
?>
