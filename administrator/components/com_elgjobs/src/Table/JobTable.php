<?php

/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013-2030 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */

namespace ELG\Component\ElgJobs\Administrator\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class JobTable extends Table {

    var $id = null;
    var $idUser = null;
    var $idJobState = null;
    var $idJobSpeciality = null;
    var $idJobSpecialneed = null;
    var $idHour = null;
    var $jobSalary = null;
    var $daysOff = null;
    var $idEmployer = null;
    
//    var $idDegreeLevel = null;    
//    var $idCounty = null;
//    var $idHour = null;
//    var $idMedicalCare = null;
//    var $idOldPeople = null;
//    var $submitState = null;
//    var $minExperience = null;
//    var $jobCost = null;
//    var $jobSalary = null;
//    
//    var $extUrl = null;

    public function __construct(DatabaseDriver $db) {
        parent::__construct('#__elg_ergasia_job', 'id', $db);
    }

}
