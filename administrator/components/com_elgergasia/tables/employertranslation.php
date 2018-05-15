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
class JTableEmployerTranslation extends JTable {
    var $idEmployer = null;
    var $salutation = null;
   
    var $discreteTitle = null;
    var $city = null;
    var $address = null;
   
   
   
    var $taxOffice = null;
    var $information = null;
    var $language = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_employer_translation', array('idEmployer', 'language'), $db );
    } 
}

?>
