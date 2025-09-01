<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\CMS\Factory;
$user = Factory::getUser();

?>
<?php if ($user->id !=0) :?>
 <div class="search-form" >               
                <div class="autocomplete">
                    <input id="DiscreteTitle" type="text" name="filter[DiscreteTitle]" placeholder="Εργοδότης">
                </div>
<div class="sep_line"></div>
                <div class="autocomplete">
                    <input id="EmpAddress" type="text" name="filter[EmpAddress]" placeholder="Δ/νση Εργοδότη">
                </div>
<div class="sep_line"></div>
                <div class="autocomplete">
                    <input id="VatNo" type="text" name="filter[VatNo]" placeholder="ΑΦΜ">
                </div>
</div>
<?php endif; 

