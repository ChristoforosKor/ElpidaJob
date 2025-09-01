<?php

namespace  ELG\Component\ElgJobs\Site\View\Jobs;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
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

class DevexView extends BaseJsonView {
    
    
    public function display($template = null) {
       
        $model = $this -> getModel();
        $list = $model -> getItems();
        $total = $model -> getTotal();
        $globalOffset = Factory::getConfig() -> get('offset');
        $globalTimeZone = new \DateTimeZone( $globalOffset );
        $userTimeZone = Factory::getUser() -> getTimeZone();
        
	
        echo json_encode($list, JSON_NUMERIC_CHECK);
       
    }
    
}
