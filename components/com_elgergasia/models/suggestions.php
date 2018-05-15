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
 
 
 class ElgergasiaModelSuggestions extends JModelDatabase{ 
    private $filter = null;
 
    
    function getState() {
        $state = parent::getState();
//        $filters = $state->get('filters');
//        
        $inp = JFactory::getApplication()->input;
        $db = $this->getDb();
        $query = $db->getQuery(true);
//        $query->select ('distinct j.submitDate, j.jobTitle, j.' . $db->quoteName('id', 'idJob') . ', u.' . $db->quoteName('id', 'idUser') . ', cn.' . $db->quoteName('county') 
//                . ', u.' . $db->quoteName('name') . ',
//                ifNull((cedu.idSpecialization = j.idSpeciality),0) hasEducation,   
//                ifNull((cexp.idSpecialization = j.idSpeciality),0) hasExperience, 
//                ifNull((cspec.idSpeciality = j.idSpeciality),0) hasSpeciality,
//                ifNull((cpspec.idSpeciality = j.idSpeciality), 0) hasPrefSpeciality,
//                ifNull((sect.id = cpsect.idSection),0) hasPrefCounty ')
//                ->from ('#__elg_ergasia_jobs j') 
//                ->innerJoin ('#__elg_counties cn on j.idCounty = cn.id')
//                ->innerJoin ('#__elg_sections sect on sect.id = cn.idSection')
//                
//                ->join('cross','#__users u')
//                ->innerJoin('#__user_usergroup_map ug on u.id = ug.user_id and group_id = 10')
//                ->innerJoin('#__elg_ergasia_candidate_basic cb on cb.idUser = u.id and idState in(1,2,3)')
//                ->leftJoin('#__elg_ergasia_candidate_preferencesspecialities cpspec on cpspec.idUser = u .id')
//                ->leftJoin('#__elg_ergasia_candidates_sectionspreferences cpsect on cpsect.idUser = u.id ')
//                ->leftJoin('#__elg_ergasia_candidate_specialities cspec on cspec.idCandidate = u .id')
//                ->leftjoin('#__elg_ergasia_employees_experiences cexp on cexp.idUser = u.id')
//                ->leftJoin('#__elg_ergasia_candidate_education cedu on cedu.idCandidate = u.id')
//                ->leftJoin('#__elg_ergasia_candidates_sectionspreferences cpref on cpsect.idUser = u.id')
//                ->where('cpspec.idSpeciality = j.idSpeciality 
//                or cspec.idSpeciality = j.idSpeciality 
//                or cexp.idSpecialization = j.idSpeciality 
//                or cedu.idSpecialization = j.idSpeciality
//                or sect.id = cpsect.idSection')
//                ->order('submitDate desc, jobTitle, hasEducation desc, hasExperience desc, hasSpeciality desc, hasPrefSpeciality desc , hasPrefCounty desc');
//        $db->setQuery($query);
        
        
        $query->select("distinct u.id, u.name from xe45_elg_ergasia_jobs jb")
                ->innerJoin("#__elg_ergasia_candidate_preferencesspecialities cpr on cpr.idSpeciality = jb.idSpeciality")
                ->innerJoin("#__elg_counties ec on ec.id = jb.idCounty ")
                ->innerJoin("#__elg_ergasia_candidates_sectionspreferences csp on csp.idSection = ec.idSection")
                ->innerJoin("#__users u on u.id = csp.idUser and u.id = cpr.idUser");
        $where = "";
        $andV ="";
        $idJob = $inp->getInt('idJob',0);
        if($idJob > 0) 
        {
            $where = " jb.id = " . $idJob;
            $andV = "";
        }
        $state->set('data', $db->loadObjectList());
        
        return $state;
    }
}
?>