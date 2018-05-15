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
 require JPATH_COMPONENT_SITE . '/libraries/joomla/models/translations.php';
 //jimport( 'joomla.application.component.model' );
 class ElgergasiaModelCandidateBasicEdit extends JModelDatabase{ 
    
    function getState() {
        $state = parent::getState();
        $id = $state->get('id',0 );
     
        if($id > 0 ) {
            $table = JTable::getInstance('candidatebasic');
            $language =  $state->get('language', JFactory::getLanguage()->getTag());
            $table->load($id);
            $tableTranslation = JTable::getInstance('candidatebasictranslation');
            $tableTranslation->load(array('idCandidateBasic' =>$id, 'language'=>$language));
            $state->set('basicData', $table);
            $state->set('basicDataTranslation', $tableTranslation);
            $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_candidate_basic_translation", $id, 'idCandidateBasic'));
         }
         else {
             $state->set('basicData', array());
             $state->set('basicDataTranslation', array());
             $state->set('translatedLanguages', array());
         }
         
         return $state;
    }
}
?>