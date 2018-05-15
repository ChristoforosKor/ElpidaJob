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
require dirname(__FILE__) . '/controller.php';

class ElgergasiaControllerViewNew extends ElgergasiaController{
        
        protected $paths = null;
        
        public function __construct($input = null, $app = null) {
            parent::__construct($input, $app);
            if($this->request['layout'] == '') {
                $this->request['layout'] = $this->suffix;
            }
            $this->paths = new   SplPriorityQueue();
            $this->paths->insert(JPATH_COMPONENT_SITE . '/layouts', 'normal');
         
			
        }
        
        public function execute() {
        
            require_once JPATH_COMPONENT . '/views/' . $this->suffix . '/view.' . $this->request['format'] . '.php';
            require_once JPATH_COMPONENT . '/models/' . $this->suffix . '.php';
			JFactory::getDocument()->addStyleSheet('media/com_elgergasia/css/site.stylesheet.css');
            $viewClass = 'ElgergasiaView' . $this->suffix;
            $modelClass = 'ElgergasiaModel' . $this->suffix;
            $model = new $modelClass();
            $model->setState(new JRegistry($this->request));
            $view = new $viewClass($model, $this->paths);
            $view->setLayout($this->request['layout']);
            echo $view->render();
            return true;        
		}
}
?>
