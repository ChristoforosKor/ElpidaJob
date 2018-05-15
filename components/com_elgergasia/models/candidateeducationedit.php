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
  class ElgergasiaModelCandidateEducationEdit extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $id = $state->get('id');
        $form = JForm::getInstance('candidateseducation', CommonUtils::getDefaultFormPath() .'/candidateeducation.xml');
		$language =  $state->get('language', JFactory::getLanguage()->getTag());
		if( $id > 0 ) {
            $table = JTable::getInstance('candidateeducation');
            $table2 = JTable::getInstance('candidateeducationtranslation');            
           
           
            $table2->load(array('idCandidateEducation' =>$id, 'language'=>$language));
            $table->load($id);
            $form->bind($table);
            $form->bind($table2);
            $state->set('data', $table);
            $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_candidate_education_translation", $id, 'idCandidateEducation'));
        }
        else {
            $form->setValue("idUser", null, $state->get("idUser"));
            $state->set('translatedLanguages', array());
        }
		
		$form->setValue('language', null, $language);
        $state->set('form', $form );
        return $state;
    }
}
?>