<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   (C) 2020 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

?>
<?php foreach ($items as $item) : ?>

	<?php if ($params->get('link_titles') == 1) : ?>
		<?php $attributes = ['class' => 'mod-articles-category-title ' . $item->active]; ?>
		<?php $link = htmlspecialchars($item->link, ENT_COMPAT, 'UTF-8', false); ?>
		<?php $title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false); ?>
		<?php echo HTMLHelper::_('link', $link, $title, $attributes); ?>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>

	<?php if ($item->displayHits) : ?>
		<span class="mod-articles-category-hits">
			(<?php echo $item->displayHits; ?>)
		</span>
	<?php endif; ?>

	<?php if ($params->get('show_author')) : ?>
		<span class="mod-articles-category-writtenby">
			<?php echo $item->displayAuthorName; ?>
		</span>
	<?php endif; ?>

	<?php if ($item->displayCategoryTitle) : ?>
		<span class="mod-articles-category-category">
			(<?php echo $item->displayCategoryTitle; ?>)
		</span>
	<?php endif; ?>

	<?php if ($item->displayDate) : ?>
		<span class="mod-articles-category-date"><?php echo $item->displayDate; ?></span>
	<?php endif; ?>

	<?php if ($params->get('show_tags', 0) && $item->tags->itemTags) : ?>
		<div class="mod-articles-category-tags">
			<?php echo LayoutHelper::render('joomla.content.tags', $item->tags->itemTags); ?>
		</div>
	<?php endif; ?>

	<?php if ($params->get('show_introtext')) : ?>
		<div class="swiper-slide">
                    <div class="d-flex justify-content-center align-items-center">
                        <img class="quotes_img_start" src="/templates/elpidajob_home/img/quotes_img.svg">
                        <p class="bodyTextLarge">
                            <span><?php echo $item->displayIntrotext; ?></span>
                        </p>
                        <img class="quotes_img_end" src="/templates/elpidajob_home/img/quotes_img.svg">
                    </div>
                </div>
        <?php endif; ?>	

<?php endforeach; ?>
