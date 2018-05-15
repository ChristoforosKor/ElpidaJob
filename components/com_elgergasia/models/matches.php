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
  
 
 class ElgergasiaModelMatches extends JModelDatabase{  
       
    function getState() {        
        $state = parent::getState();
        $filters = $state->get('filters', null);
        if($filters ==null)
        {
            $state->set('data', array());
        }
        else
        {
            if($filters->idJob <= 0)
            {
                $state->set('data', array());
            }
            else
            {
                $db = $this->getDb();
                $query = $db->getQuery(true);
                $db->setQuery($query);
                $query->clear();
                $query->select('ps.idUser, u.`name`,  ifNull(csp.experience, 0) as experience, group_concat(ifNull(cedtr.educationTitle, \'\')) as educationTitle, group_concat(ifNull(cedtr.educationInstitute, \'\')) as educationInstitute, sum(ifNull(dl.ordering, 0)) as degreeLevelSum')
                ->from('#__elg_ergasia_candidate_preferencesspecialities ps') 
                ->innerJoin('#__elg_ergasia_job j on ps.idSpeciality = j.idSpeciality and j.id = ' .$filters->idJob)
                ->innerJoin('#__elg_county cn on cn.id = j.idCounty') 
                ->innerJoin('#__elg_section se on se.id = cn.idSection')
                ->innerJoin('#__elg_ergasia_candidates_sectionspreferences sep on sep.idSection = se.id and sep.idUser = ps.idUser')
                ->innerJoin('#__users u on u.id = ps.idUser')
                ->leftJoin('#__elg_ergasia_candidate_speciality csp on csp.idSpeciality = j.idSpeciality and csp.idUser = ps.idUser')
                ->leftJoin('#__elg_ergasia_candidate_education ced on ced.idSpecialization = j.idSpeciality and ced.idUser = ps.idUser')
                ->leftJoin('#__elg_ergasia_degree_level dl on dl.id = ced.idDegreeLevel') 
                ->leftJoin('#__elg_ergasia_candidate_education_translation cedtr on ced.id = cedtr.idCandidateEducation and cedtr.isDefault = 1')
                ->group('ps.idUser, u.`name`,  experience')
                ->order('experience desc, degreeLevelSum desc');
                $data = $db->loadObjectList();
                $state->set('data', $data);
            }
        }
        return $state;
    }
}