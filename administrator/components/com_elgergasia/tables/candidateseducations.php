<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 * JTable class for employee's experience data
 *
 * @author e-logism
 */

class TableCandidatesEducations extends JTable {
    var $id = null;
    var $idCandidate = null;
    var $educationTitle = null;
    var $educationInstitute = null;
    var $idDegreeLevel = null;
    var $yearFrom = null;    
    var $yearTo = null;    
    var $language = null;
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_education', 'id', $db );
    } 
}

?>
