<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
defined('_JEXEC') or die('Restricted access');
?>
    <tbody>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_EMPLOYER_DISCRETE_TITLE'); ?></th><td><?php echo $this->data->discreteTitle; ?></td>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_FULLNAME'); ?></th><td><?php echo $this->data->name; ?></td>
        </tr>
        <tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYER_INDUSTRY'); ?></th><td><?php echo $this->data->industry ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_ACTIVITY'); ?></th><td><?php echo $this->data->profession ?></td>
       </tr>
       <tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_WEBSITE'); ?></th><td><?php echo $this->data->website ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_EMAIL'); ?></th><td><?php echo $this->data->email ?></td>
       </tr>
       <tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYER_COUNTRY_LABEL'); ?></th><td><?php echo $this->data->country ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYER_CITY_LABEL'); ?></th><td><?php echo($this->data->city) ?></td>
       </tr><tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_POSTAL_CODE_LABEL'); ?></th><td><?php echo($this->data->postalCode) ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_ADDRESS'); ?></th><td><?php echo $this->data->address ?></td>
       </tr><tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_TAX_OFFICE'); ?></th><td><?php echo $this->data->taxOffice ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_TAX_NUMBER'); ?></th><td><?php echo $this->data->taxNumber ?></td>
       </tr>
       <tr>
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_PHONE_LABEL'); ?></th><td><?php echo $this->data->phone ?></td>
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MOBILE_LABEL'); ?></th><td><?php echo($this->data->mobile) ?></td>
       </tr><tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FAX_LABEL'); ?></th><td><?php echo $this->data->fax ?></td>
           
       </tr><tr>    
           <th><?php echo JText::_('COM_ELGERGASIA_COMMENTS'); ?></th>
           <td colspan="3" ><?php echo $this->data->information ?></td>

       </tr>    
   </tbody>
   
 

