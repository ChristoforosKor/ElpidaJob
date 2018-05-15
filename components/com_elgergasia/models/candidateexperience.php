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
 class ElgergasiaModelCandidateExperience extends JModelDatabase{ 
    function getState() {
        $state = parent::getState();
        $db = $this->getDb();
        $query = $db->getQuery();
        $query->clear();        
        $lang = JFactory::getLanguage()->getTag();
        $query  ->select("e.id, e.idUser, ifNull(ce.employerTitle, ced.employerTitle) as employerTitle, it.industry, st.speciality, dateFrom, dateTo, ifNull(ce.jobDescription, ced.jobDescription) jobDescription  ")
                ->from ("#__elg_ergasia_employees_experiences e")
                ->leftJoin("#__elg_ergasia_candidate_experience_translation ce on e.id = ce.idCandidateExperience and language = '" . $lang . "'" )
                ->leftJoin("#__elg_ergasia_candidate_experience_translation ced on e.id = ced.idCandidateExperience and ced.isDefault =1" )
                ->leftJoin("#__elg_ergasia_industry_translation it on e.idIndustry = it.idIndustry and it.language = '" . $lang . "'" )
                ->leftJoin("#__elg_ergasia_speciality_translation st on e.idSpecialization = st.idSpeciality and st.language = '" . $lang . "'")
                ->where("e.id= " . $state->get('id'));
        $db->setQuery($query);
        $state->set('data', $db->loadObject());
        return $state;
    }
}