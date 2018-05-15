<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
require_once JPATH_COMPONENT_ADMINISTRATOR . '/tables/ergasiauser.php';
/**
 * JTable class for employee's personal data
 *
 * @author e-logism
 */
class JTableEmployer extends JTableErgasiaUser {
    var $id = null;
    var $idUser = null;
   
    var $idCountry = null;
    var $idIndustry = null;
   
   
   
    var $website = null;
    var $postalcode = null;
    var $phone = null;
    var $mobile = null;
    var $fax = null;
    var $taxNumber = null;
   
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_employer', 'id', $db );
    } 
}

?>
