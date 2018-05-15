<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 * JTable class for job photo
 *
 * @author e-logism
 */
class JTableJobPhoto extends JTable {
    var $id = null;
    var $idJob = null;
    var $idPhotoType = null;
	var $jobPhoto = null;	
    var $photoExtension = null;
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_job_photo', 'id', $db );
    } 
}

?>
