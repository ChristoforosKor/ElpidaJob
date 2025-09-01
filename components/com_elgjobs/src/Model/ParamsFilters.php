<?php
namespace  ELG\Component\ElgJobs\Site\Model;
use \Joomla\CMS\Factory;
use \Joomla\Database\DatabaseDriver;

class ParamsFilters {
    
  
    private $quotedLang; 
    private DatabaseDriver $db;
            
    
    public function __construct() {
        $this -> db = Factory::getDbo();
        
        $this -> quotedLang = $this -> db -> quote(  Factory::getLanguage() -> getTag());
        
    }


     public function getCities() {
       
        $query = $this -> db->getQuery(true);
        $query -> select ("distinct jt.jobCity")
                -> from ("#__elg_ergasia_job j")
                -> innerJoin ( "#__elg_ergasia_job_translation jt on jt.idJob = j.id and jt.language = " . $this -> quotedLang )
                -> order("jt.jobCity");
        return  $this -> db -> setQuery($query)  -> loadObjectList();
        
    }
    
     
    public function getSpecialities() {
        
        $query = $this -> db->getQuery(true);
        $query -> select("distinct sj.idSpeciality, sj.speciality") 
                -> from ("#__elg_ergasia_job j")
                -> innerJoin ("#__elg_ergasia_speciality_translation sj on j.idSpeciality= sj.idSpeciality 
                    and sj.language = " . $this -> quotedLang . " and j.idJobState = 2 ");
        return $this -> db -> setQuery($query) -> loadObjectList();
    }
    
    public function getEmployers() {
       
        $query = $this -> db->getQuery(true);
        $query -> select (" c.name")
        // $query -> select (" concat(c.name, ' - ', c.sortname1) as discreteTitle")
                -> from ("#__contact_details c")
                -> where (" ( language = " .  $this -> quotedLang . " or language = '*') and c.catid = 45 " )
                -> order("name");
        return  $this -> db -> setQuery($query)  -> loadObjectList();
        
    }

    //  public function getSpecialitiesPersonnel() {
            
       
        
    //     $query = $this -> db->getQuery(true);
    //     $query -> select("distinct spt.idSpeciality, spt.speciality") 
    //             -> from ("#__contact_details cd")
    //             -> innerJoin ("#__elg_ergasia_candidate_preferencesspecialities ps on cd.id= ps.idContact 
    //                 and ( cd.language = " . $this -> quotedLang . " or cd.language = '*') = " 
    //                     . $this -> quotedLang . " and cd.published = 1 ")
    //             -> innerJoin("#__elg_ergasia_speciality_translation spt on spt.idSpeciality = ps.idSpeciality and spt.language = " .  $this -> quotedLang );
    //     return $this -> db -> setQuery($query) -> loadObjectList();
    // }


    public function getSpecialitiesPersonnel() {
            
       
        
        $query = $this -> db->getQuery(true);
        $query -> select("distinct spt.idSpeciality, spt.speciality") 
                -> from ("#__contact_details cd")
                -> innerJoin ("#__elg_ergasia_candidate_preferencesspecialities ps on cd.id= ps.idContact 
                   /* and ( cd.language = " . $this -> quotedLang . " or cd.language = '*') */ 
                         and cd.published = 1 ")
                -> innerJoin("#__elg_ergasia_speciality_translation spt on spt.idSpeciality = ps.idSpeciality and spt.language = " .  $this -> quotedLang )
                ->order('spt.speciality');
        return $this -> db -> setQuery($query) -> loadObjectList();
    }
    
    public function getCitiesPersonnel() {
       
        $query = $this -> db->getQuery(true);
        $query -> select ("distinct suburb ")
                -> from ("#__contact_details j")
                -> where (" ( language = " .  $this -> quotedLang . " or language = '*') and published = 1" )
                -> order("suburb");
                // echo $query->dump();exit;
        return  $this -> db -> setQuery($query)  -> loadObjectList();
        
    }
    
//    public function getNationalities() {
//         $query = $this -> db->getQuery(true);
//         $query -> select ("distinct section ")
//                 -> from ("#__elg_section_translation ")
//                 -> where (" ( language = " .  $this -> quotedLang . " or language = '*') " )
//                 -> order("section");
//         return  $this -> db -> setQuery($query)  -> loadObjectList();       
       
//    }

    // public function getNationalities() {
    //     $query = $this -> db->getQuery(true);
    //     $query -> select ("distinct country ")
    //             -> from ("#__elg_country_translation ")
    //             -> where (" ( language = " .  $this -> quotedLang . " or language = '*') " )
    //             -> order("country");
    //     return  $this -> db -> setQuery($query)  -> loadObjectList();       
    
    // }

    public function getNationalities() {
        $query = $this -> db->getQuery(true);
        $query  -> select ("distinct ct.country ")
                -> from ("#__contact_details cd") 
                -> leftJoin (" #__elg_ergasia_candidate_basic cb on cd.id = cb.idContact")
                -> innerJoin (" #__elg_country_translation ct on ct.idCountry = cb.idNationality")
                -> where (" ( cd.language = " .  $this -> quotedLang . " or cd.language = '*') and ct.language = " .  $this -> quotedLang   )
                -> order("ct.country");
        return  $this -> db -> setQuery($query)  -> loadObjectList();       
    
    }


}
