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
 
 class ElgergasiaModelCandidatePhotos extends JModelDatabase{ 
    
    private $table = null;
    
    public function __construct() {
        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
        $this->table = JTable::getInstance('candidatesphotos','Table');
        parent::__construct();
    }
     
    function getState() {
        $state = parent::getState();
//        $id = $state->get('id', 0);
//        if($id > 0 ) {
//            $this->table->load($state->get('id'));
//            $state->set('photos', $this->table);
//        }
        $idUser = $state->get('idUser', 0);
        if($idUser >0) {
            $db = $this->getDb();
            $query = $db->getQuery(true);
            $query  ->select('id, photo, photoExtension')
                    ->from('#__elg_ergasia_candidate_photos')
                    ->where('idUser = ' . $idUser);
            $db->setQuery($query);
            $data = $db->loadObjectList();
        }
        else {
            $data = array();
        }
        $state->set('photos', $data);
        return $state;
    }
        
    
}
?>