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
 class ElgergasiaModelCandidateMedicalExams extends JModelDatabase{ 
    function getState() {
        $state = parent::getState();
        $lang = JFactory::getLanguage()->getTag();
        $db = $this->getDb();
        $query = $db->getQuery();
        $query->clear();
        $query->select("id, ifNull(t.examTitle, td.examTitle) as examTitle, examFile, examDate, idUser")
                ->from("#__elg_ergasia_candidate_medicalexam m")
                ->leftJoin("#__elg_ergasia_candidate_medicalexam_translation t on m.id = t.idMedicalExam and t.language = '" . $lang . "'")
                ->leftJoin("#__elg_ergasia_candidate_medicalexam_translation td on m.id = td.idMedicalExam and td.isDefault = 1")
                ->where(" id = " . $state->get('id'));
                
        $dbg = $query->dump();
        $db->setQuery($query);
        $state->set('data', $db->loadObject());
        return $state;
    }
}
?>