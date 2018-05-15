<?php
/*------------------------------------------------------------------------
# com_elgpedy - e-logism, dexteraconsulting  application
# ------------------------------------------------------------------------
# copyright Copyright (C) 2014 e-logism, dexteraconsulting. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr, http://dexteraconsulting.com
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 /**
  * Base class for all json data views.
  * @package libraries.e-logism.php.joomla;
  * @subpackage views
  * @author Christoforos J. Korifidis
  * 
  */
  
 require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/views/view.php'; 
  
 class  ViewJSONData extends View
{   
    protected $data;
    
    public function __construct(JModel $model, SplPriorityQueue $paths = null) 
    {
       parent::__construct($model, $paths);
       $this->data = $this->state->get('data', []);
       $this->setPaths($paths);       
    }  
    
    public function render() 
    {
        $this->setLayout('jsondataoutput');
	return parent::render();
    }   	
	
}