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
 
 include JPATH_COMPONENT_SITE .'/libraries/joomla/models/translations.php';
require_once JPATH_COMPONENT_SITE . '/models/datautils.php';
 
 class ElgergasiaModelCandidateCharacteristicsEdit extends JModelBase{ 
    
     
    function getState() {
        $state = parent::getState();
        $id = $state->get('id', 0);
        $form = JForm::getInstance('characteristicsForm', JPATH_COMPONENT . '/models/forms/candidatecharacteristic.xml');
        $language =  $state->get('language', JFactory::getLanguage()->getTag());
        
        if($id > 0 ) {
            $table = JTable::getInstance('candidatecharacteristic');
            $table->load($id);
            $tableTranslation = JTable::getInstance('candidatecharacteristictranslation');
            $tableTranslation->load(array('idCandidateCharacteristic' =>$id, 'language'=>$language));
//            $state->set('candidatecharacteristic', $table);
//            $state->set('candidatecharacteristictranslation', $tableTranslation);
            $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_candidate_characteristic_translation", $id, 'idCandidateCharacteristic'));
                       
        }
        else {
            $table = DataUtils::getNullCandidateCharacteristic();
            $tableTranslation = DataUtils::getNullCandidateCharacteristicTranslation();
//             $state->set('candidatecharacteristic', array());
            $state->set('candidatecharacteristictranslation', $tableTranslation);
             $state->set('translatedLanguages', array());
        }

        if($tableTranslation->language == '')
        {

            $tableTranslation->language = JFactory::getLanguage()->getTag();
        }
        if($table->id == null)
        {
            $table->id = $id;
        }
        if($table->idUser == null)
        {
            $table->idUser = $state->get('idUser', 0);
        }
         
        $form->bind($table);
        $form->bind($tableTranslation);
        $state->set('form', $form);

        return $state;        
    }
}