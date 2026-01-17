<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_category
 *
 * @copyright   (C) 2010 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;

if (!$list) {
    return;
}
?>
<section class="testimonials">
    <div class="container-fluid text-center">
        <h2 class="bodyTitleLarge">Είπαν για εμάς</h2>
        <div class="swiper testimonialsSlider">
            <div class="swiper-wrapper">

<?php $items = $list; 
 require ModuleHelper::getLayoutPath('mod_articles_category', $params->get('layout', 'default') . '_items'); ?>

            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</section>






