<?php
namespace  ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

        
class   PersonnellistModel extends ListModel {

    public function getItems($pk = null) {
        $db = $this -> getDbo();
        $input = Factory::getApplication() -> input;
        $id = $input -> get("pid", 0);
        $langTag = Factory::getLanguage()->getTag();
        $quotedLangTag =  $db -> quote($langTag);
        
        $query = $db->getQuery(true);
        $query  ->  select(" distinct u.id,  u.name, cct.aboutMe, cbt.address, cbt.city, GROUP_CONCAt( cst.speciality) as speciality, GROUP_CONCAT( ht.hour ) as hour"
                . ", GROUP_CONCAT(cet.educationTitle) as educationTitle, cb.X(pt) as lat , cbt.longitute as lng, cb.idState as sta, csta.candidateState_")
                -> from ("#__users u") 
                -> innerJoin (" #__elg_ergasia_candidate_basic cb on u.id = cb.idUser")
                -> innerJoin(" #__elg_ergasia_candidatestate csta on csta.id = cb.idState ")
                -> leftJoin("#__elg_ergasia_candidate_basic_translation cbt on cb.id = cbt.idCandidateBasic and cbt.language=" . $quotedLangTag)
                -> leftJoin ("#__elg_ergasia_candidate_preferencesspecialities cs on u.id = cs.idUser")
                -> leftJoin ("#__elg_ergasia_speciality_translation cst on cst.idSpeciality = cs.idSpeciality and cst.language = " . $quotedLangTag )
                -> leftJoin ("#__elg_ergasia_candidates_hours ch on ch.idUser = u.id") 
                -> leftJoin ("#__elg_ergasia_hour_translation ht on ht.idHour = ch.idHour and ht.language =  " . $quotedLangTag )
                -> leftJoin ("#__elg_ergasia_candidate_education ce on ce.idUser = u.id") 
                -> leftJoin ("#__elg_ergasia_candidate_education_translation cet on cet.idCandidateEducation = ce.id and cet.language =  " . $quotedLangTag )
                -> leftJoin ("#__elg_ergasia_candidate_characteristic cc on cc.idUser = u.id")
                -> leftJoin ("#__elg_ergasia_candidate_characteristic_translation cct on cct.idCandidateCharacteristic = cc.id and cct.language =  " . $quotedLangTag )
                -> group("u.id, u.name, cct.aboutMe, cbt.address, cbt.city")
                -> order("u.id desc");
        // echo $query -> dump();exit;
        $item = $db -> setQuery($query, 0, 7) -> loadObjectList();
        // var_dump($item);exit;
        return $item ;
    }
    
    
    public function getSections() {
        $langTag = Factory::getLanguage()->getTag();
        $db = $this -> getDbo();
        $query = $db->getQuery(true);
        $query -> select ("distinct st.section")
                -> from ("#__elg_ergasia_candidates_sectionspreferences sp ")
                -> innerJoin ( "#__elg_section_translation st on st.idSection = sp.idSection and st.language = " . $db -> quote ( $langTag ) )
                -> order("st.section");
//        echo 
        return  $db -> setQuery($query)  -> loadObjectList();
        
    }
    
     
    public function getSpecialities() {
            
        $langTag = Factory::getLanguage()->getTag();
        $db = $this -> getDbo();
        $query = $db->getQuery(true);
        $query -> select("distinct st.speciality") 
                -> from ("#__elg_ergasia_candidate_preferencesspecialities ps")
                -> innerJoin ("#__elg_ergasia_speciality_translation st on ps.idSpeciality= st.idSpeciality 
                    and st.language = " . $db -> quote($langTag))
                -> order("speciality");
        return $db -> setQuery($query) -> loadObjectList();
    }
    
}