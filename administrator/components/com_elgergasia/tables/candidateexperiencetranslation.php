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
class JTableCandidateExperienceTranslation extends JTable {
    var $idCandidateExperience = null;
    var $employerTitle = null;
    var $jobDescription = null;
    var $isDefault = null;
    var $isAutoTranslated = null;
      
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_candidate_experience_translation',  array('idCandidateExperience', 'language'), $db );
    } 
}

?>
