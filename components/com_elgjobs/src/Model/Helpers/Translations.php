<?php
/**
 * @copyright (c) 2014-2030, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
namespace  ELG\Component\ElgJobs\Site\Model\Helpers;
defined( '_JEXEC' ) or die( 'Restricted access' );
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Factory;
 
 
 /**
  * Library model for content translation routines.
  * @package e-logism.libraries.joomla;
  * @subpackage models
  * @author Christoforos J. Korifidis
  * 
  * @version 1.1
  */
  
 class Translations extends BaseDatabaseModel { 
     
     
     /**
      * Removes the default flag from a tuple 
      * @param String $relation The name of the table we want to remove the defailt flag.
      * @param mixed $idEntity The id of the parent row of the translation.
      * @param String $attribute The name of the column of the $idEntity
      * @param JDatabase $db The databases. If is null we use the default database object.
      */
     private static function removeDFFromDB($relation, $idEntity, $attribute, $db = null ) {
         if($db == null) {
             $db = Factory::getDbo();
         }
         $query = $db->getQuery(true);
         $query->update($relation)->set( "isDefault = 0")->where($db->quoteName($attribute) . " = " . $db->quote($idEntity));
         $db->setQuery($query);
         $db->execute();
     }
     
     
     /**
      * Stores translation data to db.
      * @param String $relation The name of the table we want to store translation data.
      * @param int $idEntity The id of the parent row of the translation
      * @param String $attribute The name od the columenf of the $idEntity
      * @param array $data The actual data of the translation
      * @param JDatabase $db The database object. If it is null we use the default database object.
      */
     public static function saveTranslation($jtablename, $relation, $idEntity, $attribute, $data, $db = null) {
         if($db == null) {
             $db = Factory::getDbo ();
         }
         $table = JTable::getInstance($jtablename);
         $data[$attribute] = $idEntity;
         $query = $db->getQuery(true);
         $query->select($attribute .', language, isDefault, isAutoTranslated')->from($relation)->where($attribute . '=' . $idEntity);
         $db->setQuery($query);
         $oldTranslations = $db->loadObjectList();
         $oldCount = count($oldTranslations);
         $oldDef = '';
         
         for($i = $oldCount -1; $i >=0; $i --) {
             
             if($oldTranslations[$i]->isDefault == 1 ) {
                 $oldDef = $oldTranslations[$i]->language;
                 break;
             }
         }
         if($data['language'] == 'en-GB') 
         {
             $data['isDefault'] = 1;
             self::removeDFFromDB($relation, $idEntity, $attribute, $db);
         }
         elseif($data['language'] == 'el-GR')
         {
            
            if($oldDef != 'en-GB' && $oldDef != 'el-GR')
            {
                $data['isDefault'] = 1;
                self::removeDFFromDB($relation, $idEntity, $attribute, $db);
            }
         }
         elseif($data['language'] == Factory::getUser()->get('language'))
         {
             if($oldCount == 0)
             {
                 $data['isDefault'] = 1;
                 self::removeDFFromDB($relation, $idEntity, $attribute, $db);
             }
         }
         $table->bind($data);
         $table->store();        
     }
     
     public static function getTranslatedLanguages($table, $id, $field, $db = null ) {
         if ( $id === null ) {
             $id = 0;
         }
         if($db == null) {
             $db = Factory::getDbo ();
         }
         $query = $db->getQuery();
         $query->clear();
         $query->select("language")->from($table)->where($field . "=" . $id . ' and isAutoTranslated = 0' );
        
         $db->setQuery($query);
         $res = $db->loadColumn();
         return $res;
         
     }
     
}