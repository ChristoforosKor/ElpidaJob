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
 class ElgergasiaModelCandidateEducation extends JModelDatabase{ 
    function getState() {
        $state = parent::getState();
        $db = $this->getDb();
        $query = $db->getQuery();
        $lang = JFactory::getLanguage()->getTag();
        $query->clear();
        $query->select("e.id, idUser,ifNull(et.educationTitle, etd.educationTitle) as educationTitle, l.degreeLevel, ifNull(et.educationInstitute, etd.educationInstitute) as educationInstitute, s.speciality, yearFrom, yearTo")
                ->from ('#__elg_ergasia_candidate_education e')
                ->leftJoin("#__elg_ergasia_candidate_education_translation et on et.idCandidateEducation = e.id and et.language = '" . $lang . "'")
                ->leftJoin("#__elg_ergasia_candidate_education_translation etd on etd.idCandidateEducation = e.id and etd.isDefault = 1")
                ->join('left', "#__elg_ergasia_degree_level_translation l on e.idDegreeLevel = l.idDegreeLevel and l.language = '" . $lang . "'")
                ->join('left', "#__elg_ergasia_speciality_translation s on e.idSpecialization = s.idSpeciality  and s.language = '" . $lang . "'")
                ->where('e.id = ' . $state->get('id'))
                ->order('yearFrom, yearTo desc, educationTitle');
                $db->setQuery($query);
        $db->setQuery($query);
        $state->set('data', $db->loadObject());
        return $state;
    }
}
?>