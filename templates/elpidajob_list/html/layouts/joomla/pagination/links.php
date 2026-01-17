<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   (C) 2014 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\Registry\Registry;

$list  = $displayData['list'];
$pages = $list['pages'];

$options = new Registry($displayData['options']);

$showLimitBox   = $options->get('showLimitBox', false);
$showPagesLinks = $options->get('showPagesLinks', true);
$showLimitStart = $options->get('showLimitStart', true);

// Calculate to display range of pages
$currentPage = 1;
$range       = 1;
$step        = 5;

if (!empty($pages['pages']))
{
	foreach ($pages['pages'] as $k => $page)
	{
		if (!$page['active'])
		{
			$currentPage = $k;
		}
	}
}

if ($currentPage >= $step)
{
	if ($currentPage % $step === 0)
	{
		$range = ceil($currentPage / $step) + 1;
	}
	else
	{
		$range = ceil($currentPage / $step);
	}
}
?>

 <!-- comment -->
                    <!-- div class="pagination">
                        <a href="#" class="paging"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
                        <a href="#" class="paging active">1</a>
                        <a href="#" class="paging">2</a>
                        <a href="#" class="paging">3</a>
                        <a href="#" class="paging"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                    </div -->
<?php if (!empty($pages)) : ?>
                    <div class="pagination" arial-lable="<?php echo Text::_('JLIB_HTML_PAGINATION'); ?>" >
	
		<div class="pagination pagination-toolbar text-center">

			<?php if ($showLimitBox) : ?>
				<div class="limit float-end">
					<?php echo Text::_('JGLOBAL_DISPLAY_NUM') . $list['limitfield']; ?>
				</div>
			<?php endif; ?>

			<?php if ($showPagesLinks) : ?>
				<!--<ul class="pagination ms-auto mb-4 me-0">-->
					<?php  echo LayoutHelper::render('joomla.pagination.link', $pages['start']); ?>
					<?php echo LayoutHelper::render('joomla.pagination.link', $pages['previous']); ?>
					<?php foreach ($pages['pages'] as $k => $page) : ?>

						<?php $output = LayoutHelper::render('joomla.pagination.link', $page); ?>
						<?php if (in_array($k, range($range * $step - ($step + 1), $range * $step), true)) : ?>
							<?php if (($k % $step === 0 || $k === $range * $step - ($step + 1)) && $k !== $currentPage && $k !== $range * $step - $step) : ?>
								<?php $output = preg_replace('#(<a.*?>).*?(</a>)#', '$1...$2', $output); ?>
							<?php endif; ?>
						<?php endif;  ?>

						<?php echo $output; ?>
					<?php endforeach; ?>
					<?php echo LayoutHelper::render('joomla.pagination.link', $pages['next']); ?>
					<?php  echo LayoutHelper::render('joomla.pagination.link', $pages['end']); ?>
				<!--</ul>-->
			<?php endif; ?>

			<?php if ($showLimitStart) : ?>
				<input type="hidden" name="<?php echo $list['prefix']; ?>limitstart" value="<?php echo $list['limitstart']; ?>">
			<?php endif; ?>

		</div>
                    </div>
<?php endif; ?>
