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
  
 
 class ElgergasiaModelJob extends JModelDatabase{ 

 
   
    
    public function __construct($state = null, $db = null) {
        parent::__construct($state, $db);
    }   
    
    function getState() {
        $state = parent::getState();
        $id = $state->get('id');
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $query->select("id, idUser, payment, paydate")->from("#__elg_ergasia_payment")->where("id = " . $id);
        $db->setQuery($query);   
        $data = $db->loadObject();
        if (!isset($data)) {
            $data = $this->getNullObject();
        }
        $state->set('itemData', $data);
        return $state;
    }
    

    function getNullObject() {
        $nullObject = '{ "id": "0" , "idUser": "", "payemnt" : "", "paydate" : "" }';
        return json_decode($nullObject);
    }
   
    
 
//    public function setState(\JRegistry $state) {
//     
//        if(  !is_numeric($state->get('id')) ) {
//            $state->set('id',0);
//        }
//        if(!is_numeric($state->get('idUser')) ) {
//            $state->set('idUser',0);
//        }
//        parent::setState($state);
//    }
}
?>