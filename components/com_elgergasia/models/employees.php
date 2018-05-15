<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

 
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 
 
 class ElgergasiaModelEmployees extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $filters = $state->get('filters');
        $params = JComponentHelper::getParams('com_elgergasia');
        $candidatesGroup = $params->get('data.params.employeeRoot', 10);
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $currentLanguage = JFactory::getLanguage()->getTag();
        $query->select(" distinct u.id,u.name as candidateName, cr.country, trim(ifNull(eb.city,'')) as city, cn.country as nationality, u.email, trim(ifNull(eb.phone, '')) as phone,
trim(ifNull(eb.mobile, '')) as mobile, trim(ifNull(eb.fax, '')) as fax ")
                ->from ("#__users u ")
                ->join('inner', '#__user_usergroup_map um on u.id = um.user_id and group_id = '. $candidatesGroup)
                ->join('left', '#__elg_ergasia_candidates_basic eb on u.id = eb.idUser')
                ->join('left', '#__elg_ergasia_employees_characteristics ec on u.id = ec.idUser')
                ->join ('left', "#__elg_country_translation cr on cr.id = eb.idCountry and cr.language = '" . $currentLanguage . "'")
                ->join ('left', "#__elg_country_translation cn on cn.id = ec.idNationality '" . $currentLanguage . "'")
                ->join ('left', '#__elg_ergasia_employees_experiences exp on exp.idUser = u.id')
                ->join ('left', '#__elg_ergasia_candidate_specialities spe on spe.idCandidate = u.id')
                ->join ('left', '#__elg_ergasia_candidate_education edu on edu.idCandidate = u.id')
                ->join ('left', '#__elg_ergasia_candidates_spokenlanguages sla on sla.idCandidate = u.id')
                ->order('candidateName, country, city, nationality');
        if(count($this->filters) > 0 ) {
            $whereCl = '';
            $andV = '';
            if($filters["fullname"]!= "") {
                $whereCl .= $andV . " u.name like '%" . $this->filters["fullname"] . "%'";
                $andV = " and ";
            }
            if($filters["username"] != "") {
                $whereCl .= $andV . " u.username like '%" . $this->filters["username"] . "%'";
                $andV = " and ";
            }
            if($filters["email"] != "") {
                $whereCl .= $andV . " u.email like '%" . $this->filters["email"] . "%'";
                $andV = " and ";
            }
            if($filters["country"] != "0" ){
                $whereCl .= $andV . " eb.idCountry =" . $this->filters["country"] ;
                $andV = " and ";
            }
            if($filters["city"] != "" ){
                $whereCl .= $andV . " eb.city like '%" . $this->filters["city"] . "%'";
                $andV = " and ";
            }
            if($filters["address"] != "" ){
                $whereCl .= $andV . " eb.address like '%" . $this->filters["address"] . "%'";
                $andV = " and ";
            }
            if($filters["postalCode"] != "" ){
                $whereCl .= $andV . " eb.postalCode like '%" . $this->filters["postalCode"] . "%'";
                $andV = " and ";
            }
            if($filters["telephone"] != "" ){
                $whereCl .= $andV . 
                        " (eb.phone like '%" . $this->filters["telephone"] . "%' or eb.mobile like '%" . $this->filters["telephone"] . "%' or eb.fax like '%" . $this->filters["telephone"] . "%')";
                $andV = " and ";
            }
            if($filters["idGender"] != "0" ){
                $whereCl .= $andV . " ec.idGender = " . $this->filters["idGender"] ;
                $andV = " and ";
            }
            if($filters["dateOfBirth"] != "" ){
                $whereCl .= $andV . " ec.dateOfBirth = '" . $this->filters["dateOfBirth"] . "'" ;
                $andV = " and ";
            }
            if($filters["idNationality"] != "0" ){
                $whereCl .= $andV . " ec.idNationality = " . $this->filters["idNationality"] ;
                $andV = " and ";
            }
            if($filters["idMilitaryStatus"] != "0" ){
                $whereCl .= $andV . " ec.idMilitaryStatus = " . $this->filters["idMilitaryStatus"] ;
                $andV = " and ";
            }
            if($filters["idMaritalStatus"] != "0" ){
                $whereCl .= $andV . " ec.idMaritalStatus = " . $this->filters["idMaritalStatus"] ;
                $andV = " and ";
            }
            if($filters["childrenNum"] != "" ){
                $whereCl .= $andV . " ec.childrenNum = " . $this->filters["childrenNum"] ;
                $andV = " and ";
            }
            if($filters["idReligion"] != "0" ){
                $whereCl .= $andV . " ec.idReligion = " . $this->filters["idReligion"] ;
                $andV = " and ";
            }
            if($filters["smoking"] != "" ){
                $whereCl .= $andV . " ec.smoking = " . $this->filters["smoking"] ;
                $andV = " and ";
            }
            if($filters["idPetFriend"] != "0" ){
                $whereCl .= $andV . " ec.idPetFriend = " . $this->filters["idPetFriend"] ;
                $andV = " and ";
            }
            
            if($filters["employerTitle"] != "" ){
                $whereCl .= $andV . " exp.employerTitle like '%" . $this->filters["employerTitle"] . "%' " ;
                $andV = " and "; 
            }
            if($filters["idIndustry"] >0 ){
                $whereCl .= $andV . " exp.idIndustry = " . $this->filters["idIndustry"] ;
                $andV = " and "; 
            }
            if($filters["idSpecialization"] > 0 ){
                $whereCl .= $andV . " exp.idSpecialization = " . $this->filters["idSpecialization"] ;
                $andV = " and "; 
            }
            
            if($filters["idSpecialitySpecilities"] > 0 ){
                $whereCl .= $andV . " spe.idSpeciality = " . $this->filters["idSpecialitySpecilities"] ;
                $andV = " and "; 
            }
            
            if($filters["experienceSpecialities"] > 0 ){
                $whereCl .= $andV . " spe.experience = " . $this->filters["experienceSpecialities"] ;
                $andV = " and "; 
            }
            
            
            if($filters["idRankSpecialities"] > 0 ){
                $whereCl .= $andV . " spe.idRank = " . $this->filters["idRankSpecialities"] ;
                $andV = " and "; 
            }
            
            
            if($filters["educationTitle"] != '' ){
                $whereCl .= $andV . " edu.educationTitle like '%" . $this->filters["educationTitle"] . "%'" ;
                $andV = " and "; 
            }
            
            
            if($filters["educationInstitute"] > 0  ){
                $whereCl .= $andV . " edu.educationInstitute = " . $this->filters["educationInstitute"]  ;
                $andV = " and "; 
            }
            
            if($filters["idDegreeLevel"] > 0  ){
                $whereCl .= $andV . " edu.idDegreeLevel = " . $this->filters["idDegreeLevel"]  ;
                $andV = " and "; 
            }
            
            if($filters["idSpecializationEducation"] > 0  ){
                $whereCl .= $andV . " edu.idSpecialization = " . $this->filters["idSpecializationEducation"]  ;
                $andV = " and "; 
            }
            
            
            if($filters["spokenLanguage"] != ''  ){
                $whereCl .= $andV . " sla.spokenLanguage like '%" . $this->filters["spokenLanguage"] ."%'"  ;
                $andV = " and "; 
            }
            
            if($filters["idRankLanguage"] > 0  ){
                $whereCl .= $andV . " sla.idRank = " . $this->filters["idRankLanguage"]  ;
                $andV = " and "; 
            }
            
           if($whereCl != '') {
            $query->where($whereCl);
        }
        }
        //echo($query->__toString());
        $db->setQuery($query);
        $results =  $db->loadObjectList();
        $state->set('results', $results);
        return $state;
    }
    
    function setFilters($filters) {
        $this->filters = $filters;
    }
    
    function getFilters() {
        return $this->filter;
    }
}
?>