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
 class  ElgergasiaViewCandidatePaperEdit extends ElgergasiaViewElgViewForm {
    public function render() {
        $state = $this->model->getState();
       
        $this->returnToText = JText::_('COM_ELGERGASIA_RETURN_TO_CANDIDATE_INFO_TAB');
        $this->retTo = JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' .$state->get('idUser'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        $this->state = $state;
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        $this->formActionToDelete = JRoute::_('index.php?option=com_elgergasia&view=candidatepaper&layout=candidatepaperdelete&id=' .$state->get('id'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        $this->translatedLanguages = $state->get('translatedLanguages');
        return parent::render();
     }    
    
 }
?>
