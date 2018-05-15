<?php
require_once JPATH_SITE . '/components/com_elgergasia/models/datautils.php';
class modElgErgasiaEmployersSpecialitiesHelper
{
    public static function getData()
    {
        $data = new stdClass();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->clear();
        $db->setQuery($query);
        $query->select('it.idIndustry, it.industry, it.slug, count(*) as cnt')
        ->from('#__elg_ergasia_employer e')
        ->innerJoin('#__elg_ergasia_industry_translation it on e.idIndustry = it.idIndustry and it.idIndustry > 0 and it.language = \'' . JFactory::getLanguage()->getTag() . '\'')
        ->group('it.idIndustry, it.industry, slug')
        ->order('cnt desc');
		$query->setLimit(10);
        $data->data = $db->loadRowList();
        $mItemid = DataUtils::getLanguageItemid($db, 203, jFactory::getLanguage()->getTag());        
        $data->Itemid = $mItemid;
        return  $data;
    }
}