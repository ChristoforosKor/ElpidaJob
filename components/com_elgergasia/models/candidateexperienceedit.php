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
  include JPATH_COMPONENT_SITE .'/libraries/joomla/models/translations.php';
  class ElgergasiaModelCandidateExperienceEdit extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $table = JTable::getInstance('employeesexperiences');
        $form = JForm::getInstance('candidateexperience', CommonUtils::getDefaultFormPath() .'/candidateexperience.xml');
        $language = $state->get('language', JFactory::getLanguage()->getTag());
		$id = $state->get('id');
        if( $id > 0 ) {
            $table->load($id);
           // $state->set('experiences', $table);
            $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_legalpaper_translation", $id, 'idLegalPaper'));
            $table2 = JTable::getInstance('candidateexperiencetranslation');
            $table2->load(array('idCandidateExperience'=>$id, 'language'=>$language));
            
            $form->bind($table);
            $form->bind($table2);
            $from =  explode('-',  $table->dateFrom);
            $form->setValue('monthFrom', null, $from[1]); 
            $form->setValue('yearFrom', null, $from[0]);
            $to = explode('-',  $table->dateTo);
            $form->setValue('monthTo', null, $to[1]);
            $form->setValue('yearTo', null, $to[0]);
            
        }
        else {
             $form->setValue("idUser", null, $state->get("idUser"));
             $state->set('translatedLanguages', array());
        }
		$form->setValue('language', null, $language);
        $state->set('form', $form);
        return $state;
    }
}
?>