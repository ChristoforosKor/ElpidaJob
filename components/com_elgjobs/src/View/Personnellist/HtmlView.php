<?php

namespace  ELG\Component\ElgJobs\Site\View\Personnellist;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\ListView;
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

/**
 * View for Jnbs
 * @since  0.0.1
 */
class HtmlView extends ListView {
    

    
    /**
     * Display the view
     *
     * @param   string  $template  The name of the layout file to parse.
     * @return  void
     */
    public function display($template = null) {
         
        $this->initializeView();
        
        // Call the parent display to display the layout file
        $model = $this -> getModel();
        $this->fullOrdering = $model->getState('list.fullordering');
        $paramsWithValues = $model -> getState('listParamsWithValue');
        // var_dump($paramsWithValues);exit;
        $paramsFilters = new ParamsFilters();
        
        $citiesPersonnel = array_column($paramsFilters -> getCitiesPersonnel(), 'suburb');
        $specialitiesPersonnel = $paramsFilters -> getSpecialitiesPersonnel();
        // $nationalitiesPersonnel = $paramsFilters ->getNationalities();
        $nationalitiesPersonnel = array_column($paramsFilters -> getNationalities(), 'country');
        
        
        $this -> document -> addScriptDeclaration("var listParams= " . json_encode($paramsWithValues) . "; var specialitiesPersonnel  = " 
                . json_encode($specialitiesPersonnel). "; types =  specialitiesPersonnel.map(item => item.speciality ) ; var locations = " 
                . json_encode($citiesPersonnel) . "; var nationality = " . json_encode($nationalitiesPersonnel) );

        
        $this -> user = Factory::getUser(); 
        
        parent::display($template);
    }
    
    public function addToolbar(){}
    
//    protected function getFiltersJs($state) {
//        $state
//    }

}