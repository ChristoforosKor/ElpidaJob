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
require JPATH_COMPONENT_ADMINISTRATOR . '/tables/translation.php';
            
class JTableCandidateBasicTranslation extends JTableTranslation {
    var $idCandidateBasic = null;
    var $city = null;
    var $address = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_basic_translation', array('idCandidateBasic', 'language'), $db );
    } 
}

?>
