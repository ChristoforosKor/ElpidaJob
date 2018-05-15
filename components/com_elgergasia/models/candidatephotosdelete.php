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
 
 class ElgergasiaModelCandidatePhotosDelete extends JModelDatabase{ 
    

    private $table = null;
    
    public function __construct() {
        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
        $this->table = JTable::getInstance('candidatesphotos','Table');
        
        parent::__construct();
    }
        
//    function getState() {
//        $state = parent::getState();
//        $state->set('photosData', $this->table->load($state->get('id')));
//        return $state;
//    }
    function setState(JRegistry $data) {
        $this->table->delete($data->get('id'));
        return true;
    }        
}
?>