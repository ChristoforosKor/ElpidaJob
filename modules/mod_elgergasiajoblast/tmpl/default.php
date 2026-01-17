<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
if($data->id > 0) :
$submitedDate = date_create($data->submitDate);
?>

<p class="datetime"><span class="day"><?php echo  date_format($submitedDate, 'd'); ?></span> <span class="month"><?php echo   date_format($submitedDate, 'M'); ?></span></p>
<p><a class="job-title" href="?option=com_elgergasia&view=jobs&layout=jobs&controller=jobs&Itemid=201&id=<?php echo $data->id ?>"><?php echo $data->jobTitle ?></a></p>
<?php endif; ?> 