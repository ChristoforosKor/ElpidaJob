<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );
require 'controllerview.php';

class ElgergasiaControllerEmployers extends  ElgergasiaControllerControllerView {
   
    public function __construct($input = null, $app = null) {
        $this->requestedKeys = array(
            'idSearch'=> array('INT', 0),
            'nameSearch'=> array('STRING',''),
            'idIndustry'=> array('INT', 0),
            'discreteTitle'=> array('STRING', ''),
            'profession'=>  array('STRING', ''),
            'website' => array('STRING', ''), 
            'email' => array('STRING', ''),
            'idCountry' => array('INT', 0),
            'city' => array('STRING', ''),
            'postalCode' => array('STRING', ''), 
            'address' => array('STRING', ''),
            'taxOffice' => array('STRING', ''),
            'taxNumber' => array('STRING',''),
            'phone' => array('STRING',''),
            'datemodified'=>array('STRING', ''),
            'limitstart'=>array('INT',0),
            'limit'=>array('INT', 15)
        );
        parent::__construct($input, $app);
        $this->setRequestedValues();
        $this->setList('employerName');
    }
  
    protected function setSessionNamespace() {
        parent::setSessionNamespace();
        $this->sessionNamespace .= '.quicksearch.data';
    }
        
}
?>
