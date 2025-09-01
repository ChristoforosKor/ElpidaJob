<?php

class JobHoursHelper {

    public static function getData() {
        $langTag = JFactory::getLanguage()->getTag();
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("ht.idHour, ht.hour")
                ->from("#__elg_ergasia_hour h")
                ->innerJoin("#__elg_ergasia_hour_translation ht on h.id = ht.idHour "
                        . "and h.state = 1 and ht.language = " . $db->quote($langTag))
                ->order("h.ordering");
        return $db->setQuery($query)->loadObjectList();
    }

}
