<?php
use Joomla\CMS\Factory;
class JobSizeAreaHelper {

    public static function getData() {
        $langTag = Factory::getLanguage()->getTag();
        $data = new stdClass();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select("id, areasize")
                ->from("#__elg_ergasia_areasize")
                ->order("ordering");
        return $db->setQuery($query)->loadObjectList();
    }

}
