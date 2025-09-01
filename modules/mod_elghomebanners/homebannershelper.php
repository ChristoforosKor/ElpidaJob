<?php

class HomeBannersHelper
{
    /**
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
    // public static function getCounts() {
    
    //     $langTag = JFactory::getLanguage()->getTag();
    //     $db = JFactory::getDbo();
    //     $query = $db->getQuery(true);
    //     $query  ->  select(" count(*) as sunolo,sj.idSpeciality")
    //     -> from ("#__elg_ergasia_job j") 
    //     -> innerJoin ("#__elg_ergasia_speciality_translation sj on j.idSpeciality= sj.idSpeciality 
    //                 and sj.language = '" . $langTag . "' and j.idJobState = 2 ")
    //     ->innerJoin("#__elg_geo g on g.id = j.idGeo")
    //     // ->where("sj.idSpeciality = 57");
    //     ->group("sj.idSpeciality");

    
    //     return $db->setQuery($query)->loadObjectList("idSpeciality");
    // }

    public static function getCounts() {
    
        $langTag = JFactory::getLanguage()->getTag();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query  ->  select(" count(distinct cd.id) as sunolo, cs.idSpeciality")
        -> from ("#__contact_details cd") 
        -> innerJoin (" #__elg_ergasia_candidate_basic cb on cd.id = cb.idContact")
        -> leftJoin("#__elg_ergasia_candidate_basic_translation cbt on cb.id = cbt.idCandidateBasic and cbt.language='" . $langTag ."'")
        -> leftJoin ("#__elg_ergasia_candidate_preferencesspecialities cs on cd.id = cs.idContact")
        -> leftJoin ("#__elg_ergasia_speciality_translation cst on cst.idSpeciality = cs.idSpeciality and cst.language ='" . $langTag ."'")
        -> leftJoin ("#__elg_ergasia_candidates_hours ch on ch.idContact = cd.id") 
        -> leftJoin ("#__elg_ergasia_hour_translation ht on ht.idHour = ch.idHour and ht.language =  '" . $langTag ."'" )
        -> leftJoin("#__elg_ergasia_candidates_sectionspreferences sp on sp.idContact = cd.id")
        -> leftJoin ("#__elg_ergasia_candidate_photo_base64 b64 on b64.idContact = cd.id")
        -> leftJoin("#__elg_ergasia_candidate_specialneeds sn on cd.id = sn.idContact")
        -> leftJoin("#__elg_ergasia_specialneeds_translation snt on sn.idSpecialNeed = snt.idSpecialNeed")
        ->leftJoin("#__categories cat on cat.id = cd.catid and cd.catid =44 ")
        ->where ("cd.published = 1")
        ->group("cs.idSpeciality");

        // var_dump($db->setQuery($query)->loadObjectList("idSpeciality"));exit;
    // echo $query->dump();exit;
        return $db->setQuery($query)->loadObjectList("idSpeciality");
    }


    public static function getSpeciality() {
    
        $langTag = JFactory::getLanguage()->getTag();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query  ->  select(" sj.idSpeciality, sj.speciality")
        -> from ("#__elg_ergasia_speciality_translation sj ")
        ->where ("sj.language = '" . $langTag . "' ");

    
        return $db->setQuery($query)->loadObjectList("idSpeciality");
    }


}