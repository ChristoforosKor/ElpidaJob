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

 class  ElgergasiaViewCandidateBasic extends JViewHTML{
      
  
    public function render() {
        $state = $this->model->getState();
//        switch($this->getLayout()) {
//            case 'candidatebasicedit' : 
                $this->form = JForm::getInstance('basicForm', JPATH_COMPONENT . '/models/forms/candidatebasic.xml');
                $this->form->bind($state->get('basicData'));
                 $this->form->bind($state->get('basicDataTranslation'));
                $this->form->setValue('idUser', null, $state->get('idUser'));
                $this->retTo =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' .$state->get('idUser'). '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
                break;
//           }
           $this->candidate = CommonUtils::getUserTitleData( $state->get('idUser',0));
           return parent::render();
     }    
 }
?>
