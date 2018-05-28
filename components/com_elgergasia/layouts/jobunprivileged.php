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
    JHTML::_( 'behavior.modal', 'a.modalpop' );
?>

</script>
	<div class="elg job" >
    <h1><?php echo $this->itemData->jobTitle; ?></h1>
	<?php 
		$photos = $this->state->get('photos'); 
		if(count($photos) > 0) : 
			$altPhotosInner = JText::_('COM_ELGERGASIA_JOB_PHOTO_ALT_INNER');
	?>
	<div>		
		<?php 
			$imCnt = 0;
			foreach($photos as $item) : ?>
			<div class="elg-column" >
				<a   target="_blank" href="media/com_elgergasia/jobphotos/<?php echo $item->jobPhoto . '_large.' . $item->photoExtension; ?>" ><img alt="<?php echo $altPhotosInner, ' ',$imCnt + 1; ?>" id="imUrl<?php echo $imCnt++ ?>" src="media/com_elgergasia/jobphotos/<?php echo $item->jobPhoto . '_medium' . '.' . $item->photoExtension;  ?>" /></a>
			</div>
		<?php 
			endforeach; 
			unset($item);
echo '</div>';
			endif;
		?>
	
	<div class="clearfix">&nbsp;</div>
        <p class="col-md-6 col-xs-6" >
            <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_STATE');?></span><br /> <strong><?php echo $this->itemData->jobState;  ?></strong>
        </p><p class="col-md-6 col-xs-6" >    
            <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_JOB_DATE_SUBMIT');?></span><br /> <strong><?php echo JHtml::_('date', $this->itemData->submitDate, JText::_('DATE_FORMAT_LC2'));  ?></strong>
        </p>
	<div class=" clearfix"></div><br />
        <p class="col-md-6 col-xs-6 ">
            <span class="label label-info"><?php echo Jtext::_('COM_ELGERGASIA_JOB_PLACE') ?></span><br /> <strong><?php echo $this->itemData->county;  ?></strong><br />
	<?php 
            if($this->itemData->idDegreeLevel > 0 ): ?>
            <span class="label label-info"><?php echo Jtext::_('COM_ELGERGASIA_JOB_EDIT_EDUCATION') ?></span><br /> <strong><?php echo $this->itemData->degreeLevel;  ?></strong><br />
	<?php endif;
        if ($this->itemData->jobSalary > 0): ?>
           <span class="label label-info"> <?php echo JText::_('COM_ELGERGASIA_SALARY');?></span><br /><strong><?php echo $this->itemData->jobSalary; ?></strong><br />
	<?php endif; ?> 
           <span class="label label-info"> <?php echo JText::_('COM_ELGERGASIA_JOB_EDIT_EXPERIENCE');?></span><br /> <strong><?php echo $this->itemData->minExperience;  ?></strong>
	</p>
        <p class="col-md-6 col-xs-6" >
            <?php if ($this->itemData->idSpeciality > 0):
                echo '<span class="label label-info">', JText::_('COM_ELGERGASIA_JOB_SPECIALITY'), '</span><br /><strong>', $this->itemData->speciality, '</strong><br />';
            
            endif;
            if ($this->itemData->oldPeople != ''):
                echo '<span class="label label-info">', JText::_('COM_ELGERGASIA_OLD_PEOPLE'), '</span><br /><strong>', $this->itemData->oldPeople, '</strong><br />'; 
            endif;
            if ($this->itemData->medicalCare != ''): ?>
            <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_MEDICAL_CARE');?></span><br /> <strong><?php echo $this->itemData->medicalCare; ?></strong><br />
            <?php 
            endif;
             if ($this->itemData->hour != ''): ?>
            <span class="label label-info"> <?php echo JText::_('COM_ELGERGASIA_HOURS');?></span><br /> <strong><?php echo $this->itemData->hour; ?></strong><br />
            <?php 
            endif;
            /** if ($this->itemData->daysOff != ''): ?>
               <span class="label label-info"> <?php  echo JText::_('COM_ELGERGASIA_DAYS_OFF');?></span><br /> <strong><?php echo $this->itemData->daysOff; ?></strong><br />
            <?php 
            endif; **/
         ?>
        
	</p>
        <div class="clearfix"></div>
	<h2><?php echo JText::_('COM_ELGERGASIA_JOB_EDIT_DESCRIPTION'); ?></h2>
	<p>
		<?php echo nl2br($this->itemData->jobDescription); ?>
		<br />
		<div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
	</p>
	
	
</div>