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
 class ElgergasiaModelCandidatePaper extends JModelDatabase{ 
    function getState() {
        $state = parent::getState();
        $db = $this->getDb();
         $lang = JFactory::getLanguage()->getTag();
        $query = $db->getQuery();
        $query->clear();
        $query->select("id, ifNull(t.paperTitle, td.paperTitle) as paperTitle, paperFile, idUser")
                ->from("#__elg_ergasia_candidate_paper m")
                ->leftJoin("#__elg_ergasia_candidate_paper_translation t on m.id = t.idCandidatePaper and t.language = '" . $lang . "'")
                ->leftJoin("#__elg_ergasia_candidate_paper_translation td on m.id = td.idCandidatePaper and td.isDefault = 1")
                ->where(" id = " . $state->get('id'));
                
        
        $db->setQuery($query);
        $state->set('data', $db->loadObject());
        return $state;
    }
}
?>