<?php
/* ------------------------------------------------------------------------
  # com_elgalocrm - e-logism job agency
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.gr

  ----------------------------------* */
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;
?>

<div class="elg row jobpost" >
    <div class="row">
        <h1> <?php echo $this->itemData->jobTitle; ?> (<?php echo$this->itemData->id ?>)</h1>
        <div class="col-md-8 yjsg1">

            <p id="jobDescription" >
<?php echo nl2br($this->itemData->jobDescription); ?>
            </p>
        </div>
        <div class="col-md-3 yjsg2">
            <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_STATE'); ?></span> <strong><?php echo $this->itemData->jobState; ?></strong><br />
            <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_JOB_DATE_SUBMIT'); ?></span><br /> <strong><?php echo date('F Y', strtotime($this->itemData->submitDate));
' ';
JHtml::_('date', $this->itemData->submitDate, JText::_('DATE_FORMAT_LC4')); ?></strong><br />
            <span class="label label-info"><?php echo Text::_('COM_ELGERGASIA_JOB_SPECIALITY'); ?></span><br /><strong><?php echo $this->itemData->speciality; ?></strong><br />      
            <span class="label label-info"><?php echo Jtext::_('COM_ELGERGASIA_JOB_PLACE') ?></span><br /> <strong><?php echo $this->itemData->county; ?></strong><br />

        </div>
    </div>
    <?php /**
      <div class="row">
      <div class="col-md-12">
      <a class="btn btn-primary" href="mailto:info@elpidajob.gr?subject=<?php echo Text::_('COM_ELGERGASIA_JOB_INTEREST_SUBJECT')  . ' ' . $this->itemData->id ?>&body=<?php echo Text::_("COM_ELGERGASIA_JOB_INTEREST_SUBJECT"); ?>  <a href='index.php?view=jobpost&layout=jobpost&controller=jobpost&id=<?php echo$this->itemData->id ?> ><?php echo  $this->itemData->jobTitle; ?></a>"><?php echo Text::_('COM_ELGERGASIA_SHOW_JOB_INTEREST'); ?></a>

      </div>
      </div>
     * 
     */ ?>


    <?php /**
      if(count($this->photos) > 0) :
      $altPhotosInner = JText::_('COM_ELGERGASIA_JOB_PHOTO_ALT_INNER');
      ?>
      <div>
      <?php
      $imCnt = 0;
      foreach($this->photos as $item) : ?>
      <div class="elg-column" >
      <a  target="_blank" href="media/com_elgergasia/jobphotos/<?php echo $item->jobPhoto . '_large.' . $item->photoExtension; ?>" ><img alt="<?php echo $altPhotosInner, ' ',$imCnt + 1; ?>" id="imUrl<?php echo $imCnt++ ?>" src="media/com_elgergasia/jobphotos/<?php echo $item->jobPhoto . '_medium' . '.' . $item->photoExtension;  ?>" /></a>
      </div>
      <?php
      endforeach;
      unset($item);?>
      </div>
      <?php endif; * */ ?>












    <p>


    <div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
</p>
</div>