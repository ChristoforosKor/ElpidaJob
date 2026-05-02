<?php
use Joomla\CMS\Factory;
class JobSpecialNeedsHelper {

    public static function getData() {
        
        $langTag = Factory::getLanguage()->getTag();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select(" idSpecialNeed, specialneed") 
                ->from("#__elg_ergasia_specialneeds_translation ")
                ->where(" language = " . $db -> quote($langTag) );   
                // echo $query->dump();exit;    
        return $db->setQuery($query)->loadObjectList();
    }

}
