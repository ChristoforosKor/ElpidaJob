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

 class  ElgergasiaViewPreferencesHoursEdit extends JViewHTML{
    public function render() {
        $path = JPATH_COMPONENT . '/models/forms/preferenceshours.xml';                                                                                 
        $form = JForm::getInstance('preferenceshours', $path);
        $state = $this->model->getState();
        $form->setValue('idUser', null, $state->get('idUser', 0) );
        $form->setValue('idHours', null, $state->get('idHours'));
        $this->form = $form;
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        return parent::render();
     }    
    
 }
?>
