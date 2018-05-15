<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
    defined('_JEXEC') or die('Restricted access');
	$Itemid=$this->state->get('Itemid');
	$lang = $this->state->get('lang');
	$image = JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_IMAGE');
	$show_details = JText::_('COM_ELGERGASIA_EMPLOYEE_DETAILS');
	$phone = JText::_('COM_ELGERGASIA_PHONE_SHORT');
	$mobile = JText::_('COM_ELGERGASIA_MOBILE_SHORT');
	$fax = JText::_('COM_ELGERGASIA_FAX_SHORT'); 
	$email = JText::_('COM_ELGERGASIA_EMAIL');
	$isFrom = JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_NATIONALITY_LABEL');
	$workAs = JText::_('COM_ELGERGASIA_PREFERENCES');
	$workAreas = JText::_('COM_ELGERGASIA_WANT_TO_WORK_TO_AREAS');
	$hasWorked = JText::_('COM_ELGERGASIA_HAS_WORKED_AS');
	
	$theCandidate = JText::_('COM_ELGERGASIA_SUGGESTIONS_CANDIDATE');
	$speciality = JText::_('COM_ELGERGASIA_JOB_SPECIALITY');
	$areas = JText::_('COM_ELGERGASIA_PLACE');
	
	//$or = JText::_('COM_ELGERGASIA_OR');
	foreach($this->data as $item): ?>
	
	<hr />
	<div class="candidate-list-item row">
	<h3><?php  echo $item->fullname, ' (' , $item->id , ')'; ?></h3>
		<div class="pull-left candidate-1">
			<h4><?php echo $workAs; ?></h4>
			<div class="pull-left">
				<h5><?php echo $speciality; ?></h5>
				<ul><li><?php echo str_replace(',', '</li><li>', $item->speciality); ?></li></ul>
			</div>
                        <?php /**
			<div class="pull-left" >
				<h5><?php echo $areas; ?></h5>
				<ul><li><?php echo str_replace(',', '</li><li>', $item->prefSection); ?></li></ul>
			</div>
                         * 
                         */?>
			
		</div>
		<div class="pull-right candidate-2">
			<h4><?php echo $theCandidate . ' ' . $item->id; ?></h4>
                        <p><?php echo $isFrom, ': ', '<strong>', $item->nationality, '</strong>'; ?><br /><?php echo ($item -> dateOfBirth == '0000-00-00' ? '' : JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FIELD_DOB') . ': ' .ComponentUtils::getDateFormated($item -> dateOfBirth, 'Y-m-d', 'd/m/Y') ); ?></p>
			<p><img class="img-rounded" src="media/com_elgergasia/candidatephotos/<?php echo $item->photo; ?>" alt="<?php $image ?>" /></p>
			<p class="hidden-print"> <a class="btn btn-primary" href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $Itemid . '&view=candidate&layout=candidate&id=' . $item->id . '&lang=' . $lang); ?>" class="btn"><?php echo $show_details; ?></a></p>		
                </div>
		</div>		
	<?php endforeach; 
	unset ($item);
	?>
	<div class="clearfix">&nbsp;</div>
<?php echo ($this->state->get('pagination')->getListFooter()); ?>