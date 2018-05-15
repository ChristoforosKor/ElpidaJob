<?php
/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/libraries/joomla/controllers/itemcontrollerview.php';
 
 /**
  * elgergon controller that saves customers's data.
  * @package e-logism.joomla.ergon.site
  * @subpackage controllers
  * @author Christoforos J. Korifidis
  * 
  */
class ElgErgasiaControllerAjaxProxy  extends JControllerBase{ 
     

    public function execute() {
        $data = $this->input->get('data', array(), 'ARRAY');
        
        if(!is_array($data)) return;
        $format = $this->input->getWord('format','ajax');
        $view = $this->input->getWord('view');
        $fileV = JPATH_COMPONENT . '/views/' . $view  . '/view.' . $format  . '.php';
        if(!file_exists($fileV)) return ;
        $model =$this->input->getWord('model', $view);
        $filem = JPATH_COMPONENT_SITE . '/models/' . $model . '.php';
        if(!file_exists($filem)) return;
        $paths = new   SplPriorityQueue();
        $paths->insert(JPATH_COMPONENT_SITE . '/layouts', 'normal');
        require $filem;
        require $fileV;
        $modelClass = Utils::COMPONENT_NAME . 'Model' . $model;
        $modelInstance = new $modelClass();  
        if(count($data) >0)
        {
            $state = new JRegistry();
            foreach($data as $key=>$value)
            {
                $state->set($key, $value);
            }
            $modelInstance->setState($state);
        }
        $viewClass = Utils::COMPONENT_NAME . 'View' . $view;
        $viewInstance = new $viewClass($modelInstance, $paths);
        $layout = $this->input->getWord('layout', $view);
        $viewInstance->setLayout($layout);
        echo $viewInstance->render();
    }
    public function redirect(){}
}
?>
