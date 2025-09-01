<?php

namespace  ELG\Component\ElgJobs\Site\View\Jobs;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Factory;


/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 * 
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence.
 *
 */

class JsonView extends BaseJsonView {
    
    
    public function display($template = null) {
       
        $model = $this -> getModel();
        $list = $model -> getItems();
        $total = $model -> getTotal();
        $globalOffset = Factory::getConfig() -> get('offset');
        $globalTimeZone = new \DateTimeZone( $globalOffset );
        $userTimeZone = Factory::getUser() -> getTimeZone();
        
        $d2 = new \DateTime();
        $d2 -> setTimezone($userTimeZone);

        /**
         * @todo Τα λεκτικά από μετάφραση
         * 
         * */
        $data = array_map(function ($item) use ($globalTimeZone, $d2) {
            $d = new \DateTime($item->submitDate);
            $d->setTimezone($globalTimeZone);
            $interval = $d->diff($d2);
            $timeText = '';
            
            if ($interval->m > 1) {
                $timeText = $interval->m ." μήνες ";
            } elseif ($interval->m > 0) {
                $timeText = "1 μήνας ";
            } elseif ($interval->d > 1) {
                $timeText = $interval->d ." ημέρες ";
            } elseif ($interval->d > 0) {
                $timeText = "1 ημέρα ";
            } elseif ($interval->h > 1) {
                $timeText = $interval->h . " ώρες ";
            } else {
                $timeText = " τελευταία ώρα";
            }
            $item -> posted = $timeText;
            
            $item -> specs = [];
            if ( $item -> hour != '') {
                $item -> specs [] = $item -> hour;
            }
            
            if ( $item -> jobCity != '' ) {
                $item -> specs [] = $item -> jobCity;
            }
            
            if ( $item -> areasize != '') {
                $item -> specs[] = $item -> areasize . "τμ";
            }
            
            if ( $item -> jobSalary != '' ) {
                $item -> specs [] = $item -> jobSalary . "€";
            } 
            
            if ( $item -> daysOff != '') {
                $item -> specs[] = $item -> daysOff . " ρεπό/μήνα";
            }
                    
            return $item ;
            
         }, $list);
        
        $pagination = $model -> getPagination() -> getListFooter();
        $ret =  ['data' => $data, 'paging' => $pagination,  'total' => $total];
        $this -> ret = $ret;
        echo json_encode($ret, JSON_NUMERIC_CHECK);
        // Call the parent display to display the layout file
//        $result = $this->loadTemplate($template);
//        echo $result;
    }
    
    
    public function loadTemplate($tpl = null)
	{
		// Clear prior output
		$this->_output = null;

		$template = Factory::getApplication()->getTemplate(true);
		$layout = $this->getLayout();
		$layoutTemplate = $this->getLayoutTemplate();

		// Create the template file name based on the layout
		$file = isset($tpl) ? $layout . '_' . $tpl : $layout;

		// Clean the file name
		$file = preg_replace('/[^A-Z0-9_\.-]/i', '', $file);
		$tpl = isset($tpl) ? preg_replace('/[^A-Z0-9_\.-]/i', '', $tpl) : $tpl;

		// Load the language file for the template
		$lang = Factory::getLanguage();
		$lang->load('tpl_' . $template->template, JPATH_BASE)
			|| $lang->load('tpl_' . $template->parent, JPATH_THEMES . '/' . $template->parent)
			|| $lang->load('tpl_' . $template->template, JPATH_THEMES . '/' . $template->template);

		// Change the template folder if alternative layout is in different template
		if (isset($layoutTemplate) && $layoutTemplate !== '_' && $layoutTemplate != $template->template)
		{
			$this->_path['template'] = str_replace(
				JPATH_THEMES . DIRECTORY_SEPARATOR . $template->template,
				JPATH_THEMES . DIRECTORY_SEPARATOR . $layoutTemplate,
				$this->_path['template']
			);
		}

		// Load the template script
		$filetofind = $this->_createFileName('template', array('name' => $file));
		$this->_template = Path::find($this->_path['template'], $filetofind);

		// If alternate layout can't be found, fall back to default layout
		if ($this->_template == false)
		{
			$filetofind = $this->_createFileName('', array('name' => 'default' . (isset($tpl) ? '_' . $tpl : $tpl)));
			$this->_template = Path::find($this->_path['template'], $filetofind);
		}

		if ($this->_template != false)
		{
			// Unset so as not to introduce into template scope
			unset($tpl, $file);

			// Never allow a 'this' property
			if (isset($this->this))
			{
				unset($this->this);
			}

			// Start capturing output into a buffer
			ob_start();

			// Include the requested template filename in the local scope
			// (this will execute the view logic).
			include $this->_template;

			// Done with the requested template; get the buffer and
			// clear it.
			$this->_output = ob_get_contents();
			ob_end_clean();

			return $this->_output;
		}

		throw new \Exception(Text::sprintf('JLIB_APPLICATION_ERROR_LAYOUTFILE_NOT_FOUND', $file), 500);
	}

	/**
	 * Load a helper file
	 *
	 * @param   string  $hlp  The name of the helper source file automatically searches the helper paths and compiles as needed.
	 *
	 * @return  void
	 *
	 * @since   3.0
	 */
	public function loadHelper($hlp = null)
	{
		// Clean the file name
		$file = preg_replace('/[^A-Z0-9_\.-]/i', '', $hlp);

		// Load the template script
		$helper = Path::find($this->_path['helper'], $this->_createFileName('helper', array('name' => $file)));

		if ($helper != false)
		{
			// Include the requested template filename in the local scope
			include_once $helper;
		}
	}
    
    
 
}