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
 
 class ElgergasiaModelPreferencesHoursSave extends JModelDatabase{ 
    
   function setState(JRegistry $state) {
       $table = '#__elg_ergasia_candidates_hours';
       $data = $state->get('idHours');
       $db = $this->getDb();
       $query = $db->getQuery(true);
       $idUser = $state->get('idUser', 0);
       $query->delete($table)->where('idUser=' . $idUser);
       $db->setQuery($query);
       $db->execute();
       $dao = new stdClass();
     
       foreach($data as $item) {
           $dao->idUser = $idUser;
           $dao->idHour = $item;
           $db->insertObject($table, $dao);
       }
    }       
}