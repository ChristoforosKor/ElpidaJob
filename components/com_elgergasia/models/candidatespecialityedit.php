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
  class ElgergasiaModelCandidateSpecialityEdit extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $table = JTable::getInstance('candidatespeciality');
        $id = $state->get('id');
        if( $id > 0 ) {
            $table->load($id);
            $state->set('data', $table);
        }
        $state->set('form', JForm::getInstance('candidatespeciality', CommonUtils::getDefaultFormPath() .'/candidatespeciality.xml'));
        return $state;
    }
}
?>