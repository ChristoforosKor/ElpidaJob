<?php

use Joomla\CMS\Factory;
use ELG\Component\ElgJobs\Site\Model\ParamsFilters;

/**
 * @todo Να πάρω των κώδικα για τα χαρακηριστικά από εδώ όταν θα φτιάξω τις λεπτομέρειες της αγγελίας.
 */
class TypesFilterHelper {

    public static function getData() {
        
        $paramsFilters = new ParamsFilters();
        $cities = array_column($paramsFilters -> getCities(), 'jobCity');
        $specialities = $paramsFilters -> getSpecialities();
        $citiesPersonnel = array_column($paramsFilters -> getCitiesPersonnel(), 'suburb');
        $specialitiesPersonnel = $paramsFilters -> getSpecialitiesPersonnel();
        
        $document = Factory::getDocument();
        
        $document -> addScriptDeclaration(" var specialities  = " . json_encode($specialities)
                . ";\n var locations = " . json_encode($cities) 
                . ";\n var types = specialities.map(item => item.speciality)"
                . " \n .sort()"
                . ";\n var locationsPersonnel =  " . json_encode($citiesPersonnel) 
                . ";\n var specialitiesPersonnel = " . json_encode($specialitiesPersonnel)
                . ";\n var typesPersonnel =  specialitiesPersonnel.map(item => item.speciality ) "
                . ";\n var comJobsSearchEndPoint = '/aggelies.html?view=jobs'; var comPersonnelSearchEndPoint = '/search-personnel.html?view=personnellist'; var listParams=''; " );
        
    }

    
    
}
