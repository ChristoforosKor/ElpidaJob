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
class TableEmployeesBasic extends JTable {
    var $id = null;
    var $idUser = null;
    var $language = null;
    var $idCountry = null;
    var $city = null;
    var $address = null;
    var $postalCode = null;
    var $phone = null;
    var $mobile = null;
    var $fax = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_employees_basic', 'id', $db );
    } 
}

?>
