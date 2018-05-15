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
 class ElgergasiaModelCandidateSpecialityDelete extends JModelDatabase{ 
    function setState(JRegistry $state) {
        $table = JTable::getInstance('candidatespeciality');
        if(!$table->delete($state->get('id')) ){
             $state->set('errors', $table->getErrors());
        }
        parent::setState($state);
    }
}
?>