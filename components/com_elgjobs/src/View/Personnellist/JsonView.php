<?php

namespace  ELG\Component\ElgJobs\Site\View\PersonnelList;

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
    
  
    
    public function display($template = null ) {
        $this -> initializeView();
        $model = $this -> getModel();
        $task = $model -> getState('task');
       
        if ( $task === 'select2') {
            $ret = $this -> select2();
        }
        else
        {
              $ret = $this ->Devex();  
              
        }
        
        echo json_encode($ret, JSON_NUMERIC_CHECK);
    }
    
    public function Devex() {
       
        $input = Factory::getApplication() -> input;
        $model = $this -> getModel();
        $list = $model -> getItems();
       
        $this -> user = Factory::getUser(); 
      

        /**
         * @todo Τα λεκτικά από μετάφραση και να μπει το speciality
         * 
         * */
        
        $data = [];
        foreach ( $list as $item ) {
            if ( $item -> speciality !== '' ) {
                $item -> specialities = array_unique( array_filter(  explode(',', $item -> speciality) ) );
            }
            else{
                $item -> specialities = [];
            }

            if ( $item -> hour !== '' ) {
                $item -> candidateHours = array_unique( array_filter(  explode(',', $item -> hour) ) );
            }
            else {
                $item -> candidateHours = [];
            }

            if ( $item -> specialNeed !== '' ) {
                $item -> educationTitles = array_unique( array_filter(  explode(',', $item -> specialNeed) ) );
            }
            else {
                $item -> specialNeed = [];
            }
            $item -> img = '/' . $item -> image;
            $item -> isActive = true;
            $item -> fullyAvailable = true;
            $item -> likes = 36;
            $item -> timeToReply = "1'";
            $item -> base64 = base64_encode($item -> image);
            $data[] = $item;
        }
        $pagination = $model -> getPagination() -> getListFooter();
           
        $ret =  ['data' => $data, 'paging' => $pagination];
        // var_dump($ret);
            
       return $ret;   
          
                              
            
//       echo json_encode($ret, JSON_NUMERIC_CHECK);
        // Call the parent display to display the layout file
//        parent::display($template);
    }
    
     private function select2() 
    {
        $ret = new \stdClass();
        $ret -> data = $this -> items;
        $ret -> totalCount = 100; //$this -> pagination -> total;
        
        return $ret;
    }
 
}