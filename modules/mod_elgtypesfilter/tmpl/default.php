<?php 

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

use Joomla\CMS\Factory;

$home = Factory::getApplication() -> getMenu() -> getActive() -> home ;



?>

<div class="home_search">

    <?php if ( $home == 1): ?>

        <div class="home_search_categories">

            <button class="button button_sm bg_white " data-cat="anazitisi_proswpikou">Αναζήτηση προσωπικού</button>

            <button class="button button_sm bg_white active" data-cat="evresi_ergasias">Εύρεση εργασίας</button>

        </div>

    <?php endif; ?>

                    <form autocomplete="off" id ="frontpageform"  method="get" action="/aggelies.html?view=jobs">
                    
                        <input id="category" type="hidden"   value="anazitisi_proswpikou">

                      <div class="autocomplete">

                        <input id="types" type="text" name="filter[types]" placeholder="Τι ειδικότητα;">

                      </div>

                      <div class="sep_line"></div>

                      <div class="autocomplete">

                        <input id="locations" type="text" name="filter[locations]" placeholder="Για ποια περιοχή;">

                      </div>

                      <button type="submit" class="search_button button button_filled bg_blue">

                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" fill="#fff" viewBox="0 0 511.999 511.999" width="22px" height="22px"><path d="M508.874,478.708L360.142,329.976c28.21-34.827,45.191-79.103,45.191-127.309c0-111.75-90.917-202.667-202.667-202.667

                        S0,90.917,0,202.667s90.917,202.667,202.667,202.667c48.206,0,92.482-16.982,127.309-45.191l148.732,148.732

                        c4.167,4.165,10.919,4.165,15.086,0l15.081-15.082C513.04,489.627,513.04,482.873,508.874,478.708z M202.667,362.667

                        c-88.229,0-160-71.771-160-160s71.771-160,160-160s160,71.771,160,160S290.896,362.667,202.667,362.667z"/></svg>

                        <span>Αναζήτηση</span>

                        </button>

                    </form>



                    <div class="call_us">Χρειάζεστε βοήθεια; <a href="tel:2105230341">Καλέστε μας στο 210 5230341</a></div>

                </div>

