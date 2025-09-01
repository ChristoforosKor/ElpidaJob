<?php

namespace  ELG\Component\ElgJobs\Site\View\Job;

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
    

    /**
     * Display the view
     *
     * @param   string  $template  The name of the layout file to parse.
     * @return  void
     */
    public function display($template = null) {
       
        $input = Factory::getApplication() -> input;
        $model = $this -> getModel();
        $item = $model -> getItem($input -> getInt('id',0));
		$groups = Factory::getUser() -> getAuthorisedGroups();
        if ( in_array(12, $groups) ) {
			$this -> isAuthorised = 1;
		}
		else {
			$this -> isAuthorised = 0;
		}
        $this -> form = $model -> getForm( $item );

        /**
         * @todo Τα λεκτικά από μετάφραση και να μπει το speciality
         * 
         * */
      
            $item -> specs = [];
            
//            if ( $item -> speciality != '') {
//                $item -> specs ['speciality'] = ['Ειδικότητα', $data -> speciality];
//            }
//            
            if ( $item -> hour != '') {
                $item -> specs ['hour'] = ['Είδος απασχόλησης', $item -> hour];
            }
            
            if ( $item -> city != '' ) {
                $item -> specs ['city'] = ['Περιοχή', $item -> city];
            }
            
            if ( $item -> areasize != '') {
                $item -> specs['areaSize'] = ['Μέγεθος Σπιτιού', $item -> areasize . "τμ"];
            }
            
            if ( $item -> jobSalary != '' ) {
                $item -> specs ['jobSalary'] = ['Αμοιβή', $item -> jobSalary . "€"];
            } 
            
            if ( $item -> daysOff != '') {
                $item -> specs['daysOff'] = ['Ρεπό', $item -> daysOff . " ρεπό/μήνα"];
            }
            
            /**
             * @todo Να ελέγξω αν οι ειδικές ανάγκες υπάρχουν στη λίστα των αγγελίων.
             * 
             */
             
            if ( $item -> specialNeed != '') {
                $item -> specs['specialNeed'] = ['Ειδικές Ανάγκες', $item -> specialNeed];
            }
                              
            $this -> item = $item ;
            
       
       
        // Call the parent display to display the layout file
        parent::display($template);
    }

}
