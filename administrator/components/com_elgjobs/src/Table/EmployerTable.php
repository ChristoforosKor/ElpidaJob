<?php
/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 201 - 2023 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
namespace ELG\Component\ElgJobs\Administrator\Table;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

            
class EmployerTable extends Table {
    var $id = null;
    var $idCountry = null;
    var $idEmployerType = null;
    var $idIndustry = null;
    var $DiscreteTitle = null;
    var $EmpAddress = null;
    var $EmpArea = null;
    var $Zip = null;
    var $Telephone = null;
    var $Mobile = null;
    var $Fax = null;
    var $WebPage = null;
    var $Email = null;
    var $TaxNo = null;
    var $TaxOffice = null;
    var $Proffession = null;
    var $Comments = null;
    
    function __construct(DatabaseDriver $db) {
        parent::__construct( '#__elg_ergasia_employer', 'id', $db );
    } 
}
