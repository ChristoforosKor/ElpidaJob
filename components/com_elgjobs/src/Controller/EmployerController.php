<?php

namespace ELG\Component\ElgJobs\Site\Controller;
         

defined('_JEXEC') or die;

/*------------------------------------------------------------------------
# com_elgjobs - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

----------------------------------**/


use ELG\Component\ElgJobs\Site\Controller\ElgController;

use Joomla\CMS\Factory;
use ELG\Component\ElgJobs\Administrator\Table\EmployerTable;
use Joomla\Input\Input;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Response\JsonResponse;

       
class  EmployerController extends ElgController {
   
   
   
    public function __construct($config = [], \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null, ?\Joomla\CMS\Application\CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null) {
        parent::__construct($config, $factory, $app, $input, $formFactory);
        $this -> app -> setUserState('com_elgjobs.employerlist.filter', null);
    }
    
    protected function getSubmitedData(Input $input) {
        $data = $this->input->post->get('employerForm', [], 'array');
        if ( empty ($data['idCountry'] ) ) {
			$data['idCountry'] =  0 ;
		}
		
		if ( empty ($data['idIndustry'] ) ){ 
			$data['idIndustry'] = 0; 
		}

      
        return $data;
    }
    
    
    public function getForm($data =[], $loadData = true) {
		$form = Form::getInstance('employer', JPATH_COMPONENT_ADMINISTRATOR . '/forms/employer.xml', ['control' => 'employerForm']);
        
        if ( $loadData ) {
            $form -> bind($data);
        }  

        return $form;
		
	}
   
	public function getSaveModel($name = 'Employersave', $prefix = '', $config = ['ignore_request' => true]) {
        return parent::getModel($name, $prefix, $config);
    }
   
    public function getTableEmployer($name = 'Employer', $prefix = '', $options = []) {
        return new EmployerTable( Factory::getDBo() );
    }
    
    
    public function savedx() {
        $data = json_decode( $this -> input -> getRaw('values') );
        $id = $this -> input -> getInt("key", 0);
        if ( $id > 0 ){
            $data -> id = $id;
        }
        $model = $this ->createModel('Employersave');
        try {
            $model -> save ( $data );
            echo new JsonResponse();
        }
        catch(Exception $e) {
            echo new JsonResponse();
//            echo $e -> getMessage();
        }
        
        
    }
    
    
    public function uploaddx() {
      
        $result = false;
        try {
            $model =  $this -> factory ->createModel('Employersavefile', '', ['commonUtils' => $this -> commonUtils] ) ;
            $data = new \stdClass();
            $data -> idEmployer = $this -> input -> getInt('idEmployer', 0);
            $data -> idJob = $this -> input -> getInt('idJob', 0 );
            $data -> files = $this -> input -> files -> get('files', [], 'array') ;
            $result = $model -> save($data);
            
        }
        catch( \Exception $e) {
            $this -> app ->enqueueMessage($e -> getMessage(), 'warning');
        }
        echo new JsonResponse($result);
       
    }
    
    
    public function save($key = null, $urlVar = null) {

        $app   = Factory::getApplication(); 
        $table = $this -> getTableEmployer();	
          
        $submitedData =  $this -> getSubmitedData($this -> input);
        try {
            $table -> bind($submitedData);
            if ( $table -> store() === false ) {
                forEach ( $table -> getErrors() as $error) {
                    $app -> enqueueMessage($error);
                }
                throw new \Exception('Σφάλμα αποθήκευσης εργοδότη', 'warning');
            }
            $submitedData['id'] = $table -> id;
            $app -> enqueueMessage("Αποθήκευση εργοδότη επιτυχής", 'success');
            
        }
        catch(Exception $e) {
            echo new JsonResponse ($submitedData, 'warning', true);
            exit;
        }
                
        echo new JsonResponse ($submitedData, 'success', true);
        exit;
                
           
		

    } 
    
    public function delete() 
	{
		$id = $this -> input -> getInt("key", 0);
                $model = parent::getModel('Employerdelete');
		try 
		{
			$res = $model -> delete($id);
			new JsonResponse("Η διαγραφή ολοκληρώθηκε επιτυχώς", 'success', true);
		}
		catch(Exception $e) 
		{
			new JsonResponse($e -> getMessage(), 'success', true);
		}
		
		exit;
		
	}
       
   
    public function select2() 
    {
//        $this -> app ->setUserState($key, $value)
        $this -> display(false);
    }
    
    public function Devex() {
        $this -> input -> set('adapter', 'Devex');
//        $viewName = $this->input->getCmd('view', $this->default_view);
//        $state = new \Joomla\Registry\Registry(['adapter' => 'Devex']);
//        $model = $this -> getModel($viewName, '', array('base_path' => $this->basePath, 'state' => $state));
//        $model -> setState('adapter', 'Devex');
        $this ->display(false);
    }
    
    public function displayItem($id = null){
		$id = $this -> input -> getInt('id', 0);
		if ( $id == 0 ) {
			echo new JsonResponse([], "Not Found", true );
			exit;
		}
		$db = Factory::getDBo();
		$query = $db -> getQuery(true);
		$query -> select (  "`id`, `idCountry`, `idEmployerType`, `DiscreteTitle`, `EmpAddress`, `EmpArea`, `Zip`"
                        . ", `Telephone`, `Mobile`, `Fax`, `WebPage`, `Email`, `TaxNo`, `TaxOffice`, `Profession`, `Comments`, idIndustry" )
                -> from ("#__elg_ergasia_employer") 
                -> where (" id = " .$id);
               // echo $query -> dump();
               // exit; 
        $item = $db -> setQuery($query) -> loadAssoc();
       
        echo new JsonResponse($item, "success", true );
		exit;
        
	}
       
   
}
