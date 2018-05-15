<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.com
# Technical Support: http://www.e-logism.gr/index.php?main_page=contact_us&zenid=5q08u7hbg8f4eitc4hb8dfmlq5
 
----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );

class EditItem extends JModelDataBase{
   
    private static $formPath = null; 
    private $table = '';
    
    public function __construct() {
        JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
    }
 
    protected function getFormPath() {
        if(self::$formPath == null) {
            self::$formPath = JPATH_COMPONENT . '/models/forms/';
        }
        return self::$formPath;        
    }   
    
    protected function getTableName() {
        return $this->table;
    }
    
    protected function setTableName($table) {
        $this->table = $table;
    }
    
    protected function getTable() {
        
    }
    
}

?>
