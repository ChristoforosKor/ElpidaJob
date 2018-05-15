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
class JTableJob extends JTable {
    var $id = null;
    var $idUser = null;
    var $idSpeciality = null;
    var $idDegreeLevel = null;
    var $idJobState = null;
    var $idCounty = null;
    var $idHour = null;
    var $idMedicalCare = null;
    var $idOldPeople = null;
    var $submitState = null;
    var $minExperience = null;
    var $jobCost = null;
    var $jobSalary = null;
    var $daysOff = null;
    var $extUrl = null;
    
    function __construct($db) {
        parent::__construct( '#__elg_ergasia_job', 'id', $db );
    } 
}
