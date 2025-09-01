<?php

namespace  ELG\Component\ElgJobs\Site\Controller;

defined('_JEXEC') or die;

//use Joomla\CMS\MVC\Controller\BaseController;


use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\Input\Input;
use ELG\Component\ElgJobs\Site\Libs\Interfaces\IListInputAdpater;
use ELG\Component\ElgJobs\Site\CommonUtils;


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
class ElgController extends FormController {


    protected $viewEditItem;
    protected $viewList;
    protected $commonUtils;
   
    
    public function __construct($config = [], \Joomla\CMS\MVC\Factory\MVCFactoryInterface $factory = null, ?\Joomla\CMS\Application\CMSApplication $app = null, ?Input $input = null, FormFactoryInterface $formFactory = null) {
        parent::__construct($config, $factory, $app, $input, $formFactory);
        $this -> commonUtils = new CommonUtils;
    }
    
    public function edit($key = null, $urlVar = null) {
        
        $model = $this->getModel();
        $table = $model->getTable();
        $cid   = $this->input->post->get('cid', array(), 'array');
        $context = "$this->option.edit.$this->context";

        // Determine the name of the primary key for the data.
        if (empty($key))
        {
                $key = $table->getKeyName();
        }

        // To avoid data collisions the urlVar may be different from the primary key.
        if (empty($urlVar))
        {
                $urlVar = $key;
        }
        
       
        $recordId = (int) (\count($cid) ? $cid[0] : $this->input->getInt($urlVar));
        
        
        // Access check.
        if (!$this->allowEdit(array($key => $recordId), $key))
        {
            $this->setMessage(Text::_('JLIB_APPLICATION_ERROR_EDIT_NOT_PERMITTED'), 'error');
            $this->setRedirect( $this -> getViewList() );
            return false;
        }
        
        $checkin = $table->hasField('checked_out');
        
        
        // Attempt to check-out the new record for editing and redirect.
        if ($checkin && !$model->checkout($recordId))
        {
                // Check-out failed, display a notice but allow the user to see the record.
                $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_CHECKOUT_FAILED', $model->getError()), 'error');

                $this->setRedirect( $this -> getViewEditItem() . "?id=" . $recordId );

                return false;
        }
        else
        {
                // Check-out succeeded, push the new record id into the session.
                $this->holdEditId($context, $recordId);
                Factory::getApplication()->setUserState($context . '.data', null);
                $this->setRedirect( $this -> getViewEditItem() . '?id=' . $recordId );
                return true;
        }
        
    }
    
    
    protected function getViewList() {
        return $this -> viewList;
    }
    
    protected function getViewEditItem() {
        return $this -> viewEditItem;
    }
    
    
    public function display($cachable = false, $urlparams = array()) {     
      
        $listInputAdapter = null;
        $listInputAdapterName = $this -> input -> getCmd( 'adapter', '' );
        if ( $listInputAdapterName !== '' ) {
            $listInputAdapter = self::createListInputAdapter ($listInputAdapterName);
        }
        
       
        if ( $listInputAdapter !== null ) {
            $listInputAdapter -> setListParams ( $this -> input );
        }
        Form::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . "/fields");
        parent::display($cachable, $urlparams);
    }
    
    public function save($key = null, $urlVar = null) {
        $this->checkToken();
        $app   = Factory::getApplication();
        $model = $this->getSaveModel();
        $table = $model-> getTable();	
//	$checkin = $table->hasField('checked_out');
	$context = "$this->option.edit.$this->context";
        $submitedData =  $this ->getSubmitedData($this -> input);
      

	// Determine the name of the primary key for the data.
	if (empty($key))
	{
         
            $key = $table->getKeyName();
               
	}

	// To avoid data collisions the urlVar may be different from the primary key.
	if (empty($urlVar))
	{
            $urlVar = $key;
	}
        
	$recordId = $this->input->getInt($urlVar);
        // Populate the row id from the session.
        $submitedData[$key] = $recordId;	
       
        // Access check.
        if (!$this->allowSave($submitedData, $key))
        {
            
                $this->setMessage(Text::_('JLIB_APPLICATION_ERROR_SAVE_NOT_PERMITTED'), 'error');

                $this->setRedirect( $this -> getViewList() );

                return false;
        }

        // Validate the posted data.
        // Sometimes the form needs some posted data, such as for plugins and modules.
        $form = $model->getForm($submitedData, false);

        if (!$form)
        {
            $app->enqueueMessage($model->getError(), 'error');

            return false;
        }

        // Send an object which can be modified through the plugin event
        $objData = (object) $submitedData;
        $app->triggerEvent(
                'onContentNormaliseRequestData',
                array($this->option . '.' . $this->context, $objData, $form)
        );
        $data = (array) $objData;
// var_dump($data);
        // Test whether the data is valid.
        $validData = $model->validate($form, $data);
//         echo '<br><br>';
//         var_dump($validData);
// exit('ok2');
        // Check for validation errors.
        if ($validData === false)
        {
                // Get the validation messages.
                $errors = $model->getErrors();

                // Push up to three validation messages out to the user.
                for ($i = 0, $n = \count($errors); $i < $n && $i < 3; $i++)
                {
                        if ($errors[$i] instanceof Exception)
                        {
                                $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                        }
                        else
                        {
                                $app->enqueueMessage($errors[$i], 'warning');
                        }
                }

			

                    // Save the data in the session.
                    $app->setUserState($context . '.data', $submitedData);

                    // Redirect back to the edit screen.
                    $this->setRedirect( $this ->getViewEditItem() );

                    return false;
            }

		
            // Attempt to save the data.
            if (!$model->save($validData))
            {
                    // Save the data in the session.
                    $app->setUserState($context . '.data', $submitedData);

                    // Redirect back to the edit screen.
                    $this->setMessage(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', 
                            implode('<br>', $model->getState() -> get('errors') )
                            )
                            , 'error');

                    $this->setRedirect( $this -> getViewEditItem() );

                    return false;
            }

		
            
            $langKey = $this->text_prefix . ($recordId === 0 && $app->isClient('site') ? '_SUBMIT' : '') . '_SAVE_SUCCESS';
            $prefix  = Factory::getLanguage()->hasKey($langKey) ? $this->text_prefix : 'JLIB_APPLICATION';

            $this->setMessage(Text::_($prefix . ($recordId === 0 && $app->isClient('site') ? '_SUBMIT' : '') . '_SAVE_SUCCESS'));

					
            // Clear the record id and data from the session.
           
            
            $app->setUserState($context . '.data', null);

            // Redirect back to the edit screen.
            $this->setRedirect( $this -> getViewList() );
				
			

            // Invoke the postSave method to allow for the child class to access the model.
            $this->postSaveHook($model, $validData);

            return true;
        

    } 
    
  
    
    public static function createListInputAdapter($adapterName)
    {

        $className = 'ELG\\Component\\ElgJobs\\Site\\Lib\\Adapter\\' . $adapterName . 'ListInputAdapter';        
        try 
        {
            $class = new $className;
            return  $class;
        } catch (Exception $ex) {
            return null;
        }
    }
    
}