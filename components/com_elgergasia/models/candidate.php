<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/commons/models/views.php';
 
 class ElgergasiaModelCandidate extends JModelDatabase{ 
    private $lang;
    function getState() {
        
        $this->lang =  JFactory::getLanguage()->getTag();
        $state = parent::getState();
        $id = $state->get('id', 0 );
        $db = $this->getDb();
        $query = $db->getQuery();
        $state->set('photos', $this->getPhotos($id, $db, $query));
        $state->set('characteristics', $this->getCharacteristicsTitles($id, $db, $query));
        $state->set('basic', $this->getBasicTitles($id, $db, $query));
        $state->set('experience',  $this->getExperienceList($id, $db, $query));
        $state->set('specialities', $this->getSpecialitiesList($id, $db, $query));
        $state->set('education', $this->getEducationList($id, $db, $query));
        $state->set('languages', $this->getLanguageList($id, $db, $query));
        $state->set('hours', views::getPreferencesHours($id, $db, $query));
        $state->set('relations', $this->getRelationPreferences($id, $db, $query));
        $state->set('counties', $this->getCountiesPreferences($id, $db, $query));
        $state->set('preferences', $this->getCandidatePreferences($id, $db, $query));
       // $state->set('prefspecialities', $this->getPreferencesSpecialities($id, $db, $query));
        $state->set('medicalData', $this->getMedicalData($id, $db, $query));
        $state->set('legalData', $this->getLegalData($id, $db, $query));
        $state->set('paperData', $this->getPaperData($id, $db, $query));
        $state->set('specialityprefs', $this->getSpecialitiesPreferences($id, $db, $query));
		$state->set('prefTeam', $this->getPreferenceTeam($id, $db, $query));
        return $state;
    }
   
	
   
    private function getLegalData($id, $db, $query) {
        $query->clear();
        $query->select("id, ifNull(t.legalTitle, td.legalTitle) as legalTitle, legalFile, idUser, legalDateExpire")
                ->from("#__elg_ergasia_legalpaper l")
                ->leftJoin("#__elg_ergasia_legalpaper_translation t on l.id = t.idLegalPaper and t.language= '" . $this->lang . "'")
                ->leftJoin("#__elg_ergasia_legalpaper_translation td on l.id = td.idLegalPaper and td.isDefault = 1")
                ->where("idUser = " . $id);
        //echo $query->dump();
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    private function getMedicalData($id, $db, $query) {
        $query->clear();
        $query->select("m.id, ifNull(t.examTitle, td.examTitle) as examTitle, m.examFile, m.examDate, m.idUser")
                ->from("#__elg_ergasia_candidate_medicalexam m")
                ->leftJoin("#__elg_ergasia_candidate_medicalexam_translation t on m.id = t.idMedicalExam and t.language = '" . $this->lang . "'")
                ->leftJoin("#__elg_ergasia_candidate_medicalexam_translation td on m.id = td.idMedicalExam and td.isDefault =1")
                ->where("idUser = " . $id);
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
     private function getPaperData($id, $db, $query) {
        $query->clear();
        $query->select("id, ifNull(t.paperTitle, td.paperTitle) as paperTitle, paperFile, idUser")
                ->from("#__elg_ergasia_candidate_paper m")
                ->leftJoin("#__elg_ergasia_candidate_paper_translation t on m.id = t.idCandidatePaper and t.language = '" . $this->lang . "'")
                ->leftJoin("#__elg_ergasia_candidate_paper_translation td on m.id = td.idCandidatePaper and td.isDefault =1")
                ->where("idUser = " . $id);
        $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    private function getPhotos($id, $db, $query) {
        $query->clear();
        $query->select(' id, idUser, idPhotoType, photo, photoExtension ')
                ->from('#__elg_ergasia_candidate_photos')
                ->WHERE('idUser = ' . $id);
        $db->setQuery($query);
        return $db->loadObjectList();
    }
   
    private function getCharacteristicsTitles($id, $db, $query) {
        $query->clear();
        $query->select("e.id, e.idUser
                        ,g.gender, dateOfBirth
                        ,c.country as nationality ,m.militaryStatus, ma.maritalStatus
                        ,childrenNum, rl.religion, dl.driverLicence, smoking, r.rankFem as rank, ifNull(et.aboutMe, etd.aboutMe) as aboutMe")
        ->from( "#__elg_ergasia_candidate_characteristic e")
        ->leftJoin("#__elg_ergasia_candidate_characteristic_translation et on e.id =   et.idCandidateCharacteristic and et.language ='" . $this->lang . "'")
        ->leftJoin("#__elg_ergasia_candidate_characteristic_translation etd on e.id = etd.idCandidateCharacteristic and etd.isDefault = 1")
        ->join("left", "#__elg_ergasia_gender_translation g on e.idGender = g.idGender and g.language = '" . $this->lang . "'")
        ->join("left","#__elg_country_translation c on e.idNationality = c.idCountry and c.language = '" . $this->lang . "'")
        ->join("left", "#__elg_militarystatus_translation m on e.idMilitaryStatus = m.idMilitaryStatus and m.language='" . $this->lang . "'")
        ->join("left", "#__elg_maritalstatus_translation ma on e.idMaritalStatus = ma.idMaritalStatus and ma.language= '" . $this->lang . "'")
        ->join("left", "#__elg_rank_translation r on e.idPetFriend = r.idRank and r.language= '" . $this->lang . "'")
        ->join("left", "#__elg_religion_translation rl on e.idReligion = rl.idReligion and rl.language= '" . $this->lang . "'")
        ->join("left", "#__elg_ergasia_driverlicence_translation dl  on e.idDriverLicence = dl.idDriverLicence and dl.language = '" . $this->lang . "'")
        ->where("e.idUser = " . $id);
        $db->setQuery($query);
        $res = $db->loadObject();
        return ($res == null ? NullsFactory::getNullCandidateCharacteristics() : $res);
    }
    
    private function getBasicTitles($id, $db, $query) {
        $query->clear();
        $query->select(" c.id, idUser, cn.country, ifNull(cbt.city, cbtd.city) as city, ifNull(cbt.address, cbtd.address) as address, postalCode, phone, mobile, fax, st.candidateState, c.showPhoto, c.useMyData ")
                ->from("#__elg_ergasia_candidate_basic c ")
                ->leftJoin("#__elg_ergasia_candidate_basic_translation cbt on c.id = cbt.idCandidateBasic and cbt.language = '" . $this->lang . "'")
                ->leftJoin('#__elg_ergasia_candidate_basic_translation cbtd on c.id =  cbtd.idCandidateBasic and cbtd.isDefault = 1')
                ->join("left", "#__elg_country_translation cn on c.idCountry = cn.idCountry and cn.language = '" . $this->lang . "'")
                ->join("left", "#__elg_ergasia_candidatestate_translation st on c.idState = st.idCandidateState and st.language='" . $this->lang . "'")
                ->where("idUser = " . $id);
        $res = $db->loadObject();
        return ($res == null ? NullsFactory::getNullCandidateBasic() : $res);
    }
    
    private function getExperienceList($id, $db, $query) {
        $query->clear();
        $query->select("e.id, idUser, i.industry, s.speciality, ifNull(et.employerTitle, etd.employerTitle) as employerTitle, DATE_FORMAT(dateFrom, '%m/%Y') as dateFrom,  DATE_FORMAT(dateTo,'%m/%Y') as dateTo ")
                ->from ('#__elg_ergasia_employees_experiences e')
                ->leftJoin("#__elg_ergasia_candidate_experience_translation et on e.id = et.idCandidateExperience  and et.language ='" . $this->lang ."'" )
                ->leftJoin("#__elg_ergasia_candidate_experience_translation etd on e.id = etd.idCandidateExperience  and et.isDefault =1" )
                ->leftJoin("#__elg_ergasia_industry_translation i on e.idIndustry = i.idIndustry and i.language ='" . $this->lang . "'")
                ->leftJoin("#__elg_ergasia_speciality_translation s on e.idSpecialization = s.idSpeciality  and s.language ='" . $this->lang . "'")
                ->where('idUser = ' . $id)
                ->order('e.dateFrom, employerTitle');
              // echo $query->dump();
                $db->setQuery($query);
        return $db->loadObjectList();
   }
   
    private function getSpecialitiesList($id, $db, $query) {
        $query->clear();
        $query->select("e.id,e.idUser, s.speciality,e.experience,  r.rankFem as rank ")
                ->from ('#__elg_ergasia_candidate_speciality e')
                ->join('left', "#__elg_ergasia_speciality_translation s on e.idSpeciality = s.idSpeciality and s.language = '" . $this->lang . "'")
                ->join("left", "#__elg_rank_translation r on e.idRank = r.idRank and r.language = '" . $this->lang . "'")
                ->where('idUser = ' . $id)
                ->order('rank, experience, speciality');
        
                $db->setQuery($query);
        return $db->loadObjectList();
   }
   
    private function getEducationList($id, $db, $query) {
        $query->clear();
        $query->select("e.id, idUser, ifNull(et.educationTitle, etd.educationTitle) as educationTitle, l.degreeLevel, ifNull(et.educationInstitute, etd.educationInstitute) as educationInstitute ")
                ->from ("#__elg_ergasia_candidate_education e")
                ->leftJoin ("#__elg_ergasia_candidate_education_translation et on e.id = et.idCandidateEducation and et.language ='" . $this->lang . "'")
                ->leftJoin ("#__elg_ergasia_candidate_education_translation etd on e.id = etd.idCandidateEducation and etd.isDefault=1")
                ->leftJoin("#__elg_ergasia_degree_level_translation l on e.idDegreeLevel = l.idDegreeLevel and l.language = '" . $this->lang . "'")
                ->where('idUser = ' . $id)
                ->order('yearFrom, yearTo desc, educationTitle');
                $db->setQuery($query);
        return $db->loadObjectList();
    }
    
    private function getLanguageList($id, $db, $query) {
        $query->clear();
        $query->select("e.id, idUser, ifNull(et.spokenLanguage, etd.spokenLanguage) as spokenLanguage, r.rankNeut")
                ->from ('#__elg_ergasia_candidate_spokenlanguage e')
                ->leftJoin("#__elg_ergasia_candidate_spokenlanguage_translation et on e.id = et.idSpokenLanguage and et.language = '" . $this->lang . "'")
                ->leftJoin("#__elg_ergasia_candidate_spokenlanguage_translation etd on e.id = etd.idSpokenLanguage and etd.isDefault = 1")
                ->join("left", "#__elg_rank_translation r on e.idRank = r.idRank and r.language = '" . $this->lang . "'")
                ->where('idUser = ' . $id)
                ->order('spokenLanguage, rankNeut');
                $db->setQuery($query);
        return $db->loadObjectList();
    }
     
    private function getRelationPreferences($id, $db, $query) {
       $query->clear();
       $query->select("r.relationType")
               ->from("#__elg_ergasia_relationtype_translation r")
               ->join("INNER", "#__elg_ergasia_candidate_relationtypes rt on  rt.idUser = " . $id . "  and r.idRelationType = rt.idRelationType  and language = '$this->lang'");
       $db->setQuery($query);
       return $db->loadObjectList();
   }
   
    private function getCountiesPreferences($id, $db, $query) {
       $query->clear();
       $query->select( $db->quoteName("county"))
               ->from("#__elg_ergasia_candidates_sectionspreferences cp")
               ->join("INNER", "#__elg_county_translation c on  cp.idUser = " . $id . "  and cp.idCounty = c.idCounty and language = '$this->lang'");
       $db->setQuery($query);
       return  $db->loadObjectList();      
   }
   
   private function getCandidatePreferences($id, $db, $query) {
       $query->clear();
       $query->select( "id, idUser, comments")
               ->from("#__elg_ergasia_candidates_preferencescomments ")
               ->where("idUser = " . $id);
       $db->setQuery($query);
       $res = $db->loadObject();
       return ($res == null ? NullsFactory::getNullCandidatePreferences() : $res);
  }
   
  // private function getPreferencesSpecialities($id, $db, $query) {
       // $query->clear();
       // $query->select( "ps.idUser, concat(i.industry, ' - ', s.speciality) as speciality")
               // ->from("#__elg_ergasia_candidate_preferencesspecialities ps")
               // ->join("inner", "#__elg_ergasia_speciality_translation s on ps.idSpeciality = s.idSpeciality and s.language = '" . $this->lang . "'" )
               // ->join("inner", "#__elg_ergasia_speciality spe on spe.id = s.idSpeciality" )
               // ->join("inner", "#__elg_ergasia_industry_translation i on i.idIndustry = spe.idIndustry and i.language ='" . $this->lang . "'" )
               // ->where("ps.idUser = " . $id);
       // $db->setQuery($query);
       // return $db->loadObjectList();
  // }
  
	
    private function getSpecialitiesPreferences($id, $db, $query) {
       $query->clear();
       $query->select( "ps.idUser, s.speciality")
               ->from("#__elg_ergasia_candidate_preferencesspecialities ps")
               ->join("inner", "#__elg_ergasia_speciality_translation s on ps.idSpeciality = s.idSpeciality and s.language = '" . $this->lang . "'" )
               ->join("inner", "#__elg_ergasia_speciality spe on spe.id = s.idSpeciality" )
               ->where("ps.idUser = " . $id);
       $db->setQuery($query);
       return $db->loadObjectList();
  }
 
	private function getPreferenceTeam($id, $db, $query) {
       $query->clear();
       $query->select( 'idUserTeam, name')
			->from('#__users u')
			->innerJoin('#__elg_ergasia_candidate_team t on u.id = t.idUserTeam and t.idUser = ' . $id );
		$q2 = $db->getQuery(true);
		$q2->select('u.id, name')->from('#__users u')->innerJoin('#__elg_ergasia_candidate_team t on u.id = t.idUser and t.idUserTeam = ' . $id);
		$query->union($q2);
               
       $db->setQuery($query);
       return $db->loadObjectList();
	}
}
?>