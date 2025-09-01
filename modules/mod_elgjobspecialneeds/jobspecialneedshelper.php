<?php

class JobSpecialNeedsHelper {

    public static function getData() {
        
        $langTag = JFactory::getLanguage()->getTag();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select(" idSpecialNeed, specialneed") 
                ->from("#__elg_ergasia_specialneeds_translation ")
                ->where(" language = " . $db -> quote($langTag) );   
                // echo $query->dump();exit;    
        return $db->setQuery($query)->loadObjectList();
    }

}
