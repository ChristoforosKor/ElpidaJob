<?php

class JobSizeAreaHelper {

    public static function getData() {
        $langTag = JFactory::getLanguage()->getTag();
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("id, areasize")
                ->from("#__elg_ergasia_areasize")
                ->order("ordering");
        return $db->setQuery($query)->loadObjectList();
    }

}
