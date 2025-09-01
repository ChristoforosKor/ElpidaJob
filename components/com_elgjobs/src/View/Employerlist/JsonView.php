<?php

namespace  ELG\Component\ElgJobs\Site\View\EmployerList;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\ListView;
use Joomla\CMS\Factory;


/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 * 
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence.
 *
 */

class JsonView extends ListView {
    public function display($template = null) {
        
        $this -> initializeView();
       
        $model = $this -> getModel();
        $task = $model -> getState('task');
        if ( $task === 'Devex') {
            $ret = $this ->Devex();
        }
        else
        {
            $ret = $this -> select2();
        }
        
        
        echo json_encode($ret);
    }
 
    private function Devex() {
        $ret = new \stdClass();
        $ret -> data = $this -> items;
        $ret -> totalCount = $this -> pagination -> total;
        $idsEmployers = array_column($ret -> data, 'id');
        $employersDetails = $this -> getModel() -> getEmployerDetails($idsEmployers);
        $ret -> employersDetails = $employersDetails;
        for ( $i = count( $ret -> data) -1; $i > -1; $i --) 
        {
            $idCurrentEmployer = $ret -> data[$i] -> id;
            $detailItems = array_filter($employersDetails, function($item) use ( $idCurrentEmployer ) 
            {
                return ( $item -> idEmployer === $idCurrentEmployer );
            });
            $ret -> data [$i] -> details = array_values($detailItems); 
                    /*
                    array_values (
                    array_map( function($item){
                        $item -> documentFilePath =  str_replace(JPATH_SITE, '', $item -> documentFilePath ) ;
                        return $item;
                        
            }, $detailItems )); */
        }
        return $ret;
    }
    
    
    private function select2() 
    {
        $ret = new \stdClass();
        $ret -> data = $this -> items;
        $ret -> totalCount = $this -> pagination -> total;
        return $ret;
    }
    
}