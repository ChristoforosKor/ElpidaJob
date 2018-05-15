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
 
 class ElgergasiaModelCandidateEducationEditSave extends JModelDatabase{ 
    function setState(JRegistry $state) {
       $data = $state->get('formData');
       $inp = JFactory::getApplication()->input;
       $language = $inp->post->getCMD('language');
       $table = JTable::getInstance('candidateeducation');
       $table->bind($data);
       if(!$table->store()) {
           $state->set('errors', $table->getErrors());
       }
       else {
           $state->set('id', $table->id);
           $data2Store = (array)$state->get('formData');
           $data2Store['language'] = $language;
           Translations::saveTranslation('candidateeducationtranslation', '#__elg_ergasia_candidate_education_translation', $table->id, 'idCandidateEducation', $data2Store);
       }
       
       parent::setState($state);       
    }
}
?>