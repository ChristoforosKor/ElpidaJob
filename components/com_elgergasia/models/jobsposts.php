<?php

/* ------------------------------------------------------------------------
  # com_elgergasia - e-logism job agency application
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.gr
  ----------------------------------* */

defined('_JEXEC') or die('Restricted access');

class ElgergasiaModelJobsPosts extends JModelDatabase {

    function getState() {
        $state = parent::getState();
        $filters = $state->get('filters');
        $db = $this->getDb();
        $lang = JFactory::getLanguage()->getTag();
        $query = $db->getQuery(true);
        $sDate = ($filters -> submitDate != '' ? ComponentUtils::getDateFormated($filters -> submitDate, 'd/m/Y', 'Y-m-d'): '');
        $sDateTo = ($filters -> submitDateTo != '' ? ComponentUtils::getDateFormated($filters -> submitDateTo, 'd/m/Y', 'Y-m-d'): '');
        if ($filters -> idJobState === 0):
            $filters -> idJobState = 2;
        endif;
        $query->select("distinct j.id, s.speciality, j.submitDate, ifNull(j.extUrl, '') as extUrl,  ifNull(jt.jobTitle, jd.jobTitle) as jobTitle , ifNull(et.discreteTitle, etd.discreteTitle) as discreteTitle, "
                . "st.jobState, jobSalary, jp.jobPhoto, jp.photoExtension, "
                . "ifNull(jt.jobDescription, jd.jobDescription) as jobDescription, "
                . "ifNull(jt.jobComment, jd.jobComment) as jobComment, j.daysOff, ct.county")
                ->from("#__elg_ergasia_job j")
                ->innerJoin("#__elg_ergasia_speciality_translation s on j.idSpeciality = s.idSpeciality "
                        . ($filters->idSpeciality > 0 ? ' and s.idSpeciality = ' . $filters->idSpeciality : '')
                        . ($filters->jobSalary > 0 ? ' and j.jobSalary >= ' . $filters->jobSalary : '')
                        . ($filters->jobSalaryTo > 0 ? ' and j.jobSalary <= ' . $filters->jobSalaryTo : '')
                        . ($filters->idOldPeople > 0 ? ' and j.idOldPeople = ' . $filters->idOldPeople : '')
                        . ($filters->daysOff > 0 ? ' and j.daysOff >= ' . $filters->daysOff : '')
                        . ($filters->daysOffTo > 0 ? ' and j.daysOff <= ' . $filters->daysOffTo : '')
                        . ($filters->idHour > 0 ? ' and j.idHour = ' . $filters->idHour : '')
                        . ($filters->idMedicalCare > 0 ? ' and j.idMedicalCare = ' . $filters->idMedicalCare : '')
                        . ($sDate != '' ? ' and j.submitDate >= \'' . $sDate . '\'' : '') 
                        . ($sDateTo != '' ? ' and j.submitDate <= \'' . $sDateTo . '\'' : '') 
                        . ($filters->idCounty >  0 ? ' and j.idCounty = ' . $filters -> idCounty : '') 
                        . ($filters->id > 0 ? ' and j.id = ' . $filters->id : '') .
                        
                        " and s.language = '$lang'")
                ->innerJoin('#__elg_ergasia_employer e on e.idUser = j.idUser ' . ($filters->idUser > 0 ? ' and j.idUser = ' . $filters->idUser : ''))
                ->leftJoin("#__elg_ergasia_job_translation jt on j.id = jt.idJob and jt.language = '" . $lang . "'")
                ->leftJoin("#__elg_ergasia_job_translation jd on j.id = jd.idJob and jd.isDefault = 1")
                ->leftJoin("#__elg_ergasia_employer_translation et on e.id = et.idEmployer and et.language = '" . $lang . "'")
                ->leftJoin("#__elg_ergasia_employer_translation etd on e.id = etd.idEmployer and etd.isDefault = 1")
                ->innerJoin('#__elg_ergasia_jobstates st on j.idJobState = st.id ' . (Utils::canSeeContactInfo() ? ($filters->idJobState > 0 ? ' and j.idJobState = ' . $filters->idJobState : '') : ' and j.idJobState = 2 ') . ' and st.language=\'el-GR\'')
                ->leftJoin('#__elg_ergasia_job_photo jp on jp.idJob = j.id and idPhotoType=1')
                -> leftJoin ('#__elg_county_translation ct on j.idCounty = ct.idCounty and ct.language = ' . $db -> quote( $lang ) )
                ->order('idJobState, id desc');
        $where = ' idJobState =  ' . $filters -> idJobState ;
        $andV = ' and ';
        $jobTitle = ($filters->jobTitle != "" ? '%' . $db->escape($filters->jobTitle) . '%' : "");
        if (trim($jobTitle) != '') {
            $where .= " $andV  ifNull(jt.jobTitle, jd.jobTitle) like '%" . $jobTitle . "%'";
            $andV = ' and ';
        }
        if (trim($filters->id) > 0) {
            $where .= " $andV  j.id = " . $filters->id;
            $andV = ' and ';
        }
        if(trim($filters -> employer) !=  '' ) :
            $where .= " $andV  (et.discreteTitle  like '%" . $filters->employer . "%' or etd.discreteTitle like '%" . $filters->employer . "%')";
            $andV = ' and ';
        endif;
        if ($where != '') {
            $query->where($where);
        }

        $db->setQuery($query, $filters->limitstart, $filters->limit);
        $state->set('data', $db->loadObjectList());
        $query->clear('order');
        $query->clear('select');
        $query->select('count(distinct j.id)');
        $db->setQuery($query);

        $totalRecords = $db->loadResult();
        $pagination = CommonUtils::getPagination($totalRecords, $filters->limitstart, $filters->limit);
        $state->set('pagination', $pagination);
        $form = JForm::getInstance('jobsquicksearch', JPATH_COMPONENT_SITE . '/models/forms/jobs.xml');
        $form->setValue('idUser', null, $filters->idUser);
        $form->setValue('idIndustry', null, $filters->idIndustry);
        $form->setValue('idJobState', null, $filters->idJobState);
        $form->setValue('jobTitle', null, $filters->jobTitle);
        $form->setValue('idSpeciality', null, $filters->idSpeciality);
        $form->setValue('idHour', null, $filters->idHour);
        $form->setValue('idOldPeople', null, $filters->idOldPeople);
        $form->setValue('idMediclaCare', null, $filters->idMedicalCare);
        $form->setValue('daysOff', null, $filters->daysOff);
        $form->setValue('daysOffTo', null, $filters->daysOffTo);
        $form->setValue('id', null, $filters->id);
        $form->setValue('submitDate', null, $sDate);
        $form->setValue('submitDateTo', null, $sDateTo);
        $form->setValue('jobSalary', null, $filters->jobSalary);
        $form->setValue('jobSalaryTo', null, $filters->jobSalaryTo);
        $form->setValue('employer', null, $filters -> employer);
        $form->setValue('idCounty', null, $filters -> idCounty);
        
        
        $specialitySearch = '';
        if ($filters->idSpeciality > 0) {
            $query->clear();
            $query->select('speciality')->from('#__elg_ergasia_speciality_translation')->where('idSpeciality=' . $filters->idSpeciality . ' and language = \'' . $lang . '\'');
            $specialitySearch = $db->loadResult();
        }

        $state->set('specialitySearch', $specialitySearch);
        $state->set('form', $form);
        return $state;
    }

}
