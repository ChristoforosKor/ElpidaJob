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
 class  elgergasiaViewPreferencesSpecialitiesEdit extends ElgergasiaViewElgViewForm{
      
  
    public function render() {
        $path = JPATH_COMPONENT . '/models/forms/preferencesspecialities.xml';                                                                                 
        $form = JForm::getInstance('preferencesspecialities', $path);
        $state = $this->model->getState();
         $id = $this->state->get('id');
         $idUser = $this->state->get('idUser');
        $form->setValue('idUser', null, $state->get('idUser', 0) );
        $form->setValue('idSpecialities', null, $state->get('idSpecialities'));
        $this->form = $form;
         $commonUrl =  'index.php?option=' . $this->state->get('option') . '&idUser=' . $idUser . '&Itemid='  . $this->state->get('Itemid') . '&lang=' .$this->state->get('lang');
        $this->retNoAuthorise = JRoute::_($commonUrl . '&id=' . $id . '&view=candidateexperience&layout=candidateexperience', false);
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        return parent::render();
     }    
    
 }
?>
