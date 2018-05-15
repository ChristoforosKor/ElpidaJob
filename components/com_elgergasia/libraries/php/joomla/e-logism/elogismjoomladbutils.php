<?php
/**
 * General Joomla DB utitlies .<br/>
 * @author Christoforos J. Korifidis
 * @copyright (c) e-logism 2013-2015. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

require_once JPATH_COMPONENT_SITE . '/libraries/php/phputils.php';

class JoomlaDBUtils extends PHPUtils
{
    /**
     * Get a JDatabaseQuery object cleared or new from a JDatabaseDriver
     * @param JDatabaseDriver $db The JDataabseDriver to generate JDatabaseQuery object.
     * @return JDatabaseQuery
     */
    public static function getQuery ($db)
    {
        $query = $db->getQuery();
        if( ! is_object( $query ))
        {
            $query = $db->getQuery( true );               
        }
        else
        {
            $query->clear();
        }
        return $query;
    }
        
    /**
     * Returns a JDatabaseQuery object that is already assigned on a JDatabaseDriver object. The JdatabaseQuery object is obtained through @see getQuery
     * @param JDatabaseDriver $db The JDatabase object on which the query is assigned.
     * @return JDatabaseQuery  
     */
    public static function getDBQuery( $db )
    {
        $query = self::getQuery( $db ); 
        $db->setQuery ( $query );
        return $query;
    }
    
    /**
     * Returns filters that can be applied to a JDatabaseQuery object accorfingly to thew rules setted on the $filters parameter
     * @param JDatabaseDriver $db The database driver we want to use so we can quote properly the filters elements.
     * @param Array $filters. An array with filters to apply on a JDatabaseQuery. Each row in the array is a differnet filter. Currently supported format of the array is : 
     *  ['filterKey'] =>
     *  array(
     *      'fieldName' => fieldName 
     *      'value' => value
     *      'operand' => operand (it may be '=', 'in' etc common where clause operands. Deafults to '=').
     *  ). The fitlerKey is optional.
     * @param boolean $preserveKey Eahc row in the array filter mau have a key name. We can preserve this key in the results if weset this parmeter to true. By doing this if we had a filters array in eth form ['f1' => ['fieldName' => field1, 'value'=> value1] , 'f2' => ['fieldName' => field2, 'value' = value] ] the resulting array will be [ 'f1' => clause1, 'f2' => 'clause2'].  
     * @return Array. The array with the where clauses according to the filters given.
     */
    public static function getWhereClauses ($db, $filters = [], $preserveKey = false)
    {
        $where = [];      
        foreach( $filters as $key => $filter): 
            $operand = (isset ($filter ['operand']) ? $filter ['operand'] : '=' ); 
            $clause =  $db->quoteName( $filter ['field'] ) . ' ' . $operand;
            if(stripos ($operand, 'in') !== false ):
                $clause .= ' (' . $filter ['value'] . ')';
            elseif($operand === 'between'):
                $clause .= ' ' .$db->quote($filter['value'][0]) . ' and ' . $db->quote($filter['value'][1]);
            else:
                $clause .= ' ' . $db->quote ($filter ['value'] );
            endif;
            if ($preserveKey):
                $where [$key] = $clause;
            else:
                $where [] = $clause;
            endif;            
        endforeach;
        unset($filter);       
        return $where;   
    }
    
    /**
     * Returns a where clause accordingly the results of @see getWhereClauses. 
     * @param String $db @see getWhereClauses.
     * @param Array $filters @see getWhereClauses.
     * @return String . The where clause.
     */
    public static function getWhereClause ($db, $filters = [])
    {
        return implode (' and ', self::getWhereClauses ($db, $filters));
    }
    
    
    /**
     * Return database results as an associative array filtered according to $filters parameter. The filtering is done using @see getWhereClause
     * @param JDatabaseDriver $db @see getWhereClause.  
     * @param JDatabaseQuery $query The JDatabaseQuery to use without filters
     * @param Array $filters @see getWhereClause.
     * @param String $key The key to use as a key on each row of loadAssocList 
     * @return Array. Associative array with results of the query optionally keyd with the $key parameter.
     */
    public static function loadAssocListWF ($db, $query, $filters = [], $key = null)
    {
        $where = self::getWhereClause ($db, $filters);
        if ($where !== ''):
            $query -> where ($where);
        endif;
        return $db -> loadAssocList ($key);
    }
    
    
    
    
    
    
    
    
    
   
    
    
    
    
    
    
    
    
}

    