<?php

namespace  ELG\Component\ElgJobs\Site\View\Jobs;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use ELG\Component\ElgJobs\Site\Model\ParamsFilters;

/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 * 
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence.
 *
 */

class HtmlView extends BaseHtmlView {
    
    protected $timeZone;
    protected $userTimeZone;
    
   public function display($template = null) {
       
        $offset = Factory::getConfig() -> get('offset');
        $this -> timeZone = new \DateTimeZone( $offset );
        $this -> userTimeZone = Factory::getUser() -> getTimeZone();
       
        $model = $this -> getModel();
        $this->fullOrdering = $model->getState('list.fullordering');
        $paramsWithValues = $model -> getState('listParamsWithValue');
        $paramsFilters = new ParamsFilters();
        $cities = array_column($paramsFilters -> getCities(), 'jobCity');
        $specialities = $paramsFilters -> getSpecialities();      
        // $employers = array_column( $paramsFilters-> getEmployers(), 'discreteTitle');
        $employers = array_column( $paramsFilters-> getEmployers(), 'name');
        $this -> document -> addScriptDeclaration("var listJobParams= " . json_encode($paramsWithValues) . ";" );
        $this -> document -> addScriptDeclaration(" var specialities  = " . json_encode($specialities) . ";  
                                                    var types = specialities.map(item => item.speciality); 
                                                    var locations = " . json_encode($cities) . "; 
                                                    var employers  = " . json_encode($employers) . ";");
                // . "; var specialities = specialities.map(item => item.speciality) "
                // . "; var comJobsSearchEndPoint = '/aggelies.json'; var listParams=''; " );
//                 . "; var comJobsSearchEndPoint = '/index.php?option=com_elgjobs&view=jobs&format=json'; var listParams=''; " );
//        $this -> document -> addScript("/media/com_elgjobs/js/searchJob.js?ver=2");
          $this -> user = Factory::getUser(); 
        parent::display($template);
    }
    
    
    public function getTimeText($dateString) {
      
        $d2 = new \DateTime();
        $d2 -> setTimezone($this -> userTimeZone);        
        $d = new \DateTime($dateString);
        $d2 -> setTimezone($$this -> userTimeZone);
        $d->setTimezone($timeZone);
        $interval = $d->diff($d2);
        $timeText = '';
            
            if ($interval->m > 1) {
                $timeText = $interval->m ." μήνες ";
            } elseif ($interval->m > 0) {
                $timeText = "1 μήνας ";
            } elseif ($interval->d > 1) {
                $timeText = $interval->d ." ημέρες ";
            } elseif ($interval->d > 0) {
                $timeText = "1 ημέρα ";
            } elseif ($interval->h > 1) {
                $timeText = $interval->h . " ώρες ";
            } else {
                $timeText = " τελευταία ώρα";
            }
        return $timeText;
    }
}