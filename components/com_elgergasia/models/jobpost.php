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
 require_once JPATH_COMPONENT_SITE . '/models/matches.php';
 
 class ElgergasiaModelJobPost extends JModelDatabase{ 

 
   
    
    public function __construct($state = null, $db = null) {
        parent::__construct($state, $db);
    }   
    
    function getState() {
        $lang = JFactory::getLanguage()->getTag();
        $state = parent::getState();
        $id = $state->get('id');
        $db = $this->getDb();
        $query = $db->getQuery(true);
        $query->select(" j.id, j.submitDate, j.minExperience, ifNull(jt.jobTitle, jd.jobTitle) as jobTitle, ifNull(jt.jobDescription, jd.jobDescription) as jobDescription, ifNull(j.extUrl, '') as extUrl "
                . ", ifNull(jt.jobComment, jd.jobComment) as jobComment, s.speciality, ifNull(et.discreteTitle, etd.discreteTitle) as discreteTitle, "
                . "js.jobState, dl.degreeLevel, cn.county , jobCost, jobSalary, j.idDegreeLevel, j.idSpeciality, j.daysOff, op.oldPeople, mc.medicalCare,h.hour  ")
                ->from("#__elg_ergasia_job j")
                ->leftJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language ='$lang'")
                ->leftJoin("#__elg_ergasia_job_translation jd on j.id = jd.idJob and jd.isDefault = 1")
                ->leftJoin("#__elg_ergasia_oldpeople op on op.id = j.idOldPeople")
                ->leftJoin("#__elg_ergasia_medicalcare mc on mc.id = j.idMedicalCare")
                ->leftJoin("#__elg_ergasia_hour h on h.id = j.idHour")
                ->innerJoin("#__elg_ergasia_speciality_translation s on j.idSpeciality = s.idSpeciality and s.language ='$lang'")
                ->join("inner", "#__elg_ergasia_employer e on e.idUser = j.idUser")
                ->join("left", "#__elg_ergasia_employer_translation et on e.id = et.idEmployer and et.language ='$lang'")
                ->join("left", "#__elg_ergasia_employer_translation etd on e.id = et.idEmployer and etd.isDefault = 1")
                ->join("left", "#__elg_ergasia_jobstates js on j.idJobState = js.id and js.language='$lang'" )
                ->join("left", "#__elg_ergasia_degree_level_translation dl on j.idDegreeLevel = dl.idDegreeLevel and dl.language = '$lang'")
                ->join("left", "#__elg_county_translation cn on j.idCounty = cn.idCounty and cn.language = '$lang'" )
              ->where("j.id = " . $id);
        $db->setQuery($query);   
      
        $data = $db->loadObject();
        if (!isset($data)) {
            $data = $this->getNullObject();
        }
		$query->clear();
		$query->select('id, idJob, jobPhoto, photoExtension')
		->from('#__elg_ergasia_job_photo')
		->where('idJob=' . $id);
		$dataPhotos = $db->loadObjectList();
        $mstate = new JRegistry();
        $filters = new stdClass();
        $filters->idJob = $data->id;
        $state->set('itemData', $data);
        $state->set('photos', $dataPhotos);
        return $state;
    }
    

    function getNullObject() {
        $nullObject = '{ "id": "0" , "submitDate": "", "minExperience" : "", "jobTitle" : "", "jobDescription" : "", "industry": ""
        , "phone": "", "mobile": "", "fax": ""
        , "discreteTitle" : "" , "jobState" : "" , "degreeLevel": "" }';
        return json_decode($nullObject);
    }  
}