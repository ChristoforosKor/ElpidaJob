<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 *
 * @author e-logism
 */

class TableCandidatesHours extends JTable {
    var $id = null;
    var $idCandidate = null;
    var $idUser = null;
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidates_hours', 'id', $db );
    } 
}

?>
