<?php
namespace  ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\FormModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;


class JobModel extends FormModel {

    public function getItem($pk = null) {
        if ( $pk === null) {
            $pk =0;
        }
        
        $db = $this -> getDbo();
        $langTag = $db -> quote( Factory::getLanguage()->getTag() );
        $groups = Factory::getUser() -> getAuthorisedGroups();
        if ( in_array(12, $groups) ) {
            $this -> isAuthorised = 1;
        }
        else {
                $this -> isAuthorised = 0;
        }
        if ( $this -> isAuthorised == 1 ) {
            $jobState = " ";
        }
        else {
            $jobState = " j.idJobState = 2 and ";
        }
        $query = $db->getQuery(true);
        $query->select(" j.id, j.daysOff, j.submitDate, ht.`hour`, j.jobSalary, snt.specialNeed, jt.jobTitle, j.idEmployer "
                . ", jt.jobDescription, j.areasize "
                . ", g.city, g.county,  g.country, g.address, g.postcode, g.lat, g.lng"
                . ", j.idHour, j.idJobState, j.idSpeciality, snt.idSpecialNeed"
                . ", group_concat(jd.documentFilePath) as documents, group_concat(jd.id) as idDocuments, jst.jobState, j.idCandidate")
                ->from("#__elg_ergasia_job j")
                ->innerJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language =  " . $langTag)
                ->leftJoin("#__elg_ergasia_hour_translation ht on j.idHour = ht.idHour and ht.LANGUAGE = " . $langTag)
                ->leftJoin("#__elg_ergasia_medicalcare_translation mc on mc.idMedicalCare = j.idMedicalCare and mc.language = " . $langTag)
                -> leftJoin ("#__elg_ergasia_specialneeds_translation snt on snt.idSpecialNeed = j.idSpecialNeed and snt.language = " . $langTag )
                -> leftJoin ("#__elg_ergasia_jobstates jst on jst.id = j.idJobState and jst.language = " . $langTag )
                -> leftJoin ("#__elg_ergasia_employer_jobdocument  jd on jd.idJob = j.id " )
                ->leftJoin("#__elg_geo g on g.id = j.idGeo")
                -> where( $jobState . " j.id = " . $pk);
        $item = $db -> setQuery($query) -> loadObject();
        
        if ( $item == null ) {
            return $this -> getNullObject();
        }
        
        if ( $item->idCandidate == '' ) {
            $item->candidates = [];
            return $item;
        }
        
        $query->clear();
        $query->select('id, name, address, postcode, suburb,  mobile, telephone, image ')
                ->from('#__contact_details')
                ->where("id in (" . $item->idCandidate . ")");
        $candidates = $db->setQuery($query)->loadObjectList();
        $item->candidates = $candidates;
        return $item ;
    }
    
    
    private function getNullObject() {
        $item = new \stdClass();
        $item -> id = 0;
        $item -> daysOff = 0;
        $item -> submitDate = '';
        $item -> hour = '';
        $item -> jobSalary = 0;
        $item -> jobCity = '';
        $item -> areasize = '';
        $item -> medicalCare = '';
        $item -> jobTitle = '';
        $item -> title = '';
        $item -> description = '';
        $item -> lat = 0;
        $item -> lng = 0; 
        $item -> specs = [];
        return $item;
    }


    public function getForm($data = [], $loadData = true): Form {

        $form = Form::getInstance('job', JPATH_COMPONENT_ADMINISTRATOR . '/forms/job.xml');
        
        if ( $loadData ) {
            $form -> bind($data);
        }
        if ( $form->getValue('idJobState') == ''):
            $form->setValue('idJobState', null, 2);
        endif;
        $form->setValue("idUser", null, Factory::getUser() -> id);
        return $form;
    }
     
    public function getFormEmployer( $data =[], $lodaData = true ): Form {
			$form = Form::getInstance('employer', JPATH_COMPONENT_ADMINISTRATOR, '/form/employer.xml');
			if ( $loadData ) {
				$form -> bind($data);
			}
			
			return $form;
    
	}
}
