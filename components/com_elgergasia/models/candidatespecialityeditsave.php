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
 class ElgergasiaModelCandidateSpecialityEditSave extends JModelDatabase{ 
    function setState(JRegistry $state) {
       $data = $state->get('formData');
       $table = JTable::getInstance('candidatespeciality');
       $table->bind($data);
       if(!$table->store()) {
           $state->set('errors', $table->getErrors());
       }
       else {
           $state->set('id', $table->id);
       }
       parent::setState($state);       
    }
}
?>