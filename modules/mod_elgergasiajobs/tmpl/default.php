<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<p><a href="?option=com_elgergasia&view=jobs&layout=jobs&controller=jobs&Itemid=201&idSpeciality=<?php echo $idSpeciality ?>&<?php echo JSession:: getFormToken(); ?>=1" ><span class="jobs-num"><?php echo $data->cnt; ?></span> αγγελίες <span class="job-title"><?php echo $data->speciality ?></span></a></p>
