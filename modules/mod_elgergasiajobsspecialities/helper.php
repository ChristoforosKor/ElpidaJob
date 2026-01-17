<?php
require_once JPATH_SITE . '/components/com_elgergasia/models/datautils.php';
class modElgErgasiaJobsSpecialitiesHelper
{
    public static function getData()
    {
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->clear();
        $db->setQuery($query);
        $query->select('st.idSpeciality, st.speciality, slug,  count(*) as cnt')
        ->from('#__elg_ergasia_job j')
        ->innerJoin('#__elg_ergasia_speciality_translation st on j.idSpeciality = st.idSpeciality  and idJobState = 2 and st.language = \'' . JFactory::getLanguage()->getTag() . '\'')
        ->group('st.idSpeciality,speciality, slug')
        ->order('cnt desc');
	    $query->setLimit(5);
        $data->data = $db->loadRowList();
        $mItemid = DataUtils::getLanguageItemid($db, 201, jFactory::getLanguage()->getTag());        
        $data->Itemid = $mItemid;
        return  $data;
    }
}