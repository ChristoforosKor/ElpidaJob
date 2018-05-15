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
 class  ElgergasiaModelCandidateSpokenLanguage extends JModelDatabase{ 
    function getState() {
        $state = parent::getState();
        $db = $this->getDb();
        $query = $db->getQuery();
        $query->clear();
          $query->select("e.id, idUser, spokenlanguage, r.rankNeut")
                ->from ('#__elg_ergasia_candidates_spokenlanguages e')
                 ->join("left", "#__elg_ergasia_ranks r on e.idRank = r.id")
                ->where('e.id = ' . $state->get('id'))
                ->order('spokenLanguage, rankNeut');
                $db->setQuery($query);
        $db->setQuery($query);
        $state->set('data', $db->loadObject());
        return $state;
    }
}
?>