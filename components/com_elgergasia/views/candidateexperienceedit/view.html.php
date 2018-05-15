<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
defined( '_JEXEC' ) or die( 'Restricted access' );
require JPATH_COMPONENT . '/views/elgviewform.php';
class  ElgergasiaViewCandidateExperienceEdit extends ElgergasiaViewElgViewForm{
      
  
    public function render() {
         
        $state = $this->model->getState();
        $data = $state->get('experiences', null);
        if(isset($data)) {
//            $from =  explode('-',  $data->dateFrom);
//            $data->monthFrom = $from[1]; 
//            $data->yearFrom =  $from[0];
//            $to = explode('-',  $data->dateTo);
//            $data->monthTo =  $to[1];
//            $data->yearTo =  $to[0];
//            $this->form->bind($data);
        }
        else {
            $this->form->setValue('id', null, $state->get('id', 0));
            $this->form->setValue('idUser', null, $state->get('idUser', 0));
        }
        $id = $state->get('id');
        if($id >0) {
            $this->retTo = JRoute::_('index.php?option=com_elgergasia&view=candidateexperience&layout=candidateexperience&id=' . $state->get('id'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
            $this->returnToText = JText::_('COM_ELGERGASIA_RETURN_TO_INFO_EXPERIENCE');
        }
        else {
            $this->retTo = JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' . $state->get('idUser'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
            $this->returnToText = JText::_('COM_ELGERGASIA_RETURN_TO_INFO_TAB');
        }
        $this->state = $state;
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        $this->translatedLanguages = $state->get('translatedLanguages');
        $this->formActionToDelete = JRoute::_('index.php?option=com_elgergasia&view=candidateexperience&layout=candidateexperiencedelete&id=' .$state->get('id'). '&idUser=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
        return parent::render();
     }    
    
 }
?>
