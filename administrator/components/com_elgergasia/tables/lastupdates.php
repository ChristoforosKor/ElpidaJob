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
            
class JTableLastUpdates extends JTable {
   
    var $idUser = null;
    var $datemodified = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_lastupdates', 'idUser', $db );
    } 
}
