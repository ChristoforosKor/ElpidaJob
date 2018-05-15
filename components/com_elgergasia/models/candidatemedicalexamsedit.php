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
  class ElgergasiaModelCandidateMedicalExamsEdit extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $form = JForm::getInstance('candidatemedicalexam', CommonUtils::getDefaultFormPath() .'/candidatemedicalexam.xml');
       
        $id = $state->get('id');
        if( $id > 0 ) {
            $table = JTable::getInstance('candidatemedicalexam');
            $table->load($id);
            $table2 = JTable::getInstance('candidatemedicalexamtranslation');
            $table2->load(array('idMedicalExam'=>$id, 'language'=>$state->get('language', JFactory::getLanguage()->getTag())));
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