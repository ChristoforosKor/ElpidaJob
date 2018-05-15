<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
abstract class ElgergasiaController extends JControllerBase{
        protected $request = array();
        protected $model = null;
        protected $suffix = '';
        protected $requestedKeys = array();
        protected $session = null;
        protected $sessionNamespace = '';
        public function __construct($input = null, $app = null) {
            parent::__construct($input, $app);
            $this->session = JFactory::getSession();
            $this->request = CommonUtils::getBasicStateData($this->getInput());
            if($this->request['controller'] == '') {
                if($this->request['view'] == '') {
                   $this->suffix = 'elgergasia';
                }
                else {
                    $this->suffix = $this->request['view'] ;
                }
            }
            else {
                $this->suffix = $this->request['controller'];
            }
            require_once JPATH_COMPONENT . '/models/' . $this->request['model']  . '.php';
            $modelClass = 'ElgergasiaModel' . $this->request['model'];
            $this->model = new $modelClass();  
            $this->setSessionNamespace();
        }    
        
      
        public function execute() {
            $this->model->setState(new JRegistry($this->request));
        }
        
        /**
         * sets the requested variable either from http either from session, after sanitazing them and check for form tokens when necessary.
         */
        protected function setRequestedValues($dataKey='filters') {
            $input = $this->getInput();
            $isChecked = false;
            
            foreach($this->requestedKeys as $key=>$type) {
                $val = $input->get($key, null, $type[0]);
                if($val != null && $isChecked == false) {
              //       JSession::checkToken($input->getCmd('method', 'post')) or jexit(JText::_('JINVALID_TOKEN'));
                     $isChecked = true;
                }
                $this->request[$dataKey][$key] =  CommonUtils::getRequestNoNull($key, $type[1], $val, $this->session, $this->sessionNamespace);
            }
            unset($key);
            unset($type);
        }
        
        protected abstract function setSessionNamespace();       
}
