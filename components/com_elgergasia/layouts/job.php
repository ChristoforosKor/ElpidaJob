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
JHTML::_('behavior.modal', 'a.modalpop');
?>
<link href="/media/com_elgergasia/css/bootstrap_lumen.min.css" rel="stylesheet" type="text/css" />
<div class="elg job" >
    <div class="row">
        <div class="col-md-12" >
     <h1 style="font-size:x-large;padding-left:15px;padding-bottom:15px"> <?php echo $this->itemData->jobTitle; ?> (<?php echo$this->itemData->id ?>)</h1>
        </div>
        </div>
    <?php
    if (count($this->photos) > 0) :
        $altPhotosInner = JText::_('COM_ELGERGASIA_JOB_PHOTO_ALT_INNER');
        ?>
        <div>		
            <?php
            $imCnt = 0;
            foreach ($this->photos as $item) :
                ?>
                <div class="elg-column" >
                    <a  target="_blank" href="media/com_elgergasia/jobphotos/<?php echo $item->jobPhoto . '_large.' . $item->photoExtension; ?>" ><img alt="<?php echo $altPhotosInner, ' ', $imCnt + 1; ?>" id="imUrl<?php echo $imCnt++ ?>" src="media/com_elgergasia/jobphotos/<?php echo $item->jobPhoto . '_medium' . '.' . $item->photoExtension; ?>" /></a>
                </div>
                <?php
            endforeach;
            unset($item);
            ?>
        </div>
<?php endif; ?>
    <div class="clearfix">&nbsp;</div>

   
    <div class="row">
  
    <div class="col-md-6">
        <div class="card border-info">
            <div class="card-body">
                <?php echo $this->itemData->jobState; ?>, <?php echo JHtml::_('date', $this->itemData->submitDate, JText::_('DATE_FORMAT_LC2')); ?><br />
                <span class="label label-info"><?php echo $this->itemData->speciality; ?></span><br />
                <span class="label label-info"><?php echo $this->itemData->county; ?></span><br />
                <?php if ($this->itemData->hour != ''): ?>
                    <span class="label label-info"><?php echo $this->itemData->hour; ?></span><br />
                    <?php endif;
                ?>

                <?php if ($this->itemData->minExperience > 0): ?>
                    <span class="label label-info"> <?php echo JText::_('COM_ELGERGASIA_JOB_EDIT_EXPERIENCE'); ?></span> <span class="badge badge-pill badge-success"><?php echo $this->itemData->minExperience; ?></span><br />
                <?php endif;

                if ($this->itemData->daysOff != ''):
                    ?>
                    <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_DAYS_OFF'); ?></span> <span class="badge badge-pill badge-success"><?php echo $this->itemData->daysOff; ?></span><br />
                    <?php
                endif;
                if ($this->itemData->idDegreeLevel > 0):
                    ?>
                    <span class="label label-info"><?php echo Jtext::_('COM_ELGERGASIA_JOB_EDIT_EDUCATION') ?></span> <span class="badge badge-pill badge-success"><?php echo $this->itemData->degreeLevel; ?></span><br />
                <?php endif; ?>


                <?php if ($this->itemData->jobSalary > 0): ?>
                     <span class="label label-info"><?php echo Jtext::_('COM_ELGERGASIA_SALARY') ?></span> <span class="label label-success"><?php echo $this->itemData->jobSalary; ?> &euro;</span><br />
<?php endif; ?> 
              
            </div>

        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-info bg-info 
             text-white">
           
            <div class="card-body">
                <p class="card-text">
<?php echo nl2br($this->itemData->jobDescription); ?>
                </p>
            </div>
        </div>
    </div>
    </div>
    <div class="clearfix"></div>
<div class="row">
    <div class="col-md-12">
<?php if (strlen($this->itemData->jobComment) > 0): ?>
        <p class="text-info">
            <span class="label label-info"><?php echo JText::_('COM_ELGERGASIA_JOB_EDIT_COMMENT'); ?></span><br />
            <strong><?php echo nl2br($this->itemData->jobComment); ?></strong>
        </p>       
<?php endif; ?>
<?php 
    if ( trim( $this -> itemData -> extUrl ) !== '' ) : ?>
      <p>
          <br />
           <a class="btn btn-success" href="<?php echo $this -> itemData -> extUrl; ?>" target="_blank" ><?php echo Jtext::_('COM_ELGERGASIA_SEE_MORE') ?></a> <a href="<?php echo $this -> itemData -> extUrl; ?>"  target="_blank"  ><?php echo $this -> itemData -> extUrl; ?></a><br />
      </p>
  <?php endif; ?> 
    </div>
</div>
    <div class="row">
        <div class="col-md-12">
        <!-- button class="btn pull-left" onclick="checkLogin()">Facebook</button -->
        <a class="btn btn-primary pull-right" href="?option=com_elgergasia&view=jobedit&layout=jobedit&id=<?php echo $this->state->get('id'); ?>&lang=<?php echo $this->state->get("lang"); ?>&Itemid=201" > <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?></a>
        
    
    <div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
    </div>
    </div>
</div>