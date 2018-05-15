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
 class ElgergasiaModelCandidateSpeciality extends JModelDatabase{ 
    function getState() {
        $state = parent::getState();
        $db = $this->getDb();
        $query = $db->getQuery();
        $lang = JFactory::getLanguage()->getTag();
        $query->clear();
        $query->select("e.id,e.idUser, s.speciality,e.experience,  r.rankFem as rank ")
                ->from ('#__elg_ergasia_candidate_speciality e')
                ->leftJoin("#__elg_ergasia_speciality_translation s on e.idSpeciality = e.id and s.language ='" . $lang . "'")
                ->leftJoin("#__elg_rank_translation r on e.idRank = r.idRank and r.language ='" .$lang . "'")
                ->where('e.id = ' . $state->get('id'))
                ->order('rank, experience, speciality');
   
        $db->setQuery($query);
        $state->set('data', $db->loadObject());
        return $state;
    }
}
?>