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
class TableCandidatesPhotos extends JTable {
    var $id = null;
    var $idUser = null;
    var $idPhotoType = null;
    var $photo = null;
    var $photoExtension = null;
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_photos', 'id', $db );
    } 
}

?>
