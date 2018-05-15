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

 class  ElgergasiaViewCandidateCharacteristicsEdit extends JViewHTML{
      
  
    public function render() {
        $input = JFactory::getApplication()->input;
        $this->id = $input->get('id', 0, 'INT');
        $this->idUser = $input->get('idUser', 0, 'INT');
        $state = $this->model->getState();
        $path = JPATH_COMPONENT . '/models/forms/candidatecharacteristic.xml';                                                                                 
        $this->form = JForm::getInstance('characteristicsForm', $path);
        switch($this->getLayout()) {
            case 'candidatecharacteristicsedit_translation' : 
            case 'candidatecharacteristicsedit' : 
                if (isset($state)) {
                    $this->form->bind($state->get('candidatecharacteristic'));
                    $this->form->bind($state->get('candidatecharacteristictranslation'));
                    $this->translatedLanguages = $state->get('translatedLanguages');
                }
                //else {
                //   
                //}
                $this->form->setValue('id', null, $this->id);
                $this->form->setValue('idUser', null, $this->idUser );
                $this->retTo =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
                break;
           }
           $this->candidate = CommonUtils::getUserTitleData($this->idUser);
          
           return parent::render();
        
       
    }    
 }
?>
