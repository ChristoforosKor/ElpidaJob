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
 
 
 class ElgergasiaModelHouseCleanings extends JModelDatabase 
 {  
    function getState() {
        $data = [];
        $state = parent::getState();
        $data['houseCleanings'] = $this->getHouseCleanings($this->getDb());
        $state->set('data', $data);
        return $state;
    }   
    
    private function getHouseCleanings($db)
    {
        $query = "select id, address, area_description from #__elg_ergasia_cleaning where isActive  in (1, 2)";
        return $db->setQuery($query)->loadAssocList();
    }
}