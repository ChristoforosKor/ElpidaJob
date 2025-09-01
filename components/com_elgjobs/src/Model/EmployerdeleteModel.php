<?php

namespace ELG\Component\ElgJobs\Site\Model;

defined('_JEXEC') or die('Restricted access');

/* ------------------------------------------------------------------------
  # com_elgergasia - e-logism job agency application
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (c) 2010-2050 e-logism.com. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.gr


  ----------------------------------* */

use Joomla\CMS\MVC\Model\BaseDatabaseModel;

class EmployerdeleteModel extends BaseDatabaseModel {

    private $isNew = true;

    public function delete($pk) {
	$state = $this -> getState();
	$state -> set('errors', []);
	        
	$table = $this->getTable('Employer');
        if ( !$table->delete($pk) ) 
	{
		$tableErrors =  $table -> getErrors();
		$errors = $state -> get('errors', []);		
		forEach( $tableErrros  as $error )
		{		
			$errors[] = $error;
		}
		unset($error);
		$state -> set('errors', $errors);
		return false;	 
	}		
          	

        return true;
    }

 
}
