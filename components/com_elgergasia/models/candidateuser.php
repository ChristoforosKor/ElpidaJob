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
 
 class ElgergasiaModelCandidateUser extends JModelDatabase{ 
    
    
    private $id = 0;
    private $user = null;
    
    public function __construct() {
        $this->id = JFactory::getApplication()->input->get('id', 0 , 'INT');
        //$this->idUser = JFactory::getApplication()->input->get('iduser', 0 , 'INT');
        //JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
        //$this->table = JTable::getInstance('candidatesphotos','Table');
        $this->user = JFactory::getUser($this->id);
        parent::__construct();
    }
     
    function getState() {
//        if($this->id > 0 ) {
//            $this->table->load($this->id);
//            return $this->table;
//         }
        return $this->user;
    }
   
    function setState(JRegistry $data) {
        $this->user->bind($data->toArray());
        $this->user->save();
        return $this->user->id;
    }
    
    function deleteRow() {
        //return $this->table->delete($this->id);
        return $this->user->delete();
    }
    

    
    
        
}
?>