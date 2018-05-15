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

class ElgergasiaControllerSuggestions extends ElgergasiaControllerControllerView{
    
    public function execute() {
//        $input = $this->getInput();
//        $this->request['filters']['idUser'] = trim($input->getInt('idUser', 0));
//        $this->request['filters']['idIndustry'] = trim($input->getInt('idIndustry', 0)) ;
//        $this->request['filters']['jobTitle'] = trim($input->getString('jobTitle', '')) ;
//        $this->request['filters']['idJobState'] = trim($input->getInt('idJobState', 0)) ;
//        $this->model->setState(new JRegistry($this->request));
        parent::execute();
    }    
}
?>
