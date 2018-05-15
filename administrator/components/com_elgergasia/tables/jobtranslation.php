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
class JTableJobTranslation extends JTable {
    var $idJob = null;
    var $language = null;
    var $jobTitle = null;
    var $jobDescription = null;
    var $jobComment = null;
    var $isDefault = null;
    var $isAutoTranslated = null;
    
    
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_job_translation', array('idJob', 'language'), $db );
    } 
}

?>
