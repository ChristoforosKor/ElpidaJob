<?php

namespace  ELG\Component\ElgJobs\Site\View\Personnel;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
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

/**
 * View for Jobs
 * @since  0.0.1
 */
class HtmlView extends BaseHtmlView {
    protected $timeZone;
    protected $userTimeZone;

    /**
     * Display the view
     *
     * @param   string  $template  The name of the layout file to parse.
     * @return  void
     */
    public function display($template = null) {
       
        $app = Factory::getApplication();
        $offset = Factory::getConfig() -> get('offset');
        $this -> timeZone = new \DateTimeZone( $offset );
        $this -> userTimeZone = Factory::getUser() -> getTimeZone();
        $groups = Factory::getUser() -> getAuthorisedGroups();
        if ( in_array(12, $groups) ) {
                $this -> isAuthorised = 1;
        }
        else {
                $this -> isAuthorised = 0;
        }
        $input = $app -> input;
        $model = $this -> getModel();
        $likes = $model ->getState('com_elgjobs.notify.likes') ;
        $this -> id = $input -> getInt('id',0);
        if ( $likes !== null){
            if ( in_array( $this -> id, array_keys($likes) ) ) {
                $this -> canLike = false;
            }
            else {
                $this -> canLike = true;
            }
        }
        else {
             $this -> canLike = true;
        }
        
        $item = $model -> getItem($this -> id);
        $this -> comments = $model -> getComments($this -> id);
        
      

        /**
         * @todo Τα λεκτικά από μετάφραση και να μπει το speciality
         * 
         * */
        
          
        if ( $item ['speciality'] !== '' ) {
            $item['specialities'] = array_unique( array_filter(  explode(',', $item['speciality']) ) );
        }
        else{
            $item['specialities'] = [];
        }
          
        if ( $item['hour'] !== '' ) {
            $item ['candidateHours'] = array_unique( array_filter(  explode(',', $item['hour']) ) );
        }
        else {
            $item ['candidateHours'] = [];
        }
      
        if ( $item['specialNeed'] !== '' ) {
            $item ['specialNeeds'] = array_unique( array_filter(  explode(',', $item['specialNeed']) ) );
        }
        else {
            $item ['specialNeed'] = [];
        }
        
            
            /**
             * @todo Να ελέγξω αν οι ειδικές ανάγκες υπάρχουν στη λίστα των αγγελίων.
             * 
             */
             
          
                              
            $this -> item = $item ;
            
       
       
        // Call the parent display to display the layout file
        parent::display($template);
    }

    
    public function getTimeText($dateString) {
      
        $d2 = new \DateTime();
        $d2 -> setTimezone($this -> userTimeZone);        
        $d = new \DateTime($dateString);
        $d->setTimezone($this -> timeZone);
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