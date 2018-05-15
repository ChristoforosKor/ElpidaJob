<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
require_once JPATH_COMPONENT_ADMINISTRATOR . '/tables/ergasiauser.php';
/**
 * JTable class for employee's experience data
 *
 * @author e-logism
 */

class JTableCandidateSpokenLanguage extends JTableErgasiaUser {
    var $id = null;
    var $idCandidate = null;
    var $idRank = null;
       
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_spokenlanguage', 'id', $db );
    } 
}

?>
