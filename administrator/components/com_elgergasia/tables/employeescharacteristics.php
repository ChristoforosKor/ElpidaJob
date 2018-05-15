<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

/**
 * JTable class for employee's personal data
 *
 * @author e-logism
 */
class TableEmployeesCharacteristics extends JTable {
    var $id = null;
    var $idUser = null;
    var $language = null;
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
    var $aboutMe = null;
    
    
    
    function __construct( $db) {
        parent::__construct( '#__elg_ergasia_employees_characteristics', 'id', $db );
    } 
}

?>
