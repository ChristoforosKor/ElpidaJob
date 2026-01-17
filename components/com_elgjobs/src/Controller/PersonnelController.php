<?php

namespace ELG\Component\ElgJobs\Site\Controller;

defined('_JEXEC') or die;

//use Joomla\CMS\MVC\Controller\BaseController;


use DateTime;
use ELG\Component\ElgJobs\Site\Controller\ElgController;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Form\FormFactoryInterface;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\Input\Input;

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
class PersonnelController extends ElgController {

    public function __construct($config = [], MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null) 
    {
        parent::__construct($config, $factory, $app, $input, $formFactory);
        $this->viewEditItem = '/epexergasia-prosopikou.html';
        $this->viewList = '/search-personnel.html?view=personnellist';
    }
 
    protected function getSubmitedData(Input $input) 
    {
        $data = $this->input->post->get('personnelForm', [], 'array');
        $files = $input->files->get('personnelForm', [], 'array');
        $data['candidatePhotoUpload1'] = isset($files['candidatePhotoUpload1']) ? $files['candidatePhotoUpload1'] : '';
        $data['candidateFileUpload'] = isset($files['candidateFileUpload']) ? $files['candidateFileUpload'] : '';
        if ($data['dateOfBirth'] !== '0000-00-00') {
            $data['dateOfBirth'] = \DateTime::createFromFormat("d/m/Y", $data['dateOfBirth'])->format("Y-m-d");
        }
        
        if ($data['lastOfficeVisit'] !== '0000-00-00') {
            $data['lastOfficeVisit'] = \DateTime::createFromFormat("d/m/Y", $data['lastOfficeVisit'])->format("Y-m-d");
            
        }
        
        if ( empty($data['useMyData']) ) {
            $data['useMyData'] = 1;
        }
        
        if ( empty($data['showPhoto']) ) {
            $data['showPhoto'] = 1;
        }
        
        if ( empty($data['showName']) ) {
            $data['showName'] = 1;
        }
        
        return $data;
    }

    public function getSaveModel($name = 'Personnelsave', $prefix = '', $config = ['ignore_request' => true]) 
    {
        return parent::getModel($name, $prefix, $config);
    }
    
    public function select2() 
    {
        $this -> display(false);
    }

    public function deleteFile()
    {
        $data = new \stdClass();
        $data->id = $this->input->getInt('id');
        $data->file = $this->input->getString('file');
               
        $model = parent::getModel();
        $model->deleteFile($data);
        
        try {
            $message = 'Το αρχείο διαγράφηκε επιτυχώς.';
            $error = false;
            $this->app->enqueueMessage('Το αρχείο διαγράφηκε επιτυχώς.');
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
            $error= true;
        }
        
       
        echo new \Joomla\CMS\Response\JsonResponse($data, $message, $error);
                
    }
}
