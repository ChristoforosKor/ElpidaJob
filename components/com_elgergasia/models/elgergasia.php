<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
defined( '_JEXEC' ) or die( 'Restricted access' );
 
class ElgergasiaModelElgergasia extends JModelDatabase{
/**
    public function getState() {
        $state = parent::getState();
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $dataUsers = $this->getUsersByGroup($db, $query);
        $dataGroups = array();
        foreach($dataUsers as $item) {
            $dataGroups[$item->group_id] = $item->cnt;
        }
        unset($item);
        $state->set('usersByGroup', $dataGroups);
        $dataJobs = $this->getJobsByState($db, $query);
        $dataStates =  array();
        foreach($dataJobs as $item) {
            $dataStates[$item->id] = $item->cnt;
        }
        unset ($item);
        $state->set('jobsByState', $dataStates);
        return $state;
    }
    
    private function getUsersByGroup($db, $query) {
        $query->clear();
        $query->select(' count(*) as cnt, group_id ')
                ->from('#__user_usergroup_map')
                ->where('group_id = 11 or group_id=10')
                ->group('group_id')
                ->order('group_id');
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    private function getJobsByState($db, $query){
        $query->clear();
        $query->select("#__elg_ergasia_jobstates.id, count(#__elg_ergasia_job.id) as cnt")
                ->from("#__elg_ergasia_jobstates")
                ->leftJoin("#__elg_ergasia_job on #__elg_ergasia_job.idJobState = #__elg_ergasia_jobstates.id")
                ->group("#__elg_ergasia_jobstates.jobState")
                ->order("#__elg_ergasia_jobstates.jobState");
        $db->setQuery($query);
        return $db->loadObjectList();
    }
 * /
 */
}