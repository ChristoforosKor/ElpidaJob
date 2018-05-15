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
class TableJobs extends JTable {
    var $id = null;
    var $idUser = null;
    var $idSpeciality = null;
    var $idDegreeLevel = null;
    var $idJobState = null;
    var $idCounty = null;
    var $submitState = null;
    var $minExperience = null;
    var $jobTitle = null;
    var $jobDescription = null;
    var $language = null;
    var $jobCost = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_jobs', 'id', $db );
    } 
}

?>
