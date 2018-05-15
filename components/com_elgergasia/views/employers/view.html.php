<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgviewform.php';
 JLoader::register('MenusHelper', JPATH_ADMINISTRATOR . '/components/com_menus/helpers/menus.php');
 class  ElgergasiaViewEmployers extends ElgergasiaViewElgViewForm{
    public function __construct(JModel $model, SplPriorityQueue $paths = null){
        parent::__construct($model, $paths);
        $this->data = $this->state->get('data');
        $filters = $this->state->get('filters');
        $this->filter_order = $filters->filter_order;
        $this->filter_order_Dir = $filters->filter_order_Dir;
        $this->canSeeContactInfo = Utils::canSeeContactInfo();
        
    }
    
     public function render() {
    
        if(!Utils::canUserEditData('', $this->state->get('id') ))
        {
            if(stripos($this->getLayout() , 'search' ) > 0)
            {
                $this->setLayout('employerssearchunprivileged');
            }
            else
            {
                $this->setLayout('employersunprivileged');
            }
        }
         JHtml::_('behavior.framework');
		$doc = JFactory::getDocument();
		$q = JURI::getInstance()->getQuery(true);
		$elgergasia_sefhelper = array('option', 'model', 'view', 'controller', 'Itemid', 'layout', 'filter_order', 'filter_order_Dir', 'format'); 
		//echo JRoute::_('index.php?Itemid=' . $this->state->get('Itemid')) . ' - ' . urldecode(JURI::getInstance()->getPath());
		if(urldecode(JURI::getInstance()->getPath()) === JRoute::_('index.php?Itemid=' . $this->state->get('Itemid')))
		{
			foreach($q as $qk=>$qv)
			{
				if(!in_array($qk,$elgergasia_sefhelper))
				{
					$doc->addHeadLink( 'http://elpidajob.gr' . JRoute::_('index.php?Itemid=' . $this->state->get('Itemid'), false), 'canonical', 'rel');
					break;
				}
			}
			unset($qk);
			unset($qv);
		}
		else
		{
			$doc->addHeadLink( 'http://elpidajob.gr' . JRoute::_('index.php?Itemid=' . $this->state->get('Itemid'), false), 'canonical', 'rel');
		}
        return parent::render();
    }
     
    protected function setFormController() {
        //$this->formController = $this->state->get('view');
        $this->formAction->setVar('option', 'com_elgergasia');
        $this->formAction->setVar('controller', 'employers');
        $this->formAction->setVar('view', 'employers');
        $this->formAction->setVar('model', 'employers');
        $this->formAction->setVar('layout', 'employers');
        $app	= JFactory::getApplication();
        $menu 	= $app->getMenu();
        $active = $menu->getActive();
        $lang = JFactory::getLanguage()->getTag();
        $associations= MenusHelper::getAssociations($active->id);
        if(isset($associations[$lang]))
        {
            $Itemid = $associations[$lang];
        }
        else 
        {
            $Itemid = $active->id;
        }
        $this->formAction->setVar('Itemid', $Itemid);
    }
 }
?>
