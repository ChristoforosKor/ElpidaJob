<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
	require JPATH_COMPONENT_SITE . '/controllers/candidates.php';
// require 'controllerview.php';
class ElgergasiaControllerCandidatesSearch extends ElgergasiaControllerCandidates
{
	/* public function __construct($input = null, $app = null)
	{
		$this->getInput()->set('model', 'candidates');
		//$this->request['model'] = 'candidates';
		parent::__construct($input, $app);
	} */
// class ElgergasiaControllerCandidatesSearch extends ElgergasiaControllerControllerView{
    // public function __construct($input = null, $app = null) {
        // $this->requestedKeys = array(
            // 'idUser'=> array('INT', 0),
            // 'fullname'=> array('STRING',''),
            // 'username'=> array('STRING',''),
            // 'email'=> array('STRING', ''),
            // 'idCountry'=>  array('INT', 0),
            // 'city' => array('STRING', ''), 
            // 'address' => array('STRING', ''),
            // 'postalCode' => array('STRING', ''),
            // 'telephone' => array('STRING', ''),
            // 'idGender' => array('INT', 0), 
            // 'dateOfBirth' => array('STRING', ''),
            // 'idNationality' => array('INT', 0),
            // 'idMilitaryStatus' => array('INT', 0),
            // 'idMaritalStatus' => array('INT', 0),
            // 'childrenNum' => array('', ''),
            // 'idReligion' => array('INT', 0),
            // 'smoking' => array('STRING', 0),
            // 'idPetFriend' => array('INT', 0),
            // 'idIndustry' => array('INT', 0),
            // 'idSpecialization' => array('INT', 0),
            // 'employerTitle' => array('STRING', ''),
            // 'idSpecialitySpecilities' => array('INT', 0),
            // 'idRankSpecialities' => array('INT', 0),
            // 'educationTitle' => array('STRING', ''),
            // 'educationInstitute' => array('STRING', ''),
            // 'idDegreeLevel' => array('idDegreeLevel', ''),
            // 'idSpecializationEducation' => array('INT', 0),
            // 'spokenLanguage' => array('STRING', ''),
            // 'idRankLanguage' => array('INT', 0),
            // 'experienceSpecialities' =>array('STRING', ''),
            // 'isFullSearch' =>array('INT', 0),
            // 'idSectionPreference'=>array('INT', 0),
            // 'lastmodified'=>array('STRING', 0),
            // 'idCandidateState'=>array('INT', 0),
            // 'idSectionPreference'=>array('INT', 0),
            // 'idHour'=>array('INT', 0),
            // 'idSpecialityPreference'=>array('INT', 0),
            // 'idRelationPreference'=>array('INT', 0),
            // 'limitstart'=>array('INT',0),
            // 'limit'=>array('INT', 15),
            // 'filter_order_Dir'=>array('STRING',''),
            // 'filter_order'=>array('STRING', '')
        // );
        // parent::__construct($input, $app);
        // $this->setRequestedValues();
        // $this->setList('fullname');
    // }
 
    
    protected function setSessionNamespace() {
        parent::setSessionNamespace();
        $this->sessionNamespace .= '.fullsearch.data';
    }
}
