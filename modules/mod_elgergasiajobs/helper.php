<?php

use Joomla\CMS\Factory;


class modHelloWorldHelper
{
    public static function getData( $idSpeciality )
    {
		$data = new stdClass();
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
        $query->select("count(*) as cnt")->from("#__elg_ergasia_job")->where("idSpeciality = " . $idSpeciality . " and idJobState = 2");
       // echo $query->dump();
        $db->setQuery($query);
		$result = $db->loadResult();
		$data->cnt = ($result == null ? 0 : $result);        
		$query->clear();
		$query->select("speciality")->from("#__elg_ergasia_speciality_translation")->where("idSpeciality = " . $idSpeciality . " and language='" . Factory::getLanguage()->getTag() . "'");
		$result = $db->loadResult();
		$data->speciality = ($result ==null ? '' : $result);
		return $data;
    }
}
?>