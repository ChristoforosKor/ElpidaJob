<?php

class modElgErgasiaCandidatesHelper
{
    public static function getData( $idSpeciality )
    {
		$data = new stdClass();
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
                $query->select('count(*) as cnt, s.speciality, s.slug')
                        ->from('#__elg_ergasia_candidate_speciality cs')
                        ->innerJoin('#__elg_ergasia_speciality_translation s on cs.idSpeciality = s.idSpeciality and s.language = ' . $db->quote(JFactory::getLanguage()->getTag()) . ' and cs.idSpeciality = ' . $idSpeciality)
                        ->group('s.speciality');
                $db->setQuery($query);
		$result = $db->loadObject();
		$data->data = ($result ==null ? '' : $result);
		$mItemid = DataUtils::getLanguageItemid($db, 196, jFactory::getLanguage()->getTag());        
		$data->Itemid = $mItemid;
		return $data;
    }
}
?>