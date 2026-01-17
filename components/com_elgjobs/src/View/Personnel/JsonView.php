<?php

namespace  ELG\Component\ElgJobs\Site\View\Personnel;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonView as BaseView;
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

class JsonView extends  BaseView {
    
  
    
    public function display($template = null ) {
        
        $model = $this -> getModel();
        $task = $model -> getState('task');
       
        if ( $task === 'deleteFile') {
            $ret = $this -> select2();
        }
        else
        {
              $ret = $this ->Devex();  
              
        }
        
        echo json_encode($ret, JSON_NUMERIC_CHECK);
    }
    
 
 
}