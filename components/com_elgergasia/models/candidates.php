<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 20130 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr 
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 jimport('joomla.application.component.helper');
 
 class ElgergasiaModelCandidates extends JModelDatabase{ 
       
    function getState() {
        $state = parent::getState();
        $filters = $state->get('filters');
        if($filters->filter_order == '')
        {
            $filters->filter_order = 'id';
        }
        if($filters->filter_order_Dir == '')
        {
            $filters->filter_order_Dir = 'desc';
        }
  
        
        $db = $this->getDb();
        $idUser = ($filters->idUser ==0 ? '' : $filters->idUser );
        $currentLanguage = JFactory::getLanguage()->getTag();
        $form = JForm::getInstance($state->get('layout'), JPATH_COMPONENT_SITE . '/models/forms/candidatessearch.xml');
        $form->setValue('idUser', null, $idUser);
        $form->setValue('fullname', null, $filters->fullname);
        $form->setValue('idNationality', null, $filters->idNationality);
        $form->setValue('city', null, $filters->city);
        
        $form->setValue('username', null, $filters->username);
        $form->setValue('email', null, $filters->email);
        $form->setValue('idCountry', null, $filters->idCountry);
        $form->setValue('address', null, $filters->address);
        $form->setValue('postalCode', null, $filters->postalCode);
        $form->setValue('telephone', null, $filters->telephone);
        $form->setValue('idGender', null, $filters->idGender); 
        $form->setValue('dateOfBirth', null, $filters->dateOfBirth);
        $form->setValue('idMilitaryStatus', null, $filters->idMilitaryStatus);
        $form->setValue('idMaritalStatus', null, $filters->idMaritalStatus);
        $form->setValue('idDriverLicence', null, $filters->idDriverLicence);
        $form->setValue('childrenNum', null, $filters->childrenNum);
        $form->setValue('idReligion', null, $filters->idReligion);
        $form->setValue('smoking', null, $filters->smoking);
        $form->setValue('idPetFriend', null, $filters->idPetFriend);
        $form->setValue('idIndustry', null, $filters->idIndustry);
        $form->setValue('idSpecialization', null, $filters->idSpecialization);
        $form->setValue('employerTitle', null, $filters->employerTitle);
        $form->setValue('idSpecialitySpecilities', null, $filters->idSpecialitySpecilities);
        $form->setValue('idRankSpecialities', null, $filters->idRankSpecialities);
        $form->setValue('educationTitle', null, $filters->educationTitle);
        $form->setValue('educationInstitute', null, $filters->educationInstitute);
        $form->setValue('idDegreeLevel', null, $filters->idDegreeLevel);
        $form->setValue('idSpecializationEducation', null, $filters->idSpecializationEducation);
        $form->setValue('spokenLanguage', null, $filters->spokenLanguage);
        $form->setValue('idRankLanguage', null, $filters->idRankLanguage);
        $form->setValue('experienceSpecialities', null, $filters->experienceSpecialities);
   
        $form->setValue('lastmodified', null, $filters->lastmodified);
        $form->setValue('idCandidateState', null, $filters->idCandidateState);
        $form->setValue('idSectionPreference', null, $filters->idSectionPreference);
        $form->setValue('idHour', null, $filters->idHour);
        $form->setValue('idSpecialityPreference', null, $filters->idSpecialityPreference);
        $form->setValue('idRelationPreference', null, $filters->idRelationPreference);
        $form->setValue('idUserTeam', null, $filters->idUserTeam);
  
       
              
        $fullname = ($filters->fullname != "" ? '%' . $db->escape( $filters->fullname) . '%' : "") ;
        $username = ($filters->username != "" ? '%' . $db->escape( $filters->username) . '%' : "") ;
        $email = ($filters->email != "" ? '%' . $db->escape( $filters->email) . '%' : "") ;
        $city = ($filters->city != "" ? '%' . $db->escape( $filters->city) . '%' : "") ;
        $address = ($filters->address != "" ? '%' . $db->escape( $filters->address) . '%' : "") ;
        $postalCode = ($filters->postalCode != "" ? '%' . $db->escape( $filters->postalCode) . '%' : "") ;
        $telephone = ($filters->telephone != "" ? '%' . $db->escape( $filters->telephone) . '%' : "") ;
        $employerTitle = ($filters->employerTitle != "" ? '%' . $db->escape( $filters->employerTitle) . '%' : "") ;
        $educationTitle = ($filters->educationTitle != "" ? '%' . $db->escape( $filters->educationTitle) . '%' : "") ;
        $educationInstitute = ($filters->educationInstitute != "" ? '%' . $db->escape( $filters->educationInstitute) . '%' : "") ;
        $spokenLanguage = ($filters->spokenLanguage != "" ? '%' . $db->escape( $filters->spokenLanguage) . '%' : "") ;
      
        $pos = strpos( $filters->idSpecialization, ':' );
        $len = ( $pos === false ? 0 : $pos);
         
        if( $len > 0 ):
            $filters->idSpecialization = substr( $filters->idSpecialization, 0, $len); 
        elseif( !is_numeric( $filters->idSpecialization )):
            $filters->idSpecialization = ''; 
        endif;  
        //echo $filters->idSpecialization;
        $query = $db->getQuery(true);
        
        $query->select(" u.id, left(u.name, locate(' ', u.name) + 1) as fullname,  cn.country as nationality,  u.email, eb.phone, ec.dateOfBirth,
eb.mobile, eb.fax, lu.datemodified,
case when cp.photo is null then 'no-image.jpg'  else concat(cp.photo, '_medium.', cp.photoExtension) end as photo,
group_concat(distinct spet.speciality) as speciality ,  eb.showPhoto , eb.useMyData/**, group_concat(distinct cnt.county ) as prefSection**/")
        ->  from ("#__users u ")
        ->  innerJoin ('#__user_usergroup_map um on u.id = um.user_id and um.group_id = 14'  )
        ->  leftJoin ('#__elg_ergasia_candidate_basic eb on u.id = eb.idUser')
        ->  leftJoin ('#__elg_ergasia_lastupdates lu on u.id = lu.idUser')
        ->  leftJoin ('#__elg_ergasia_candidate_characteristic ec on u.id = ec.idUser')
        ->  leftJoin ("#__elg_country_translation cn on cn.idCountry = ec.idNationality and cn.language = '" . $currentLanguage . "'");
        
    if($filters->idSpecialization !== '' && $filters->idSpecialization > 0 && !($filters->idSpecialityPreference != '' || $filters->idSpecialityPreference > 0 )):    
        $query -> innerJoin ("#__elg_ergasia_candidate_preferencesspecialities spe on spe.idUser = u.id and idSpeciality in ( $filters->idSpecialization ) ");
    else:
        $query -> leftJoin ('#__elg_ergasia_candidate_preferencesspecialities spe on spe.idUser = u.id');
    endif;
    $query -> leftJoin("#__elg_ergasia_speciality_translation spet on spe.idSpeciality = spet.idSpeciality and spet.language = '$currentLanguage' ")  
    /**
            -> leftJoin('#__elg_ergasia_candidates_sectionspreferences secp on secp.idUser = u.id' )
    -> leftJoin('#__elg_county_translation cnt on secp.idCounty = cnt.idCounty and cnt.language = \'' . $currentLanguage . '\'' )
    **/
    -> leftJoin('#__elg_ergasia_candidate_photos cp on cp.idUser = u.id and cp.idPhotoType =1')
     
    -> group('u.id, u.name, cn.country, u.email, eb.phone, eb.mobile, eb.fax,  datemodified, photo')
    -> order('eb.id desc'); //$filters->filter_order . ' ' . $filters->filter_order_Dir);
		

     //   if(count($filters) > 0 ) {
            $whereCl = '';
            $andV = '';
            if($filters->idUser > 0 ) {
                $whereCl .= $andV . " u.id  =" . $filters->idUser ;
                $andV = " and ";
            }
            if($fullname!= "") {
                $whereCl .= $andV . " u.name like " . $db->quote($fullname, false);
                $andV = " and ";
            }
            if($username != "") {
                $whereCl .= $andV . " u.username like " . $db->quote($username, false);
                $andV = " and ";
            }
            if($email != "") {
                $whereCl .= $andV . " u.email like " . $db->quote($email, false);
                $andV = " and ";
            }
            if($filters->idCandidateState > 0 ) 
            {
                $whereCl .= $andV . " eb.idState  = " . $filters->idCandidateState  ;
                $andV = " and ";
            }
            if($filters->idCountry != "0" ){
                $whereCl .= $andV . " eb.idCountry =" . $filters->idCountry ;
                $andV = " and ";
            }
            if($city != "" ){
                $whereCl .= $andV . " ifNull(ebt.city, ebtd.city) like " . $db->quote($city, false);
                $andV = " and ";
            }
            if($address != "" ){
                $whereCl .= $andV . " ifNull(ebt.address, ebtd.address) like " . $db->quote($address, false);
                $andV = " and ";
            }
            if($postalCode != "" ){
                $whereCl .= $andV . " eb.postalCode like " . $db->quote($postalCode, false);
                $andV = " and ";
            }
            if($telephone != "" ){
                $whereCl .= $andV . 
                        " (eb.phone like " . $db->quote($telephone, false) . " or eb.mobile like " . $db->quote($telephone, false) . " or eb.fax like " . $db->quote($telephone, false) . ')';
                $andV = " and ";
            }
            if($filters->idGender != "0" ){
                $whereCl .= $andV . " ec.idGender = " . $filters->idGender ;
                $andV = " and ";
            }
            if($filters->dateOfBirth != "" ){
                $whereCl .= $andV . " ec.dateOfBirth = '" . $filters->dateOfBirth . "'" ;
                $andV = " and ";
            }
            if($filters->idNationality != "0" ){
                $whereCl .= $andV . " ec.idNationality = " . $filters->idNationality ;
                $andV = " and ";
            }
            if($filters->idMilitaryStatus != "0" ){
                $whereCl .= $andV . " ec.idMilitaryStatus = " . $filters->idMilitaryStatus ;
                $andV = " and ";
            }
           
            if($filters->idDriverLicence != "0" ){
                $whereCl .= $andV . " ec.idDriverLicence = " . $filters->idDriverLicence ;
                $andV = " and ";
            }
           if($filters->idMaritalStatus != "0" ){
                $whereCl .= $andV . " ec.idMaritalStatus = " . $filters->idMaritalStatus ;
                $andV = " and ";
            }
            if(is_numeric($filters->childrenNum) ){
                $whereCl .= $andV . " ec.childrenNum = " . $filters->childrenNum ;
                $andV = " and ";
            }
            if($filters->idReligion != "0" ){
                $whereCl .= $andV . " ec.idReligion = " . $filters->idReligion ;
                $andV = " and ";
            }
            if($filters->smoking > 0 ){
                $whereCl .= $andV . " ec.smoking = " . $filters->smoking ;
                $andV = " and ";
            }
            if($filters->idPetFriend != "0" ){
                $whereCl .= $andV . " ec.idPetFriend = " . $filters->idPetFriend ;
                $andV = " and ";
            }
            
            if($employerTitle != "" ){
                 $whereCl .= $andV . ' u.id in (select idUser from #__elg_ergasia_employees_experiences where id in    
                  (select idCandidateExperience from #__elg_ergasia_candidate_experience_translation where employerTitle like ' . $db->quote($employerTitle, false) . '))';               
                $andV = " and "; 
            }
            if($filters->idIndustry >0 ){
                $whereCl .= $andV . ' u.id in (select idUser from #__elg_ergasia_employees_experiences where idIndustry = ' . $filters->idIndustry . ')'; 
                $andV = ' and '; 
            }

            
            if($filters->idSpecialitySpecilities > 0 ){
                $whereCl .= $andV . " spe.idSpeciality = " . $filters->idSpecialitySpecilities ;
                $andV = " and "; 
            }
            
            if($filters->experienceSpecialities > 0 ){
                $whereCl .= $andV . " spe.experience = " . $filters->experienceSpecialities ;
                $andV = " and "; 
            }            
            
            if($filters->idRankSpecialities > 0 ){
                $whereCl .= $andV . " spe.idRank = " . $filters->idRankSpecialities ;
                $andV = " and "; 
            }           
            
            if($educationTitle != '' ){
                 $whereCl .= $andV . ' u.id in ( select idUser from #__elg_ergasia_candidate_education where id  in  ( select idCandidateEducation from #__elg_ergasia_candidate_education_translation where educationTitle like ' . $db->quote($educationTitle, false) . ')) ';
                $andV = " and "; 
            }
            
            
            if($educationInstitute != ''  ){
                $whereCl .= $andV . ' u.id in ( select idUser from #__elg_ergasia_candidate_education where id  in  ( select idCandidateEducation from #__elg_ergasia_candidate_education_translation where educationInstitute like ' . $db->quote($educationInstitute, false) . ')) ';
                // $whereCl .= $andV . " ifNull(edut.educationInstitute, edutd.educationInstitute) like " . $db->quote($educationInstitute, false)  ;
                $andV = " and "; 
            }
            
            if($filters->idDegreeLevel > 0  ){
                $whereCl .= $andV . ' u.id in ( select idUser from #__elg_ergasia_candidate_education where idDegreeLevel =  ' . $filters->idDegreeLevel . ') ';
                $andV = ' and '; 
            }
            
            if($filters->idSpecializationEducation > 0  ){
                $whereCl .= $andV . ' u.id in ( select idUser from #__elg_ergasia_candidate_education where idSpecialization =  ' . $filters->idSpecializationEducation . ') ';
                $andV = ' and '; 
            }
            
            
            if($spokenLanguage != ''  ){
                $whereCl .= $andV . ' u.id in (select idUser from #__elg_ergasia_candidate_spokenlanguage where id in (select idSpokenLanguage from #__elg_ergasia_candidate_spokenlanguage_translation where spokenLanguage like ' . $db->quote($spokenLanguage, false) . ')) ';
                $andV = ' and '; 
            }
            
            if($filters->idRankLanguage > 0  ){
                $whereCl .= $andV . ' u.id in (select idUser from #__elg_ergasia_candidate_spokenlanguage where idRank = ' . $filters->idRankLanguage . ')'  ;
                $andV = ' and ' ; 
            }
            
            
            if($filters->lastmodified != '') 
            {
                $whereCl .= $andV . ' lu.dateModified > = ' . $db->quote($filters->lastmodified)  ;
                $andV = ' and ';
            }
            
            if($filters->idSectionPreference != '' )
            {
                $whereCl .= $andV . " u.id in (select idUser from #__elg_ergasia_candidates_sectionspreferences where idCounty = $filters->idSectionPreference) ";
                $andV = " and ";
                
            }
            
            if($filters->idHour != '' )
            {
                $whereCl .= $andV . " u.id in (select idUser from #__elg_ergasia_candidates_hours where idHour = $filters->idHour) ";
                $andV = " and ";
                
            }
            
            if( $filters->idSpecialityPreference != '' && $filters->idSpecialityPreference > 0 )
            {
                 $whereCl .= $andV . " u.id in (select idUser from #__elg_ergasia_candidate_preferencesspecialities where idSpeciality = $filters->idSpecialityPreference) ";
                 $andV = " and ";
               
            }
            
            if($filters->idRelationPreference != '')
            {
                 $whereCl .= $andV . " u.id in (select idUser from #__elg_ergasia_candidate_relationtypes where idRelationType = $filters->idRelationPreference) ";
                 $andV = " and ";
                 
            }
            
			if($filters->idUserTeam != '')
            {
                 $whereCl .= $andV . " u.id in (select idUserTeam from #__elg_ergasia_candidate_team) or u.id in (select idUser from #__elg_ergasia_candidate_team) ";
                 $andV = " and ";
                 
            }
            
            if ( ! Utils::canUserEditData('', 0)):
                $whereCl .= $andV . " eb.useMyData = 1 ";
                $andV = " and ";
            endif;
            
            if($whereCl != '') {
                $query->where($whereCl);
            }
       // }
        $query->setLimit($filters->limit, $filters->limitstart);
        //echo $query->dump();
        $db->setQuery($query);
        $state->set('data', $db->loadObjectList());
        $query->clear('order');
        $query->clear('select');
        $query->clear('group');
        $query->select('count(distinct u.id)');
        $query->setLimit(1, 0);
      //  $db->setQuery($query);
        $totalRecords =  $db->loadResult();
        $pagination = CommonUtils::getPagination($totalRecords, $filters->limitstart, $filters->limit);
        $specialitySearch = null;
        if($filters->idSpecialization !== '' )
        {
                $query->clear();
                $query->select('speciality, industry, sp.idIndustry,spet.slug')->from('#__elg_ergasia_speciality_translation spet')
                        ->innerJoin('#__elg_ergasia_speciality sp on sp.id = spet.idSpeciality and spet.language = \'' . $currentLanguage . '\' and idSpeciality in (' . $filters->idSpecialization .') ')
                        ->innerJoin('#__elg_ergasia_industry ind on sp.idIndustry = ind.id')
                        ->innerJoin('#__elg_ergasia_industry_translation indt on indt.idIndustry = ind.id and indt.language = \'' . $currentLanguage . '\'' );

                $specialitySearch = $db->loadObject();
				
        }
		
		if($specialitySearch == null){
			$specialitySearch = new stdClass();
			$specialitySearch->speciality = '';
			$specialitySearch->industry = '';
			$specialitySearch->idIndustry = 0;
			$specialitySearch->slug = '';
		}
		
        $state->set('specialitySearch', $specialitySearch);
        $sectionSearch = '';
		if($filters->idSectionPreference != '')
		{
			$query->clear();
			$query->select('section')->from('#__elg_section_translation')->where('idSection=' . $filters->idSectionPreference . ' and language = \'' . $currentLanguage . '\'');
			$sectionSearch = $db->loadResult();
		}
		$state->set('sectionSearch', $sectionSearch);
        $state->set('pagination', $pagination);
        $state->set('form', $form);
        return $state;
    }
    
   
}