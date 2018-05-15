<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.com
 
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
  
?>
 <h2><?php echo '(' . $this->employee->id . ') ' . $this->employee->name ?></h2>
 
 <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_BASIC_DATA'); ?></h3>

 <table class="elg-head-left" >
    <tfoot>
        <tr>
            <td colspan="4">
                <a href="<?php echo JRoute::_('index.php?option=' . $this->option . '&Itemid=' . $this->Itemid . '&view=' . $this->viewName . '&layout=editbasic&iduser=' . $this->idUser . '&id=' . $this->basicData->id . '&lang=' . $this->lang , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" ><?php echo JText::_('COM_ELGERGASIA_EDIT'); ?></a>
            </td>
        </tr>
    </tfoot>
    <tbody>
    <?php if(isset($this->basicData)) { ?>
    <tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_COUNTRY_LABEL'); ?></th><td><?php echo $this->basicData->country ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CITY_LABEL'); ?></th><td><?php echo($this->basicData->city) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_ADDRESS_LABEL'); ?></th><td><?php echo $this->basicData->address ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_POSTAL_CODE_LABEL'); ?></th><td><?php echo($this->basicData->postalCode) ?></td>
    </tr><tr>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_PHONE_LABEL'); ?></th><td><?php echo $this->basicData->phone ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MOBILE_LABEL'); ?></th><td><?php echo($this->basicData->mobile) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FAX_LABEL'); ?></th><td><?php echo $this->basicData->fax ?></td>
        <th></th><td></td>
    </tr>   
       <?php }
    else {
        echo '<tr><td colspan="4" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_EDIT_FOR_NEW') . '</td></tr>';
    }
    ?>
    </tbody>
 
</table>

<h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHARACTERISTICS_DATA'); ?></h3>
<table class="elg-head-left" >
    <tfoot>
        <tr>
            <td colspan="4">
                <a href="<?php echo JRoute::_('index.php?option=' . $this->option . '&Itemid=' . $this->Itemid . '&view=employeecharacteristics&layout=edit&iduser=' . $this->idUser . '&id=' . $this->characteristicsData->id . '&lang=' . $this->lang , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" ><?php echo JText::_('COM_ELGERGASIA_EDIT'); ?></a>
            </td>
        </tr>
    </tfoot>
    <tbody>
    <?php if (isset($this->characteristicData)) { ?>
    <tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_GENDER'); ?></th><td><?php echo $this->characteristicData->gender ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FIELD_DOB'); ?></th><td><?php echo($this->characteristicData->dateOfBirth) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_NATIONALITY_LABEL'); ?></th><td><?php echo $this->characteristicData->nationality ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MILITARYSTATUS_LABEL'); ?></th><td><?php echo($this->characteristicData->militaryStatus) ?></td>
    </tr><tr>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MARITALSTATUS_LABEL'); ?></th><td><?php echo $this->characteristicData->maritalStatus ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHILDRENNUM_LABEL'); ?></th><td><?php echo($this->characteristicData->childrenNum) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_RELIGION_LABEL'); ?></th><td><?php echo $this->characteristicData->religion ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SMOKING_LABEL'); ?></th><td><?php echo(Helper::getYesNo($this->characteristicData->smoking)) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_PET_LABEL'); ?></th><td><?php echo $this->characteristicData->rank ?></td>
        <th></th><td></td>
    </tr><tr>    
        <th colspan="4" ><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_ABOUT_ME_LABEL'); ?></th>
    </tr>
    <tr>
        <td colspan="4" ><?php echo $this->characteristicData->aboutMe ?></td>
    </tr>
    <?php }
    else {
        echo '<tr><td colspan="4" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_EDIT_FOR_NEW') . '</td></tr>';
    }
    ?>
    </tbody>
    
</table>
    