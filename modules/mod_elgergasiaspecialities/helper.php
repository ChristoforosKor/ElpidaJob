<?php
require_once JPATH_SITE . '/components/com_elgergasia/models/datautils.php';
class modElgErgasiaSpecialitiesHelper
{
    public static function getData()
    {
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->clear();
        $db->setQuery($query);
        $query->select('st.idSpeciality, speciality, slug,  count(*) as cnt')
        ->from('#__elg_ergasia_candidate_preferencesspecialities ps')
        ->innerJoin('#__elg_ergasia_speciality_translation st on ps.idSpeciality = st.idSpeciality and st.language = \'' . JFactory::getLanguage()->getTag() . '\'')
        ->group('st.idSpeciality,speciality, slug')
        ->order('cnt desc');
        $query->setLimit(15);
        $data->data = $db->loadRowList();
        $mItemid = DataUtils::getLanguageItemid($db, 196, jFactory::getLanguage()->getTag());        
        $data->Itemid = $mItemid;
        return  $data;
    }
}