<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgview.php';
 class  ElgergasiaViewElgViewForm extends ElgergasiaViewElgView{
    protected $form;
    protected $formAction;
    protected $formController ='';
    public function __construct(JModel $model, SplPriorityQueue $paths = null) {
        parent::__construct($model, $paths);
        $this->form = $this->state->get('form');
        $uri = JUri::getInstance();
        $this->formAction = $uri;
        $this->setFormController();
    }
    
    protected function setFormController() {
        $this->formController = $this->state->get('view'). 'save';
        $this->formAction->setVar('controller', $this->formController);
    }
 }
?>
