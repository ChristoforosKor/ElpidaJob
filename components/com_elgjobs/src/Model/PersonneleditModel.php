<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2030 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

 
----------------------------------**/
namespace  ELG\Component\ElgJobs\Site\Model;
 defined( '_JEXEC' ) or die( 'Restricted access' );

use ELG\Component\ElgJobs\Site\Model\Helpers\Translations;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel; 
use Joomla\Component\Contact\Administrator\Table\ContactTable;

class PersonneleditModel extends AdminModel  {
  


    public function getTable($name = 'Personnel', $prefix = 'Table', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }
    
    public function getTranslatedLanguages($idCandidate) {
        return Translations::getTranslatedLanguages("#__elg_ergasia_candidate_basic_translation", $idCandidate, 'idCandidateBasic', $this ->getDbo());
    }
    
    public function getPreferenceSpecialitiesTable($name = 'Personnelpreferencespecialities', $prefix = 'Table', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }
    
    public function getPreferenceHoursTable($name = 'Personnelpreferencehours', $prefix = 'Table', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }
    
    public function getPreferenceSpecialNeedsTable($name = 'Personnelpreferencespecialneeds', $prefix = 'Table', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }
    
    public function getPhotosTable($name = 'Personnelphotos', $prefix = '', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }
    
    
    public function getPapersTable($name='Personnelpapers', $prefix='', $options =[]) {
        return parent::getTable($name, $prefix, $options);
    }
    
    public function getContactTable($name = 'contact', $prefix = '', $options = []) {
        return new ContactTable( $this -> getDbo() );
    }
    
    
    public function getForm($data = [], $loadData = true): Form {

        $form = Form::getInstance('personnel', JPATH_COMPONENT_ADMINISTRATOR . '/forms/personnel.xml', ['control' => 'personnelForm']);
        
        if ( $loadData ) {
            $form -> bind($data);
        }
        $form->setValue("idUser", null, Factory::getUser() -> id);
        // var_dump($data);exit;
        if ( isset( $data['sortname2'] ) ) {
			if ($data["sortname2"]==1) {
				$form->setValue("accept_photo", null, 1);
			}
		}
        
        if (isset($data['id'] ) ) {
            if ($data['id'] !== 0) {
            $form->setValue("termsofuse", null, 1);
            }
        }

        return $form;
    }
    
    
    public function getFormWithData($pk) {
        $form =  $this -> getForm();
        
        if ( $pk == 0 ) {
            return $form;
        }
        $form -> bind(
                $this->getDataFromItem(
                        $this->getItem($pk)
        ));
        return $form;
    }
    
    
    public function loadFormData()
    {
		// Check the session for previously entered form data.
		$app = Factory::getApplication();
		$data = $app->getUserState('com_elgjobs.edit.personnel.data', []);

		if (empty($data))
		{
			$data = $this->getItem();

		}

		// If there are params fieldsets in the form it will fail with a registry object
		if (isset($data->params) && $data->params instanceof Registry)
		{
			$data->params = $data->params->toArray();
		}

		$this->preprocessData('com_content.personnel', $data);

		return $data;
    }
    
    private function  getDataFromItem(\stdClass $item) {
        if ( $item == null) {
            return [];
        }
        $data = get_object_vars( $item ); 
        if ( isset($data['idSpeciality'] ) ) {
            $data['idSpeciality'] = explode(",", $item -> idSpeciality);
        }
        if ( isset( $data['idHour'] ) ) {
            $data['idHour'] = explode(",", $item -> idHour);
        }
        
        if ( isset( $data['idEducation'] ) ) {
            $data['idEducation'] =explode(",", $item -> idEducation);
        }
        return $data;
    }
    
    public function getItemArray($pk = null) {
        $item = $this -> getItem($pk);
        return $this -> getDataFromItem($item);
    }
    
    public function getItem($pk = null) {
        $pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
        $itemModel = $this -> getMVCFactory() ->createModel("Personnel");
        return $itemModel -> getItem($pk);
    }
}
