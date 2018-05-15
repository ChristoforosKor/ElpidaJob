<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 * JTable class for cleaning data
 *
 * @author e-logism
 */
class JTableCleaning extends JTable {
    var $id = null;
    var $fullname = null;
    var $address = null;
    var $telephone = null;
    var $email = null;  
    var $area_description = null;
    var $idExtraInfo = null;
    var $idCleaningFrequency = null;
    var $idCleaningStart = null;
    var $idBuying = null;
    var $idCommunicationTime = null;
   
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_cleaning', 'id', $db );
    } 
}

?>
