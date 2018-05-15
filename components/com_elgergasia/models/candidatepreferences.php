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
 
 
 class ElgergasiaModelCandidatePreferences extends JModelDatabase{ 
    
    function getState() {
        $state = parent::getState();
        $db = $this->getDb();
        $query = $db->getQuery(true);
        exit(var_dump($state));
        $this->getCandidateHours($db, $query, $state, $state->get('idCandidate') );
        return $state;
    }
    
    private function getCandidateHours($db, $query, $state, $idCandidate = 0) {
        $query->clear();
        $query  ->select('id, idCandidate, idHours')
                ->from('#__elg_ergasia_candidates-hous')
                ->where('idCandidate = ' . $idCandidate);
       $db->setQuery($query);
     
       $state->set('candidateHours', $db->loadObjectList());
       return $state;
    }
    
}
?>