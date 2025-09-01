<?php
namespace  ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use ELG\Component\ElgJobs\Site\Model\ListParams;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use ELG\Component\ElgJobs\Site\CommonUtils;

class JobsModel extends ListModel {

    private $listParams;
    private $commonUtils;
    
    public function __construct($config = array(), MVCFactoryInterface $factory = null) {
       $config['filter_fields'] = ['submitDate', 'stateChangedDate', 'jobSalary', 'daysOff'];
       parent::__construct($config, $factory);
       $this -> commonUtils = new CommonUtils();
       $this -> getListParamsWithValues();
       
    }
    
//    public function getItems() {
     public function getListQuery() {
        $input = Factory::getApplication() -> input;
//        $langTag = Factory::getLanguage()->getTag();
//        $db = $this -> getDbo();
        $this -> listParams = new ListParams( $input -> get("list",[], "ARRAY") );
        $fullOrder = $this -> listParams -> getOrdering();
        if ($fullOrder === 'created desc') {
            $fullOrder = ' j.submitDate desc ';
        }
        elseif ($fullOrder === 'modified desc') {
            $fullOrder = ' j.stateChangedDate desc ';
        }
        else {
            $fullOrder = ' j.id desc ';
        }
//        echo $fullOrder;
//        exit;
        $db = $this ->getDbo();
        $langTag = Factory::getLanguage()->getTag();
        $quotedLangTag =  $db -> quote($langTag);
        $orderCol = $this -> getState('list.ordering', 'j.id'); // $this->state->get('list.ordering', 'cd.id');
        $orderDir = $this -> getState('list.direction', 'desc');
       
        $query = $db->getQuery(true);
        $query -> from("#__elg_ergasia_job j")
        -> innerJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language =  " . $quotedLangTag)
        -> innerJoin("#__elg_ergasia_employer emp on emp.id = j.idEmployer")
        -> leftJoin("#__elg_ergasia_hour_translation ht on j.idHour = ht.idHour and ht.LANGUAGE = " . $quotedLangTag )
        -> leftJoin("#__elg_ergasia_medicalcare_translation mc on mc.idMedicalCare = j.idMedicalCare and mc.language = " . $quotedLangTag)
        -> leftJoin("#__elg_ergasia_speciality_translation spt on spt.idSpeciality  = j.idSpeciality and spt.language = " . $quotedLangTag)
        -> innerJoin("#__elg_geo g on g.id = j.idGeo")
        -> leftJoin ("#__elg_ergasia_jobstates jst on jst.id = j.idJobState and jst.language = " . $quotedLangTag )
//        -> order ( 'idJobState asc,  ' . $orderCol . "  " . $orderDir );
        -> order ($fullOrder);
        
        $where = $this -> getWhere($db, $langTag);
        if ( $where !== '') {
          $query -> where ( $where );
        }
     
        if ( $this -> commonUtils -> isOfficeUser() ) {
            $query->select(" j.id, j.submitDate, j.stateChangedDate, j.idJobState, jst.jobState, j.daysOff, j.submitDate, group_concat(ht.`hour`) as `hour`, j.jobSalary, mc.medicalCare, jt.jobTitle as title"
                . ", jt.jobDescription as description, spt.speciality, jt.jobCity, g.lat, g.lng "
                . ",j.areasize, j.idSpeciality, submitDate,emp.DiscreteTitle, ifnull(emp.Telephone,'') as Telephone, "
                ."ifnull(emp.Mobile,'') as Mobile, emp.Fax, ifnull(emp.email,'') as email, "
                ."ifnull(emp.EmpArea,'') as EmpArea, ifnull(emp.EmpAddress,'') as EmpAddress, ifnull(emp.Zip, '') as Zip");
        
            $query -> group( "j.id, j.submitDate, j.stateChangedDate, j.idJobState, jst.jobState, j.daysOff, j.submitDate, j.jobSalary, mc.medicalCare, jt.jobTitle, jt.jobDescription, spt.speciality"
                . ", g.lat, g.lng, jt.jobCity, j.idSpeciality,j.areasize, j.idSpeciality, submitDate,emp.DiscreteTitle, emp.Telephone, emp.Mobile, emp.Fax, emp.email, emp.EmpArea, emp.EmpAddress, emp.Zip" );
        }
        else {
            $query->select(" j.id, j.submitDate, j.stateChangedDate, j.idJobState, j.idJobState, jst.jobState, j.daysOff, j.submitDate, group_concat(ht.`hour`) as `hour`, j.jobSalary, mc.medicalCare, jt.jobTitle as title"
                . ", jt.jobDescription as description, spt.speciality, jt.jobCity, g.lat, g.lng "
                . ",j.areasize, j.idSpeciality, submitDate ");
            $query -> group( "j.id, j.submitDate, j.stateChangedDate, j.idJobState, jst.jobState, j.daysOff, j.submitDate, j.jobSalary, mc.medicalCare, jt.jobTitle, jt.jobDescription, spt.speciality"
                . ", g.lat, g.lng, jt.jobCity, j.idSpeciality,j.areasize, j.idSpeciality, submitDate" );
        }

        return $query;

    }
    
    
    public function getListParamsWithValues() {
      
        $stateVars = get_object_vars( $this ->getState() );
        // var_dump($stateVars);
        $params = [];
        forEach(array_keys($stateVars) as $key ) {
            if ( (strpos($key, 'filter.') === false && strpos($key, 'list.') === false ) || empty($stateVars[$key]) ) {
                continue;
            }
            $params[$key] = $stateVars[$key];            
            
        }
        
        $this -> setState('listParamsWithValue', $params);
        unset($key);
    }
    
    
    public function getCities() {
        $langTag = Factory::getLanguage()->getTag();
        $db = $this -> getDbo();
        $query = $db->getQuery(true);
        $query -> select ("distinct jt.jobCity as section")
                -> from ("#__elg_ergasia_job j")
                -> innerJoin ( "#__elg_ergasia_job_translation jt on jt.idJob = j.id and jt.language = " . $db -> quote ( $langTag ) )
                -> order("jt.jobCity");
        return  $db -> setQuery($query)  -> loadObjectList();
        
    }
    
     
    public function getSpecialities() {
            
        $langTag = Factory::getLanguage()->getTag();
        $db = $this -> getDbo();
        $query = $db->getQuery(true);
        $query -> select("distinct sj.idSpeciality, sj.speciality") 
                -> from ("#__elg_ergasia_job j")
                -> innerJoin ("#__elg_ergasia_speciality_translation sj on j.idSpeciality= sj.idSpeciality 
                    and sj.language = " . $db -> quote($langTag) . " and j.idJobState = 2 ");
//         echo $query -> dump();
        return $db -> setQuery($query) -> loadObjectList();
    }
    

    
        
    
    private function getSizeFilter($selectedSizes) {
        $min = 0;
        $max = 0;
        // switch ( min( $selectedSizes ) ) {
        switch (  $selectedSizes  ) {
            case 2: $min = 60;
                break;
            case 3 : $min = 80;
                break;
            case 4: $min = 100;
                break;
            case 5 : $min = 140;
                break;
            case 6: $min = 180;
                break;
            case 7: $min = 220;
                break;
        }
        
        // switch ( max( $selectedSizes ) ) {
        switch (  $selectedSizes  ) {
            case 1: $max = 60;
                break;
            case 2 : $max = 80;
                break;
            case 3: $max= 100;
                break;
            case 4 : $max = 140;
                break;
            case 5: $max = 180;
                break;
            case 6: $max = 220;
                break;
        }
        

        return  $min . " <=  j.areasize  " . ( $max > 0 ? " and j.areasize <= " . $max : "") ; 
        
    }
    
    
    public function getDistanceFilter($selectedDistances) {
        /**
         * @todo //   37.980453, lng: 23.7337859 this coordinates takne from user current location.
         */
        
        $max = 0;
      
        // switch ( max( $selectedDistances ) ) {
        switch (  $selectedDistances  ) {
            case 2 : $max = 10;
                break;
            case 3: $max = 20;
                break;
            case 3 : $max = 50;
                break;
        }
        if ( $max > 0 ) {
            // return ' ST_DISTANCE(GeomFromText("Point(37.980453, 23.7337859"), geoPoint ) < ' . $max ; 
            return ' (st_distance_sphere(Point(23.7337859,37.980453), geoPoint )/1000) <= ' . $max ; 
        }
        return '';
    }
    
    
    private function getWhere($db, $langTag) {
        $stateVars = get_object_vars($this ->getState() );
        $whereClauses = [];
        if ( !$this -> commonUtils ->isOfficeUser()) {
            $whereClauses[] = " j.idJobState = 2 ";
        }
        
        
         // $filters["jobstate"] = " j.idJobState = 2 ";
         forEach(array_keys($stateVars) as $key ) {
            if ( !is_string($key ) ) {
                continue;
            }
            if ( strpos($key, 'filter.') === false) {
                continue;
            }
            
            switch ( $key ) {
                case 'filter.types' :
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " j.idSpeciality  = " . $this ->getSpecialityId($db, $this -> getState($key), $langTag);
                    }
                    break;
                case 'filter.locations':
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " j.jobCity  = '" . $this -> getState($key) . "'";
                    }
                    break;
                case 'filter.employers':
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " j.idEmployer  = " . $this ->getEmployerId($db, $this -> getState($key), $langTag);
                    }
                    break;
                case 'filter.hourFilter': 
                    if (  count( $this -> getState($key) ) > 0 ) {
                        $whereClauses[] = " j.idHour  in ( " . implode(',', $this -> getState($key) ) . " )";
                    }
                    break;
                case 'filter.sizeFilter':
                    if ( $this -> getState($key)   !=='' ) {
                        $whereClauses[] = $this -> getSizeFilter(  $this -> getState($key) );
                    }
                    break;
                case 'filter.distanceFilter' :
                    if ( $stateVars[$key] !== '') {
                        // $whereClauses[] = " (st_distance_sphere(POINT(0,0), cb.pt)/1000) <= " . $this -> commonUtils -> getDistanceKm($stateVars[$key]);
                        $distanceFilter = $this ->getDistanceFilter($stateVars[$key]);
                        if ( $distanceFilter !== '') {
                            $whereClauses[] = $distanceFilter;
                        }
                    }
                    break;
                case 'filter.DiscreteTitle' :
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " emp.DiscreteTitle  like '%" . $this -> getState($key) . "%'";
                    }
                    break;
                case 'filter.VatNo' :
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " emp.VatNo  like '%" . $this -> getState($key) . "%'";
                    }
                    break;
                case 'filter.EmpAddress' :
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " emp.EmpAddress  like '%" . $this -> getState($key) . "%'";
                    }
                    break;
                case 'filter.specialNeeds' :
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " j.idSpecialNeed  in (" . implode(',', $this -> getState($key) ) . ')' ;
                    }
                    break;
                }
            }
            unset($key);
            return implode(" and ", $whereClauses );
            
         }
        
        
        
       
        
        
        
//        
//        $hours = array_filter($input -> get("hour", [], "ARRAY"));
//        if ( count( $hours ) > 0 ) {
//            $filters['hours']= " j.idHour in (" .implode(",", $hours ) . ") ";
//        }
        
//        $sizes = array_filter($input -> get("size", [], "ARRAY"));
//        if ( count( $sizes ) > 0 ) {
//            $filters['sizes']  = $this -> getSizeFilter( $sizes );
//        }
               
//        $distances = array_filter($input -> get("dist", [], "ARRAY"));
//        if ( count( $distances ) > 0 ) {
//            $filters['distances'] = $this -> getDistanceFilter($distances);
//        }
        
        
//        $specialities = array_filter($input -> get("spec", [], "ARRAY"));
//        if ( count( $specialities ) > 0 ) {
//            $filters['specialities'] = " j.idSpeciality in (" . implode(",", $specialities) . " ) ";
//        }
//        
//        $locations = array_filter($input -> get("loc", [], "ARRAY"));
//        if ( count( $locations ) > 0 ) {
//            $filters['locations'] =  " jt.jobCity in ('" . implode("', '", $locations ) . "' ) ";
//        }
//       
//        $type = $input -> get("type", 0, 'INT');
//        
//        if ( $type > 0) {
//            $filters['types'] = " j.idType = " . $type;
//        }
//        
//        return implode( " and ", $filters );
        
        
//    }
    
    
    
    
    public function getOrdering() {
        
        $orderType = $this -> listParams ->getOrdering();
       
        
        
        switch ($orderType){
            
            /**
             * @todo Find a way to order by distance
             * 
             * case 2: distance
             */
            case 3: 
                return ' jobSalary desc ';
            case 4: 
                return ' jobSalary asc ';
            case 5: 
                return ' areasize asc ';
            case 6: 
                return ' areasize asc ';
            default: 
                return ' submitDate desc '; // this is also case 1 which is the default.
        }
        
           
    }
    
      
    protected function getSpecialityId($db, $speciality, $langTag) {
        $query = $db -> getQuery(true);
        $query -> select("idSpeciality") -> from ("#__elg_ergasia_speciality_translation") 
                -> where ("speciality = " . $db -> quote($speciality ). "  and language = " . $db -> quote($langTag) );
        $result = $db -> setQuery($query) -> loadResult();
        if ( $result > 0) {
            return $result;
        }
        else {
            return 0;
        }
    }
    
    protected function getSectionId($db, $location, $langTag) {
        $query = $db -> getQuery(true);
        
        $query -> select("idSection") -> from ("#__elg_section_translation") 
                -> where ("section = " . $db -> quote($location ). "  and language = " . $db -> quote($langTag) );
        return $db -> setQuery($query) -> loadResult();
    }
    
    protected function getEmployerId($db, $employer, $langTag) {
        $query = $db -> getQuery(true);
        $query -> select("id") -> from ("#__contact_details") 
                -> where ("name = " . $db -> quote($employer ). "  and language = " . $db -> quote($langTag) );
        // echo $query->dump();exit;
        $result = $db -> setQuery($query) -> loadResult();
        // var_dump($result);exit("edw");
        if ( $result > 0) {
            return $result;
        }
        else {
            return 0;
        }
    }


}
