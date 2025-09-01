<?php
namespace  ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use ELG\Component\ElgJobs\Site\CommonUtils;
use ELG\Component\ElgJobs\Site\Lib\QueryHelper\DevexQueryHelper;
use Joomla\Registry\Registry;
use ELG\Component\ElgJobs\Site\Interfaces\IQueryHelper;
        
class   EmployerlistModel extends ListModel {

    private $commonUtils;
   
    
    public function __construct($config = array(), MVCFactoryInterface $factory = null) {
       /**
        * @todo Automate the population of filter_fields through the select clause of the query.
        */
       $config['filter_fields'] = ['modified', 'created', 'id', 'DiscreteTitle', 'EmpArea'
           , 'EmpAddress', 'Zip', 'Telephone', 'Mobile', 'Fax', 'Email', 'TaxNo', 'EmployerType'];
       parent::__construct($config, $factory);
       $this -> commonUtils = new CommonUtils();
       $app         = Factory::getApplication();
      
//       $this -> getListParamsWithValues();
       
    }

    
//    protected function populateState($ordering = null, $direction = null) {
//        parent::populateState($ordering, $direction);
//        $filters = $app->getUserStateFromRequest($this->context . '.filter', 'filter', array(), 'array')
//    }
//    

    public function getListQuery() {
        
        $orderCol = $this -> getState('list.ordering', 'DiscreteTitle'); 
        $orderDir = $this -> getState('list.direction', 'asc'); 
      
        $db = $this -> getDbo();
        $query = $db -> getQuery(true);
        $query  ->  select(" e.id, e.idEmployerType, e.idIndustry, e.Profession, e.DiscreteTitle, e.EmpArea, e.EmpAddress, e.Zip, e.Telephone, e.Mobile, e.Fax, e.Email, e.WebPage, e.TaxNo,e.TaxOffice, e.Comments")
                -> from ("#__elg_ergasia_employer e") 
                -> order( $orderCol . "  " . $orderDir);        
        $state = $this -> getState();
       
        $stateProps = $this -> getState() -> getProperties();
        $queryHelper = self::createQueryHelper(
                $this -> state -> get('task', 'Default'),
                $stateProps,
                $db,
                $query,
                [],
                []
                );        
        
//        $queryHelper =  new DevexQueryHelper($stateProps, $db, $query, [], []);
        if ( $queryHelper === null ){
            return $query;
        }
               
        $where = $queryHelper -> getWhereClause();
        if ( $where === '') {
            return $query;
        }
        
        $query -> where ($where);
        
        return $query;
    }
    
    
    public static function createQueryHelper($helperName, $stateProperties, $db, $query, $specifications, $customFunctions) {
        $className = 'ELG\\Component\\ElgJobs\\Site\\Lib\\QueryHelper\\' . $helperName . 'QueryHelper'; 
        if (class_exists($className)) {
            $class = new $className($stateProperties, $db, $query, $specifications, $customFunctions);
            return  $class;
        }
        $className = 'ELG\\Component\\ElgJobs\\Site\\Lib\\QueryHelper\DefaultQueryHelper';
        return new $className($stateProperties, $db, $query, $specifications, $customFunctions);
               
    }
    
      
    
    
       
    
    public function getEmployerDetails(array $idsEmployer)
    {
        if ( count($idsEmployer) < 1) {
            return [];
        }
        $db = $this -> getDbo();
        $query = $db -> getQuery(true);
        $query -> select ( "distinct j.submitDate, jt.jobTitle, jd.documentFilePath, jd.idEmployer, jd.id, jd.idJob")
               -> from ("#__elg_ergasia_employer_jobdocument jd") 
               -> leftJoin ("#__elg_ergasia_employer e on e.id = jd.idEmployer " )
               -> leftJoin ("#__elg_ergasia_job j on jd.idJob = j.id ")
               -> leftJoin ("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language = 'el-GR'")
               -> where("jd.idEmployer in (" . implode(",", $idsEmployer) .  ")");
        return $db ->setQuery($query) -> loadObjectList();
                
    }
    
    public function getIndustries() {
        $query  = $this ->getDbo() ->getQuery(true);
        $query -> select ("idIndustry, industry") 
                -> from ("#__elg_ergasia_industry_translation")
                -> where (" language = 'el-GR' and idIndustry > 0")
                -> order ("industry");
        return $this ->getDbo() ->setQuery($query) -> loadObjectList();
        
    }
    
    public function getCountries() {

        $query  = $this ->getDbo() -> getQuery(true);
        $query -> select ("idCountry, country")
              -> from ("#__elg_country_translation")
              -> where ("language = 'el-GR'  and idCountry > 0")
              -> order ("country");
        return $this ->getDbo() ->setQuery($query) -> loadObjectList();

    }
    
    
}
