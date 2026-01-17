<?php

class modElgErgasiaJobLastHelper
{
    public static function getData()
    {
        $lang = JFactory::getLanguage()->getTag();
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select("id, ifNull(jt.jobTitle, jd.jobTitle) as jobTitle,  submitDate")
                ->from("#__elg_ergasia_job j")
                ->leftJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language = '" . $lang . "'" )
                ->leftJoin("#__elg_ergasia_job_translation jd on j.id = jd.idJob and jd.isDefault = 1" )
                ->where("idJobState = 2")
                ->group("ifNull(jt.jobTitle, jd.jobTitle), submitDate")
                ->having("id = max(id)");

        $db->setQuery($query);
        $data = $db->loadObject();
        if($data == null)
        {
                $data->id =0;
                $data->jobTitle= '';
                $data->submitDate='1900-01-01';
        }				
        return $data;
    }
}
?>