<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2023s e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

namespace  ELG\Component\ElgJobs\Site\View\Jobedit;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;


class HtmlView  extends BaseHtmlView {
  
    public function display($template = null) {
        $app = Factory::getApplication();
       
//            $ids = $app -> getUserState("com_elgjobs.edit.job.id");
//            if( is_array($ids) ) {
//                $id = $ids[count($ids) - 1];
//            }
//            else {
//                $id = 0;
//            }
       
        $data = $app -> getuserState("com_elgjobs.edit.data");
        $id = $app -> getInput() -> getInt('id', 0);
        $model = $this -> getModel();
        $this -> item = $model -> getItem($id);
        
//        $this -> form = $model -> getForm( $this -> item );
        if ( $data != null ){
            $this -> form = $model -> getForm( $data );
        }
        else {
            $this -> form = $model -> getForm( $this -> item );
        }
        $this -> form2 = $model -> getFormEmployer();
        $this -> translatedLanguages = $model -> getTranslatedLanguages($id);
        $languageTag = Factory::getLanguage() -> getTag();
        $this -> form -> setValue("language", null, $languageTag); 
       
        $groups = Factory::getUser() -> getAuthorisedGroups();
        if ( in_array(12, $groups) ) {
			$this -> isAuthorised = 1;
		}
		else {
			$this -> isAuthorised = 0;
		}
        $app -> setuserState("com_elgjobs.edit.data",  null);
         if ($this -> item -> idCandidate > 0 ) {
             $idCandidate = $this -> item -> idCandidate;
         } 
         else {
             $idCandidate = 0;
         }
         
        Factory::getDocument() ->addScriptDeclaration('let idJobCandidate = ' . $idCandidate . ';');
        parent::display($template);
    }    
    
    
    
 }
