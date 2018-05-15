<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
require_once JPATH_COMPONENT_ADMINISTRATOR . '/tables/ergasiauser.php';
/**
 * JTable class for employee's personal data
 *
 * @author e-logism
 */
class JTableCandidateCharacteristic extends JTableErgasiaUser {
    var $id = null;
    var $idUser = null;
    var $idGender = null;
    var $dateOfBirth = null;
    var $idNationality = null;
    var $idMilitaryStatus = null;
    var $idMaritalStatus = null;
    var $childrenNum = null;
    var $idReligion = null;
    var $idPapers = null;
    var $smoking = null;
    var $idPetFriend = null;
    var $idDriverLicene = null;
       
    
    
    function __construct( $db) {
        parent::__construct( '#__elg_ergasia_candidate_characteristic', 'id', $db );
    } 
}
