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
 class ElgergasiaModelJobEdit extends JModelDatabase { 
    
  
  
   
    function getState() {
        $state = parent::getState();
        $language =  $state->get('language', JFactory::getLanguage()->getTag());
        $id = $state->get('id');
        $form = JForm::getInstance('job', JPATH_COMPONENT . '/models/forms/job.xml');
        $form2 = JForm::getInstance('employer', JPATH_COMPONENT . '/models/forms/employer.xml');
        
        if( $id > 0 ) {
          $table = JTable::getInstance('job');
          $table2 = JTable::getInstance('jobtranslation'); 

          $table->load($id);
          $table2->load(array('idJob' =>$id, 'language'=>$language));
          $form->bind($table);
          $form->bind($table2);
          $state->set('data', $table);
          $state->set('translatedLanguages', Translations::getTranslatedLanguages("#__elg_ergasia_job_translation", $id, 'idJob'));
        }
        else {
          $form->setValue("idUser", null, $state->get("idUser"));
          $state->set('translatedLanguages', array());
        }
        if ( $form->getValue('idJobState') == ''):
            $form->setValue('idJobState', null, 2);
        endif;
        if($form2 -> getValue('idIndustry', null, 0) === 0):
            $form2 -> setValue('idIndustry', null, 11); //House working personnel
        endif;
        $form2 -> setFieldAttribute('discreteTitle', 'required', false);
	$form->setValue('language', null, $language);
        $state->set('form',$form);
        $state->set('form2', $form2);
        return $state;
    } 
   
}