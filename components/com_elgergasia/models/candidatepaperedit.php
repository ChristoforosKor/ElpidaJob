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
 include JPATH_COMPONENT_SITE . '/libraries/joomla/models/translations.php';
  class ElgergasiaModelCandidatePaperEdit extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $form = JForm::getInstance('candidatepaper', CommonUtils::getDefaultFormPath() .'/candidatepaper.xml');
        
        $id = $state->get('id');
        if( $id > 0 ) {
            $table = JTable::getInstance('candidatepaper');
            $table->load($id);
            $table2 = JTable::getInstance('candidatepapertranslation');
            $table2->load(array('idCandidatePaper'=>$id, 'language'=>$state->get('language', JFactory::getLanguage()->getTag())));
            $state->set('data', $table);
            $state->set('dataTranslation', $table2);
            $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_candidate_medicalexam_translation", $id, 'idMedicalExam'));
            $form->bind($table);
            $form->bind($table2);
        }
        else
        {
           $form->setValue("idUser", null, $state->get("idUser"));
           $state->set('translatedLanguages', array());
        }
        $state->set('form', $form);
        return $state;
    }
}
?>