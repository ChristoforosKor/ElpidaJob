<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 201 - 2023 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
namespace ELG\Component\ElgJobs\Administrator\Table;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

            
class PersonnelTable extends Table {
    var $id = null;
    var $idContact = null;
    var $showPhoto = null;
    var $showName = null;
    var $useMyData = null;
    var $dateOfBirth = null;
    var $idGender = null;
    var $idNationality = null;
    var $suggestUp = null;
    var $suggetDown = null;
    var $hiredTimes = null;
    
    
    function __construct(DatabaseDriver $db) {
        parent::__construct( '#__elg_ergasia_candidate_basic', 'id', $db );
    } 
}
