<?php

use Joomla\CMS\Factory;


class HomeCandidatesHelper
{
    /**
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    public static function getData() {
    
        $langTag = Factory::getLanguage()->getTag();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query  ->  select(" distinct cd.id,  cd.name,  ifNull(cd.address, '') as address ,cd.suburb,
         /*cbt.city,*/ GROUP_CONCAt(distinct cst.speciality) as speciality, GROUP_CONCAt( distinct cst.idSpeciality) as idSpeciality , GROUP_CONCAT( ht.hour ) as hour"
        . ",  cd.image,  cd.published as idState, sortname1 as lastname, sortname2 as allowphoto")
        -> from ("#__contact_details cd") 
        -> innerJoin (" #__elg_ergasia_candidate_basic cb on cd.id = cb.idContact")
        -> leftJoin("#__elg_ergasia_candidate_basic_translation cbt on cb.id = cbt.idCandidateBasic and cbt.language='" . $langTag . "' ")
        -> leftJoin ("#__elg_ergasia_candidate_preferencesspecialities cs on cd.id = cs.idContact")
        -> leftJoin ("#__elg_ergasia_speciality_translation cst on cst.idSpeciality = cs.idSpeciality and cst.language = '" . $langTag . "'")
        -> leftJoin ("#__elg_ergasia_candidates_hours ch on ch.idContact = cd.id") 
        -> leftJoin ("#__elg_ergasia_hour_translation ht on ht.idHour = ch.idHour and ht.language =  '" . $langTag . "'" )
        -> where ("cd.published = 1 and cd.sortname2 = 1 and cd.image != ''")
        -> group("cd.id, cd.name, cd.misc, cd.address, cd.published, cd.image")
        ->order('id desc');

        // echo $query->dump();exit;
        return $db->setQuery($query)->loadObjectList();
    }
}