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

 class  ElgergasiaViewPreferencesSectionsEdit extends JViewHTML{
      
  
    public function render() {
        $path = JPATH_COMPONENT . '/models/forms/preferencessections.xml';                                                                                 
        $form = JForm::getInstance('preferencessections', $path);
        $state = $this->model->getState();
        $form->setValue('idUser', null, $state->get('idUser', 0) );
        $form->setValue('idSections', null, $state->get('idSections'));
        $this->form = $form;
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        return parent::render();
     }    
    
 }
?>
