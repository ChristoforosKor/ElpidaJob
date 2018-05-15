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
 class ElgergasiaModelCandidateExperienceEditSave extends JModelDatabase{ 
    function setState(JRegistry $state) {
       $data = $state->get('formData');
       $inp = JFactory::getApplication()->input;
       $language = $inp->post->getCMD('language');
       $data->dateFrom = $data->yearFrom . '-' . $data->monthFrom . '-1';
       $data->dateTo = $data->yearTo . '-' . $data->monthTo . '-1';
       $table = JTable::getInstance('employeesexperiences');
       $table->bind($data);
       $res = $table->store();
       if(!$res) {
           $dbg  = $table->getError();
           $state->set('errors', $table->getErrors());
       }
       else {
           $state->set('id', $table->id);
           $data2Store = array('employerTitle'=>$data->employerTitle, 'language'=>$language, 'jobDescription'=>$data->jobDescription );
           Translations::saveTranslation('candidateexperiencetranslation', '#__elg_ergasia_candidate_experience_translation', $table->id, 'idCandidateExperience', $data2Store);
       }
       parent::setState($state);       
    }
}
?>