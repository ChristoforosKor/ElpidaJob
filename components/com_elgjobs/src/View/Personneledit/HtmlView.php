<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2030 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
namespace  ELG\Component\ElgJobs\Site\View\Personneledit;

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

 class HtmlView  extends BaseHtmlView {
   
    public function display($template = null) {
      
        
        $model = $this -> getModel();
        $id = $model -> getState('personneledit.id');

        $data = $model -> loadFormData();
        $item = $model -> getItem($id); // loadFormdata does not returns documents and idDocuments Data.
        
        if ($item !== null ){
            $this -> documents = (isset($item['documents']) ? $item['documents']: '') ;
            $this -> idDocuments = ( isset($item['idDocuments']) ? $item['idDocuments']: '');                    
        }
        else {
            $this -> documents = '';
            $this -> idDocuments = '';
        }
       
        $groups = Factory::getUser() -> getAuthorisedGroups();
        if ( in_array(12, $groups) ) {
                $this -> isAuthorised = 1;
        }
        else {
                $this -> isAuthorised = 0;
        }
        
        if (isset ($data['idHour'])) {
            $data['idHour'] = explode ( "," , $item['idHour']);
        }
       
         
        if (isset ($data['idSpeciality'])) {
            $data['idSpeciality'] = explode(",", $item['idSpeciality']);
        }
       
        if (isset ($data['idSpecialNeed']) ) {
            $data['idSpecialNeed'] = explode(",", $item['idSpecialNeed']);
        }
        
        if ( isset ( $data['sortname2'] ) ) {
			$this -> image =   $data['sortname2'] ==1 ? ( isset( $data['image'] ) ? $data['image'] : '' ) : '';
        }
        else {
			$this -> image = '';
		}
        $this -> form = $model -> getForm($data, true);
        $this -> translatedLanguages = $model -> getTranslatedLanguages($id);
        
        parent::display($template);
    }    
    

   
    
 }
