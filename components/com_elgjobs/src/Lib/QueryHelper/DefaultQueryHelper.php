<?php
namespace ELG\Component\ElgJobs\Site\Lib\QueryHelper;   
use ELG\Component\ElgJobs\Site\Interfaces\IQueryHelper;
use Joomla\Database\DatabaseQuery;

class DefaultQueryHelper implements IQueryHelper {

    private $filters;
    private $db;
    private $query;
    private $customFunctions;
    private $specifications;
    
       
    /**
     * 
     * @param Array $filters  The filters collected from DevExtreme grid.
     * @param JDatabaseDriver $db The Database connection.
     * @param JDatabaseQuery $query The query for which we are going to construct the where clause.
     * @params Array  $specifications Explicit associations of request filters with db columns
     * @param Array $customFunctions Custom functions we want our query clause to have.
     * The format of the array is [filedName => function]. It will override any other function or operand 
     * for the filed with the fieldName.
     */
    public function __construct($filters, $db, $query, $specifications = [],  $customFunctions = []) {
        $this -> filters = $filters;
        $this -> db = $db;
        $this -> query = $query;
        $this -> customFunctions = $customFunctions;
        $this -> specifications = $specifications;
    }

    
    protected function getWhere($db, $langTag) {
        $stateVars = get_object_vars($this ->getState() );
        $whereClauses = ['cd.published = 1 '];
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
    
            }
        }
        unset($key);
    
        return implode(" and ", $whereClauses );
    }
    
    
    
    public function getWhereClause() {
       
        $queryMapping = $this -> getQueryMapping($this -> query);
        $whereClause = '';
        
        
        forEach($this -> filters as $key => $filterData) {

            if ( ! str_contains($key, "filter.") ) {
                continue;
            }
            $whereClause .=  str_replace('filter.', '', $key)  . " like '%" . $filterData  . "%'";
            
        }   
        unset($filterData);
        unset($key);
        return $whereClause;
        
    }
    
    
    private function getOperandSection($operand, $value, $db) {
        if ( $operand === "contains" ) {
            return " like " . $db -> q("%" . $value . "%");
        }
        
        return " " . $operand . " " . $db -> q ( $value );
    } 
    
    
    private function getFilterNameWithPrefix( $filter, $map, $db ) {
        if( isset( $map [ $filter ] ) ) {
            if ( $map[ $filter ] !="") {
                return $db -> quoteName ( $map[ $filter ]  );
            }
        }
        return null;
    }
    
    
    private function getQueryMapping(DatabaseQuery $query) {
     
        $normSelect = "";
        $elms = [];
        forEach( $query -> __get("select") -> getElements() as $elm ) {
           $normSelect  .=   preg_replace( "/\s+/", " ", str_replace(  "`", "", $elm ) ) ;
        }
        
        $output_array = [];
        $t =  preg_replace( "/\s+/", " ", str_replace(  "`", "", $normSelect ));
        preg_match_all( "/\w*\.\w*/", $t, $output_array);
        $map = [];
       
        forEach ( $output_array[0] as $item) {
        
            $mapItem = $this -> getMapItem(
                    $this -> getNameAndPrefix( explode(".", $item ) )
            );
            
            $map[ $mapItem[0] ] = $mapItem[1];
        }
        return $map;
    }
    
    
    private function getNameAndPrefix($selectItemParts) {
        if ( count($selectItemParts) == 2 ) {
            return [$selectItemParts[1], $selectItemParts[0] . "." . $selectItemParts[1]];
        }
        return [$selectItemParts[0], ""];
        
    }
    
    private function getMapItem($nameAndPrefix) {
        if ( isset($this -> specifications[$nameAndPrefix[0] ] ) ) {
            return [$nameAndPrefix[0], $this -> specifications[ $nameAndPrefix[0] ] . "." . $nameAndPrefix[0] ];
        }
        return $nameAndPrefix;
    }
       
 }
