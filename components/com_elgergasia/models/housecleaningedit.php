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
 
 
 class ElgergasiaModelHouseCleaningEdit extends JModelDatabase 
 {  
    function getState() {
        $table = JTable::getInstance('cleaning');
        $form = JForm::getInstance('houseCleaning', JPATH_COMPONENT_SITE . '/models/forms/housecleaning.xml');
        $state = parent::getState();
        $table->load($state->get('id'));
        $form->bind($table);
        $forms = [];
        $forms['houseCleaning'] = $form;
        $state->set('forms',$forms);
        return $state;
    }   
}