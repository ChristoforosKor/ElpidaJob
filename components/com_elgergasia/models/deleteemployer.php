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
   
 class ElgergasiaModelDeleteEmployer extends JModelDatabase{
    
    function setState(JRegistry $state) {
        $db = $this->getDb();
        try {
            $db->transactionStart();
            $query = $db->getQuery(true);
            $query->delete('#__users')->where('id = ' . $state->get('idUser'));
            $db->setQuery($query);
            $db->execute();
            $query->clear();
            $query->delete('#__user_usergroup_map')->where('user_id=' . $state->get('idUser'));
            $db->execute();
            $query->clear();
            $query->delete('#__elg_ergasia_employer')->where('idUser=' . $state->get('idUser'));
            $db->execute();
            $db->transactionCommit();
        }
        catch(Exception $e) { 
            $db->transactionRollback();
            $state->set('errors',array($e));
        }        
    }
}
?>