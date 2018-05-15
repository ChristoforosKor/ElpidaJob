<?php

/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
defined('_JEXEC') or die('Restricted access');
require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/factory.php';

/**
 * Strategy controller that execute the execute method of the right subclass.
 * @package libraries.e-logism.php.joomla;
 * @subpackage controllers
 * @author Christoforos J. Korifidis
 * 
 */
class Controller extends JControllerBase {

    /**
     * 
     * @Array requestData Holds then basic data for component entry poing as entered by the user after applying them filters for sanitation.
     * Info about fitlers can be found here http://developer.joomla.org/manual/chap-Joomla_Platform_Manual-Input.html
     * The data this array holds and their corresponding filters are  :
     * (The list is in the form VARIABLE - FILTER - DEFAULT_VALUE)
     * option WORD ''
     * view WORD ''
     * model WORD ''
     * controller WORD ''
     * layout WORD ''
     * format WORD 'html'
     * Itemid INT 0
     * lang WORD ''
     * limit WORD 20
     * limit_start INT 0
     * filter_order WORD ''
     * filter_order_Dir CMD ''
     * id INT 0
     *   
     */
    protected $inputData = null;

    /**
     * Constructor that cheks access levels authorization or throws an error.
     */
    function __construct(\JInput $input = null, \JApplicationBase $app = null) {
        parent::__construct();
        self::checkItemId($this->getInput()->getInt('Itemid', 0), $this->getApplication());
        $appData = self::initAppData(self::getFilteredData($this->getInput()));
        $this->getInput()->set('appData', $appData);
    }

    public function execute() {
        JFormHelper::addFormPath(JPATH_COMPONENT_SITE . '/models/forms');
        JFormHelper::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . '/libraries/php/joomla/e-logism/models/fields');
        JFormHelper::addRulePath(JPATH_COMPONENT_ADMINISTRATOR . '/libraries/php/joomla/e-logism/models/rules');
        JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models/tables');
        JLog::addLogger(array());
        $controller = Factory::getController($this->getInput(), $this->getApplication());
        $controller->execute();
    }

    /**
     * Returns a view with matched with its model
     * @param array $appData Basic application 
     * @param type $stateIn
     * @return type
     * @throws Exception
     */
    public static function getViewWithModel(Array $appData = null, $stateIn = null) {
        if($appData === null && $stateIn === null):
            throw new Exception('No state provided');
        endif;
        if($appData === null):
            $applicationData = $stateIn->get('appData', null);
            $state = $stateIn;
        else:
            $applicationData = $appData;
            $state = new JRegistry();
            $state->set('appData', $applicationData);
        endif;
        if($applicationData !== null):
            return Factory::getView($applicationData['componentname'], $applicationData['view'], Factory::getModel($applicationData['componentname'], $applicationData['model'], $state), $applicationData['format']);
        else:
            throw new Exception('No state data provided');
        endif;
        
    }
    
    /**
     * Returns a view ready with its model, format and layout initialized from a given state.
     * @param JRegistry $stateIn The state that holds the information needed to initialize the view. Those information must reside at the state key 'appData' and
     * must be an array. This array must contains the following keys:
     * <ul><li>componentname (String, the name of the component we are working)</li>
     * <li>view (String, the name of the view we want to initialize) </li>
     * <li>model (String, the name of the modle we want to use with the view </li>
     * <li>format (String, the name of the format we want to use for the view</li>
     * <li>layout (String, the name of the layout we want to use with the view</li></ul>
     * @return type JView The initialized
     * @throws Exception if not $statIn provided or if the $stateIn does not contain an array at the 'appData' key. 
     */
    public static function getViewReady(JRegistry $stateIn = null) {
        if($stateIn === null):
            throw new Exception('No state provided');
        endif;
        
        $applicationData = $stateIn->get('appData', null);
        if($applicationData !== null):
            $model = Factory::getModel($applicationData['componentname'], $applicationData['model'], $stateIn);
            $view = Factory::getView($applicationData['componentname'], $applicationData['view'], $model, $applicationData['format']);
            $view->setLayout($applicationData['layout']);
            return $view;
        else:
            throw new Exception('No state data provided');
        endif;
        
    }

    /**
     * Initializes controller, view, model to default values other than empty strings. These default values are
     * view: The component's name without the 'com_' prefix.
     * controller : The name of the view 
     * model: The controller's name
     * All the above values take place only when the user has not supplied values for the corresponding variables.
     * @param array $a Joomla royting request data as an array. These request data that needed are <ul><li>componentname</li><li>view</li><li>layout</li><li>cotroller</li><li>model</li></ul>
     * @return array The basic values of joomla cms componet initialized to default values.
     * 
     */
    public static function initAppData(Array $a) {
        
        $a['componentname'] = str_replace('com_', '', $a['option']);
        if ($a['view'] === '') {
            $a['view'] = $a['componentname'];
        }
        if ($a['layout'] === '') {
            $a['layout'] = $a['view'];
        }
        if ($a['controller'] === '') {
            $a['controller'] = $a['view'];
        }
        if ($a['model'] === '') {
            $a['model'] = $a['controller'];
        }
        return $a;
    }

    /**
     * Gets user's data from the JInput and returns the basic data needed by a joomla component.
     * The data are sanitized by applying on them filters.
     *
     * @param JInput $input User's input
     * @return Array The sanitized data on the form of an array.
     * 
     * @see cmsData
     */
    public static function getFilteredData(JInput $input) {

        $o = array();
        $o['option'] = $input->getCMD('option', '');
        $o['view'] = $input->getCMD('view', '');
        $o['model'] = $input->getCMD('model', '');
        $o['controller'] = $input->getCMD('controller', '');
        $o['layout'] = $input->getCMD('layout', '');
        $o['format'] = $input->getCMD('format', 'html');
        $o['Itemid'] = $input->getInt('Itemid', 0);
        $o['lang'] = $input->getCMD('lang', '');
        $o['limit'] = $input->getInt('limit', 20);
        $o['limit_start'] = $input->getInt('limit_start', 0);
        $o['filter_order'] = $input->getWord('filter_order', '');
        $o['filter_order_Dir'] = $input->getCMD('filter_order_Dir', '');
        $o['id'] = $input->getInt('id', 0);
        return $o;
    }

    /**
     * Checks for access level authorization based on Itemid
     * @param INT $Itemid The Url Itemid in the users requestData
     * @param JApplicationBase The Application object of the controller.
     * @param STRING $errorUrl For future use. The url to redirect in case of no authorization.
     */
    public static function checkItemId($Itemid, $application, $errorUrl = '') {
        if ($Itemid === 0) {
            JError::raiseError('501', JText::_('COM_ELG_NO_VALID_ACCESS_POINT'));
        } elseif ($application->getMenu()->authorise($Itemid) !== true) {
            JError::raiseError('501', JText::_('COM_ELG_NO_VALID_ACCESS_POINT'));
        }
    }
    
    
    /**
     * Returns an Jregistry object initialized with the application data, that is the data returned from the initAppData function.
     * @return \JRegistry The new initialized JRegistry object
     */
    protected function getInitedState()
    {
        $state = new JRegistry();
        $state->set('appData', $this->getInput()->get('appData', array(), 'ARRAY'));
        return $state;
    }

}
