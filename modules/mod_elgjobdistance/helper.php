<?php

use Joomla\CMS\Factory;

class modJobDistanceHelper
{
    public static function getData(  )
    {
        $langTag = Factory::getLanguage()->getTag();
        $data = new stdClass();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query->select("dt.idDistance, dt.distance")
                ->from("#__elg_ergasia_distance d")
                ->innerJoin("#__elg_ergasia_distance_translation dt on d.id = dt.idDistance "
                        . "and d.state = 1 and dt.language = " . $db->quote($langTag))
                ->order("d.ordering");
		
                return $data;
    }
}