<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );
require JPATH_COMPONENT_SITE . '/controllers/controller.php';

class ElgergasiaControllerControllerView extends ElgergasiaController{
        
        protected $paths = null;
        protected $viewName = null;
        
        public function __construct($input = null, $app = null) {
            parent::__construct($input, $app);
            if($this->request['layout'] == '') {
                $this->request['layout'] = 'default';
            }
            $this->viewName = $this->getInput()->getWord('view', $this->suffix);
            $this->paths = new   SplPriorityQueue();
            $this->paths->insert(JPATH_COMPONENT_SITE . '/layouts', 'normal');
            $this->paths->insert(JPATH_COMPONENT_SITE . '/views/' . $this->viewName . '/tmpl', 'normal');
            if ( file_exists( JPATH_COMPONENT . '/views/' . $this->request['view'] . '/view.' . $this->request['format'] . '.php' ) ):
                include_once JPATH_COMPONENT . '/views/' . $this->request['view'] . '/view.' . $this->request['format'] . '.php';        
            else:
               JError::raiseError(404, JText::sprintf('JLIB_APPLICATION_ERROR_INVALID_CONTROLLER', $type, $format));
               return null;
            endif;
        }
        
        public function execute() {
          
                $viewClass = Utils::COMPONENT_NAME . 'View' . $this->request['view'];
                parent::execute();
                $view = new $viewClass($this->model, $this->paths);
                $view->setLayout($this->request['layout']);
                $this->view = $view;
                echo $this->view->render();
            
        }
        
        protected function setList($defaultOrder) {
            $this->request['filters'] += CommonUtils::getListParams($this->getInput(), $this->sessionNamespace, $defaultOrder);
        }
        
        protected function setSessionNamespace() {
            $this->sessionNamespace = $this->request['option'] . '.' . $this->request['model'];
        }
}
