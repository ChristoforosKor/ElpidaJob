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
 jimport( 'joomla.application.component.model' );
 include JPATH_COMPONENT_SITE .'/libraries/joomla/models/translations.php';
 class ElgergasiaModelCandidateBasicSave extends JModelBase{ 
    
   
    function setState(JRegistry $data) {
        $data2Store = $data->toArray();
        $table = JTable::getInstance('candidatebasic');
        $table->bind($data2Store);
        $table->store();
        Translations::saveTranslation('candidatebasictranslation', '#__elg_ergasia_candidate_basic_translation', $table->id, 'idCandidateBasic', $data2Store);
        
    }

}
?>