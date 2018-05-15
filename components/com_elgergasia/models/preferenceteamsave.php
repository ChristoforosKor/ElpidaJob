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
 
 class ElgergasiaModelPreferenceTeamSave extends JModelDatabase{ 
    
   function setState(JRegistry $state) {
       $table = '#__elg_ergasia_candidate_team';
       $data = $state->get('idUserTeam');
       $db = $this->getDb();
       $query = $db->getQuery(true);
       $idUser = $state->get('idUser', 0);
       $query->delete($table)->where('idUser=' . $idUser);
       $db->setQuery($query);
       $db->execute();
	   // var_dump($state);
	   
       if(is_numeric($state->get('idUserTeam', '')))
	   {
		// echo '<br />' . 2;
			$dao = new stdClass();
			$idUser = $state->get('idUser', 0);
			$idUserTeam = trim($state->get('idUserTeam', 0));
       // foreach($data as $item) {
           // $dao->idUser = $idUser;
           // $dao->idHour = $item;
           // $db->insertObject($table, $dao);
       // }
			$dao->idUser = $idUser;
			$dao->idUserTeam = $idUserTeam;
			$db->insertObject($table, $dao);
		}
		// exit();
        $lt = JTable::getInstance('lastupdates');
        $lt->load(array('idUser'=>$idUser));
    
        $lt->datemodified = date('Y-m-d H:i');
        $lt->store();
    }       
}
?>