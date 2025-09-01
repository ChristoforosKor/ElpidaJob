<?php
namespace ELG\Component\ElgJobs\Site\Libs\Model;   



class DevexFiltersFiltering {

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

    
    
    public function getWhereClause() {
       
        $queryMapping = $this -> getQueryMapping($this -> query);
        $whereClause = '';
        $logicalOperand = '';
        
        
        forEach($this -> filters as $filterData) {

            if (  $filterData === "and" || $filterData === "or"   ) {
                $logicalOperand = $filterData;
                continue;
            }
            

            
            if ( isset( $this -> customFunctions[ $filterData[0] ] ) ) {
                $filterFunction = $this -> customFunctions[ $filterData[0] ];
                if ( isset ( $filterFunction[2] ) ) {
                    $filterOperation = call_user_func ( [ $filterFunction[0], $filterFunction[1] ], $filterFunction[2] );
                }
                else {
                    $filterOperation = call_user_func ( [ $filterFunction[0], $filterFunction[1] ] );
                }
            }
            elseif ( is_array($filterData) ) {
                $filterName = $this -> getFilterNameWithPrefix($filterData[0] , $queryMapping, $this -> db );
                if ( $filterName == null ) {
                    $filterOperation = '';
                }
                else {
                    $filterOperation = $filterName . $this -> getOperandSection($filterData[1], $filterData[2], $this -> db );
                }
            }
            
            if ( $filterOperation == '' ) {
                $logicalOperand = '';
                continue;
            }
            $whereClause .= " " . $logicalOperand . " " . $filterOperation;
        }
        unset($filterData);
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
    
    
    private function getQueryMapping(JDatabaseQuery $query) {
     
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
