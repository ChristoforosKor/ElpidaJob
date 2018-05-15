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
            
class JTableCandidateBasic extends JTableErgasiaUser {
    var $id = null;
    var $idUser = null;
    var $idCountry = null;
    var $idState = null;
    var $postalCode = null;
    var $phone = null;
    var $mobile = null;
    var $fax = null;
    var $showPhoto = null;
    var $showName = null;
    var $useMyData = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_basic', 'id', $db );
    } 
}

?>
