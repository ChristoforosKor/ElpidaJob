<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 * JTable class for employee's personal data
 *
 * @author e-logism
 */
class JTableErgasiaUser extends JTable {
        
    
    function store($updateNulls = false) {
        $res = parent::store($updateNulls);
        
        $lt = JTable::getInstance('lastupdates');
        $lt -> load( ['idUser' => $this -> idUser]);
        if($lt -> idUser == 0):
            $lt -> idUser = $this -> idUser;      
        endif;
        $lt -> datemodified = date('Y-m-d H:i');
        $lt -> store();
        
        return $res;
    }
    
    public function insertWithUniqueKey()
    {
        return $this->_db->insertObject($this->_tbl, $this, $this->_tbl_keys[0]);
    }
    
    public function storeWithKey($pKValue)
    {
        if( $this ->getDbo() -> setQuery("select $this->getKeyName() from  $this->getTableName() where $this->getKeyName() = $pKValue")->loadResult() != ''):
            $this -> store();
        else:
            $this -> insertWithUiqueKey();
        endif;
    }
        
    
}
