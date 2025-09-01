<?php

namespace  ELG\Component\ElgJobs\Site\Controller;

defined('_JEXEC') or die;

//use Joomla\CMS\MVC\Controller\BaseController;
use ELG\Component\ElgJobs\Site\Controller\ElgController;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\Input\Input;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface; 
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\Response\JsonResponse;
//use Joomla\CMS\Router\Route;
//use ELG\Component\ElgJobs\Site\Model\Helpers\ModelHelper;

/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 *
 * 
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence. 
 * 
 */

/**
 * ELG Job Controller
 * @since  0.0.1
 */
class JobController extends ElgController {

   
   
    public function __construct($config = [], MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null) {
        parent::__construct($config, $factory, $app, $input, $formFactory);
        $this -> viewEditItem = '/epexergasia-aggelias';
        $this -> viewList = '/aggelies.html?view=jobs';
    }
   
      
   
    protected function getSubmitedData( Input $input) {
        
        $data = $this->input->post->get('jobForm', [], 'array');
        $data['postcode'] = str_replace(' ', '', $data['postcode']);
        if ( $data['idSpecialNeed'] == '' ) {
            $data['idSpecialNeed'] = 0;
        }
        $files = $this -> input -> files -> get('jobForm', [], 'array');
       
        if ( isset( $files['documentFile'] ) ) {
			
			$data['documentFile'] = $files['documentFile'];
		}
		else {
			
			$data['documentFile'] = [];
		}
		
        return $data;
    }
    
    
    public function deleteFile() {
		$app = Factory::getApplication();
		$input = $app -> input;
		$id = $input -> getInt('id', 0);
		header('Content-Type: application/json');
		if ( $id == 0 ) {
			echo new JSONResponse( ["id" => $id, "result" => false], "Δώσατε μη έγκυρο αρχειό προς διαγραφή.");
			exit;
		}
		$db = Factory::getDBo();
		$query = $db -> getQuery(true);
		$query -> select("documentFilePath") -> from ("#__elg_ergasia_employer_jobdocument") -> where ("id = " . $id );
		$filePath = $db -> setQuery($query) -> loadResult();
		
                if ( $filePath == null ) {
			echo new JSONResponse(["id" => $id, "result" => false], "Δεν βρέθηκε εγγραφή για το αρχείο που δώσατε." );
			exit;
		}
		
		
		
		$query -> clear();
 		$query -> delete("#__elg_ergasia_employer_jobdocument") -> where (" documentFilePath = " . $db -> quote( $filePath)  );
		try {
			$db -> setQuery($query) -> execute();
			echo new JSONResponse(["id" => $id,"result" => true], "Η διαγραφή πραγματοποιήθηκε επιτυχώς.");
                        
			unlink(JPATH_SITE ."/" .$filePath);
			exit;
		}
		catch(Exception $e) {
			echo new JSONResponse( ["id" => $id, "result" => false],"Σφάλμα " . $e -> getMessage() . ". Η διαγραφή δεν πραγματοποιήθηκε.");
			
			exit;
		}
                
//                $fileOnDisk = JPATH_SITE ."/" .$filePath;
//		if ( !is_file($fileOnDisk) ) {
//			echo new JSONResponse(["id" => $id, "result" => false], "Δεν βρέθηκε φυσικό αρχειό για την εγγραφή που δώσατε.");
//			exit;
//		}
	}
    
    
    public function getSaveModel($name = 'Jobsave', $prefix = '', $config = ['ignore_request' => true]) {
       
        return parent::getModel($name, $prefix, $config);
    }

}
