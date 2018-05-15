<?php
require_once JPATH_COMPONENT_SITE . '/libraries/tbs/tbs_class.php';
require_once JPATH_COMPONENT_SITE . '/libraries/tbs/tbs_plugin_opentbs.php';



class ElgErgasiaControllerMakeCV extends JControllerBase{
          
        
      
        public function execute() {
			$tbs = new clsTinyButStrong;
			$data = new stdClass();
		
			$tbs->Plugin(TBS_INSTALL, OPENTBS_PLUGIN);
			$tbs->LoadTemplate(JPATH_SITE . '/media/com_elgergasia/templates/cvtmpl.odt', OPENTBS_ALREADY_UTF8); // Load the archive 'document.odt'.
			$idUser = $this->input->getInt('id', 0);
			
			
			if($idUser > 0)
			{
			
				$db = JFactory::getDBO();
				$query = $db->getQuery(true);
				$db->setQuery($query);
				$query->select('u.id, u.name as fullname, cc.dateOfBirth, cbt.address, cnt.country as nationality, mtr.maritalStatus')
				->from('#__users u')
				->innerJoin('#__elg_ergasia_candidate_characteristic cc on cc.idUser = u.id')
				->innerJoin('#__elg_maritalstatus_translation mtr on mtr.idMaritalStatus = cc.idMaritalStatus and mtr.language = \'el-GR\'')
				->innerJoin('#__elg_ergasia_candidate_basic cb on cb.idUser = u.id')
				->innerJoin('#__elg_ergasia_candidate_basic_translation cbt on cb.id = cbt.idCandidateBasic and cbt.language=\'el-GR\'')
				->innerJoin('#__elg_country cn on cn.id = cc.idNationality')
				->innerJoin('#__elg_country_translation cnt on cn.id = cnt.idCountry and cnt.language = \'el-GR\' where u.id = ' . $idUser );
			
				$basic = $db->loadObject();
				$tbs->MergeField('f', array('id'=>$basic->id,'fullname'=>$basic->fullname, 'dateOfBirth'=>$basic->dateOfBirth, 'address'=>$basic->address, 'nationality'=>$basic->nationality, 'maritalstatus'=>$basic->maritalStatus));
				$data->basic = ($basic == null ? array('id'=>0, 'fullname'=>'', 'dateOfBirth'=>'', 'address'=>'', 'nationality'=>'' ) : $basic);
				$query->clear();
				$query->select('educationInstitute, educationTitle')
					->from('#__elg_ergasia_candidate_education ce')
					->innerJoin('#__elg_ergasia_candidate_education_translation cet on ce.id = cet.idCandidateEducation and ce.idUser = ' . $idUser . ' and cet.language = \'el-GR\''); 
				
				$data->education = $db->loadAssocList();
				
				$query->clear();
				$query->select('str.speciality, cs.experience')
				->from('#__elg_ergasia_candidate_speciality cs')
				->innerJoin('#__elg_ergasia_speciality sp on cs.idSpeciality = sp.id and cs.idUser = ' . $idUser)
				->innerJoin('#__elg_ergasia_speciality_translation str on sp.id = str.idSpeciality and str.language = \'el-GR\'');
				$data->speciality = $db->loadAssocList();
				
				$query->clear();
				$query->select('slt.spokenLanguage, rtr.rankFem')
					->from('#__elg_ergasia_candidate_spokenlanguage sl')
					->innerJoin('#__elg_ergasia_candidate_spokenlanguage_translation slt on slt.idSpokenLanguage = sl.id and sl.idUser = ' . $idUser . ' and slt.language = \'el-GR\'')
					->innerJoin('#__elg_rank_translation rtr on sl.idRank = rtr.idRank and rtr.language = \'el-GR\'');
				$data->languages = $db->loadAssocList();	
				
				$query->clear();
				$query->select('cetr.employerTitle, ce.dateFrom, ce.dateTo, itr.industry, str.speciality')
				->from('#__elg_ergasia_employees_experiences ce')
				->innerJoin('#__elg_ergasia_candidate_experience_translation cetr on ce.id = cetr.idCandidateExperience and cetr.language = \'el-GR\' and ce.idUser = ' . $idUser )
				->innerJoin('#__elg_ergasia_industry_translation itr on ce.idIndustry = itr.idIndustry and itr.language=\'el-GR\'')
				->innerJoin('#__elg_ergasia_speciality_translation str on ce.idSpecialization = str.idSpeciality and str.language = \'el-GR\''); 
				$data->experience = $db->loadAssocList();
			
				$merge = array();
				
				
				
				
				$merge['b1'] = $data->education;
				$merge['b2'] = $data->speciality;
				$merge['b3'] = $data->languages;
				$merge['b4'] = $data->experience;
				$tbs->MergeBlock('b1',$merge['b1']);
				$tbs->MergeBlock('b2',$merge['b2']);
				$tbs->MergeBlock('b3',$merge['b3']);
				$tbs->MergeBlock('b4',$merge['b4']);
				$tbs->Show(OPENTBS_DOWNLOAD, 'candidate_' . $idUser);
			}
			exit();
        }
         
        
}
?>