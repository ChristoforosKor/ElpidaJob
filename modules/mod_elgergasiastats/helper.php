<?php

class modElgErgasiaJobStatsHelper
{
    public static function getData()
    {
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("count(*)")
                ->from("#__elg_ergasia_job")
                ->where("idJobState = 2");
        $db->setQuery($query);
		$result = $db->loadResult();
		$data->jobs = ($result == null ? 0: $result);
		
		$query->clear();
		$query->select("count(*)")
                ->from("#__elg_ergasia_candidate_basic");                
        $db->setQuery($query);
		$result = $db->loadResult();
		$data->candidates = ($result == null ? 0: $result);
		
		$query->clear();
		$query->select("count(*)")
                ->from("#__elg_ergasia_employer");                
        $db->setQuery($query);
		$result = $db->loadResult();
		$data->employers = ($result == null ? 0: $result);
		
 
        return $data;
    }
}
?>