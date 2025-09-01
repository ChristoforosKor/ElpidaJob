<?php
namespace  ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use ELG\Component\ElgJobs\Site\CommonUtils;

        
class   PersonnellistModel extends ListModel {

    private $commonUtils;
    private $isAuthorised = false;
    public function __construct($config = array(), MVCFactoryInterface $factory = null) {
       $config['filter_fields'] = ['modified', 'created', 'lastOfficeVisit'];
       parent::__construct($config, $factory);
       $this -> commonUtils = new CommonUtils();
       $user = Factory::getApplication()->getIdentity();
       $this -> getListParamsWithValues();
        if ($user != null && in_array(12, $user->getAuthorisedGroups())) {
            $this->isAuthorised = true;
        } 
       
    }


    public function getListQuery() {
        $db = $this ->getDbo();
        $query = $db -> getQuery(true);

     
        $langTag = Factory::getLanguage()->getTag();
        $quotedLangTag =  $this -> getDbo() -> quote($langTag);
        $orderCol = $this -> getState('list.ordering', 'cd.id'); // $this->state->get('list.ordering', 'cd.id');
        $orderDir = $this -> getState('list.direction', 'desc'); //$this->state->get('list.direction', 'desc');
       
        $select = " distinct cd.id,  cd.name, cd.sortname1 as lastname,cd.sortname2, cd.misc, ifNull(cd.address, '') as address , /*cbt.city,*/ GROUP_CONCAt( cst.speciality) as speciality, GROUP_CONCAT( ht.hour ) as hour"
                . ", GROUP_CONCAT(snt.specialNeed) as specialNeed, cd.image, X(cb.pt) as lng , Y(cb.pt) as lat, cd.published as idState, "
                . "b64.base64Encode, cd.telephone, cd.postcode, cd.image";
        $group = "cd.id, cd.name, cd.misc, cd.address, cd.published, cd.image, b64.base64Encode, cd.telephone, cd.postcode, cd.image";
        
        if ($this->isAuthorised)
        {
            $select .= ", cb.lastOfficeVisit";
            $group .= ", cb.lastOfficeVisit";
        }
    
        $query  ->  select($select)
                -> from ("#__contact_details cd") 
                -> innerJoin (" #__elg_ergasia_candidate_basic cb on cd.id = cb.idContact")
                -> leftJoin("#__elg_ergasia_candidate_basic_translation cbt on cb.id = cbt.idCandidateBasic and cbt.language=" . $quotedLangTag)
                -> leftJoin ("#__elg_ergasia_candidate_preferencesspecialities cs on cd.id = cs.idContact")
                -> leftJoin ("#__elg_ergasia_speciality_translation cst on cst.idSpeciality = cs.idSpeciality and cst.language = " . $quotedLangTag )
                -> leftJoin ("#__elg_ergasia_candidates_hours ch on ch.idContact = cd.id") 
                -> leftJoin ("#__elg_ergasia_hour_translation ht on ht.idHour = ch.idHour and ht.language =  " . $quotedLangTag )
                -> leftJoin("#__elg_ergasia_candidates_sectionspreferences sp on sp.idContact = cd.id")
                -> leftJoin ("#__elg_ergasia_candidate_photo_base64 b64 on b64.idContact = cd.id")
                -> leftJoin("#__elg_ergasia_candidate_team ct on ct.idContact = cd.id")
//                -> leftJoin ("#__elg_ergasia_candidate_education ce on ce.idContact = cd.id") 
//                -> leftJoin ("#__elg_ergasia_candidate_education_translation cet on cet.idCandidateEducation = ce.id and cet.language =  " . $quotedLangTag )
                -> leftJoin("#__elg_ergasia_candidate_specialneeds sn on cd.id = sn.idContact")
                -> leftJoin("#__elg_ergasia_specialneeds_translation snt on sn.idSpecialNeed = snt.idSpecialNeed")
                ->leftJoin("#__categories cat on cat.id = cd.catid and cd.catid =44 ")
                -> group($group)
                -> order( $orderCol . "  " . $orderDir);
                
        $where = $this -> getWhere($db, $langTag);
        if ( $where !== '') {
          $query -> where ( $where );
        }
//        echo $query -> dump();
//exit;
        return $query;
    }
    
    
    public function getListParamsWithValues() {
      
        $stateVars = get_object_vars( $this ->getState() );
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
    
    protected function getWhere($db, $langTag) {
         
        $whereClauses = [];
       
       
//        if ($user != null && !in_array(12, $user->getAuthorisedGroups())) {
        if (!$this->isAuthorised)
        {
            $whereClauses[] = 'cd.published = 1 ';
        } 
       
        $stateVars = get_object_vars($this ->getState() );
        
        forEach(array_keys($stateVars) as $key ) {
            if ( !is_string($key ) ) {
                continue;
            }
            if ( strpos($key, 'filter.') === false) {
                continue;
            }
            switch ( $key ) {
                
                case 'filter.id':
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = "  cd.id =  " . $this-> getState($key);
                    }
                    break;
                case 'filter.name' : 
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " ( cd.name  like '%" . $this-> getState($key) . "%' or cd.sortname1  like '%" . $this-> getState($key) . "%' ) ";
                    }
                    break;

                case 'filter.filter_nationality' : 
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " cb.idNationality  = " . $this ->getNationalityId($db, $this -> getState($key), $langTag);
                    }
                    break;

                case 'filter.telephone' : 
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " cd.mobile  like '%" . $this-> getState($key) . "%' ";
                    }
                    break;
                case 'filter.types' : 
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " cs.idSpeciality  = " . $this ->getSpecialityId($db, $this -> getState($key), $langTag);
                    }
                    break;
                case 'filter.locations':
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " cd.suburb like '%" . $this-> getState($key) . "%' ";
                    }
                    break;
                case 'filter.hourFilter': 
                    if (  count( $this -> getState($key) ) > 0 ) {
                        $whereClauses[] = " ch.idHour  in ( " . implode(',', $this -> getState($key) ) . " )";
                    }
                    break;
                case 'filter.specialNeeds': 
                    if (  $this -> getState($key) !== '') {
                        $whereClauses[] = " sn.idSpecialNeed in ( " . implode(',', $this -> getState($key) ). " )";
                    }
                    break;
                case 'filter.distanceFilter' :
                    if ( $stateVars[$key] !== '') {
                        
                        $whereClauses[] = " (st_distance_sphere(POINT(0,0), cb.pt)/1000) <= " . $this -> commonUtils -> getDistanceKm($stateVars[$key]);
                        break;
                    }
                case 'filter.candidateState' : 
                    if ($stateVars[$key] === '1') {
                        $whereClauses[] =  "cd.published = 1";
                    }
                    elseif ($stateVars[$key] === '0') {
                        $whereClauses[] =  "cd.published !=1 ";
                    }
                    break;
                case 'filter.candidateTeam' : 
                    if ($stateVars[$key] === '1') {
                        $whereClauses[] = "ct.idContact is not null";
                    }
                    break;
                case 'filter.candRef' :
                    if ($stateVars[$key] !== '') {
                        $whereClauses[] = "cb.idRecommentation = " .  $stateVars[$key];
                    }
                    break;
                case 'filter.candIns' :
                    if ($stateVars[$key] !== '') {
                        $whereClauses[] = "cb.idInsurance = " .  $stateVars[$key];
                    }
                    break;
                case 'filter.lastOfficeVisit' :
                    if ($stateVars[$key] !== '') {
                        $whereClauses[] = "cb.lastOficeVisit >= " .  $db->quote($stateVars[$key]);
                    }
              
            }
        }
        unset($key);
        
        return implode(" and ", $whereClauses );
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

    protected function getNationalityId($db, $nationality, $langTag) {
        $query = $db -> getQuery(true);
        $query -> select("idCountry") -> from ("#__elg_country_translation") 
                -> where ("country = " . $db -> quote($nationality ). "  and language = " . $db -> quote($langTag) );
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
    
//    protected function setQueryRules() {
//        $this -> _query ['filter.types'] = ['cs.idSpeciality', '= %b'];
////        $this -> _query ['filter.location'] = ['cb.pt', ' = st_distance(%F, %F, %F)']; //home, x, y
//        $this -> _query ['hourFilter'] = ['ch.idHour', ' in ( %s ) '];
////        $this -> _query ['sizeFilter]'] = [$this -> getState('filter.sizeFilter', '')];
//        $this -> _query ['filter.distanceFilter'] = ['cb.pt', ' = st_distance(%F, %F, %F)'];
//        $this -> _query ['filter.specialNeeds'] = ['', ' in (%s)'];
//    }
    
  
           
//    public function getWhereRows($db) {
//      
//        
//        
//        $state = $this -> getState();
//      
//        $whereParts = [];
//        forEach( get_object_vars($state) as $key ) {
//           
//            $whereRows[str_replace('filter,', '', $key)] = $db -> quote( $state -> get($key) ) ; 
//    }
        
        
        
//        
////        $filter['types'] = $this -> getState("filter.types", '');
////        $filter['location'] = $this -> getState("filter.location", '');
////        
////        $filter['hourFilter'] = $this -> getState("filter.hourFilter", []);
////        $filter['sizeFilter]'] = $this -> getState('filter.sizeFilter', '');
////        $filter['distanceFilter'] = $this -> getState('filter.distanceFilter', '');
////        $filter['distanceFilter'] = $this -> getState('filter.distanceFilter', '');
////        $filter['specialNeeds'] = $this -> getState('filter.specialNeeds', []);
//        return implode(" and ",     array_map(function ($key, $value) use ( $db ) {
//            return [$key => ( is_string( $value ) ? $db -> quote ($value) : $value ) ];
//        }, array_keys($filters), $filters));            
//    }

   
    
    
//   s protected function makeWhere($filterMap)
    
    public function getSections() {
        $langTag = Factory::getLanguage()->getTag();
        $db = $this -> getDbo();
        $query = $db->getQuery(true);
        $query -> select ("distinct st.idSection, st.section")
                -> from ("#__elg_ergasia_candidates_sectionspreferences sp ")
                -> innerJoin ( "#__elg_section_translation st on st.idSection = sp.idSection and st.language = " . $db -> quote ( $langTag ) )
                -> order("st.section");
//        echo 
        return  $db -> setQuery($query)  -> loadObjectList();
        
    }
    
     
    public function getSpecialities() {
            
        $langTag = Factory::getLanguage()->getTag();
        $db = $this -> getDbo();
        $query = $db->getQuery(true);
        $query -> select("distinct st.idSpeciality, st.speciality") 
                -> from ("#__elg_ergasia_candidate_preferencesspecialities ps")
                -> innerJoin ("#__elg_ergasia_speciality_translation st on ps.idSpeciality= st.idSpeciality 
                    and st.language = " . $db -> quote($langTag))
                -> order("speciality");
        return $db -> setQuery($query) -> loadObjectList();
    }
    
    
    public function getCandits() {
        $name = $this->getState('name');
        $db = $this -> getDbo();
        $query = $db-> getQuery(true);
        $query -> select('name')
               -> from("#__contact_details")
               -> where('name like ' . $db->quote("%$name%"))
               -> order('name');
        return $this->db->setQuery($query)->loadObjectList();
    }
}
