<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
require 'controllerview.php';

class ElgergasiaControllerJobs extends ElgergasiaControllerControllerView{
    public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'idUser'=> array('INT', 0),
            'idIndustry'=> array('INT',0),
            'jobTitle'=> array('STRING', ''),
            'idJobState'=> array('INT', 2),
            'idSpeciality'=> array('INT', 0),
            'id'=> array('INT', 0),
            'jobSalary' => array('INT', 0),
            'jobSalaryTo' => array('INT', 0),
            'idOldPeople' => array('INT', 0),
            'daysOff' => array('INT', 0),
            'daysOffTo' => array('INT', 0),
            'idMedicalCare' => array('INT', 0),
            'idHour' => array('INT', 0),
            'id' => array('INT', 0),
            'submitDate' => array('STRING', ''),
            'submitDateTo' => array('STRING', ''),
            'employer' => array('STRING', ''),
            'idCounty' => array('INT', 0)            
        );
        parent::__construct($input, $app);
        $this->setRequestedValues();
        $this->setList('jobTitle');
    }
  
    protected function setSessionNamespace() {
        parent::setSessionNamespace();
        $this->sessionNamespace .= '.quicksearch.data';
    }
}
