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



class EmployersavefileModel extends BaseDatabaseModel {

    protected $commonUtils;
    public function __construct($config = [], \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null) {
        $this -> commonUtils = isset( $config['commonUtils'])  ? $config['commonUtils'] : null;
        parent::__construct($config, $factory);
    }
    
    public function save(\stdClass $data) {
        
        if ( $data -> idEmployer === 0) {
            throw new \Exception('No employer id provided');
        }
        
        
        if ( count( $data -> files ) === 0 ) {
            throw new \Exception('No files submitted');
        }
                
        $folderPath = JPATH_SITE . '/images/employer/docs/' . $data -> idEmployer; 
        $results = $this -> commonUtils -> storeDocument( $folderPath, $data -> files );
        return $this -> storeToDB( $results, $data );
    }
    
    public function storeToDB( $results, $data ) 
    {
        $errors = [];
        foreach ( $results as $uploadedFile => $storedFile )
        {
            if ( $storedFile === '') 
            {
                continue;
            }
            $errors[$uploadedFile] = $this -> storeFilePathToDB($data -> idEmployer, $data -> idJob, $storedFile);
                        
        }
        unset ( $uploadedFile );
        unset ( $storedFile );
        return $errors;
    }

   
    private  function storeFilePathToDB($idEmployer, $idJob, $documentFilePath) {
	$table = $this -> _createTable('Employerjobdocument');
        $table -> id = null;
        $table -> idJob = ( $idJob === 0 ? null : $idJob);
        $table -> idEmployer = $idEmployer;
        $table -> documentFilePath = str_replace(JPATH_SITE, '', $documentFilePath);
        $table -> store();
        return  $table -> getErrors();
    }
	
    
}
