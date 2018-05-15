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
        
 class  ElgergasiaModelPreferencesCommentsEdit extends JModelDatabase{ 
    
    function getState() {
        $state = parent::getState();
        $idUser = $state->get('idUser', 0);
        if($idUser >0 ) {
            $db = $this->getDb();
            $query = $db->getQuery(true);
            $query->select('comments')
                    ->from('#__elg_ergasia_candidates_preferencescomments')
                    ->where('idUser = ' . $idUser);
            $db->setQuery($query);
            $state->set('comments', $db->loadResult());
            parent::setState($state);
        }
        return $state;
    }    
}
?>

 