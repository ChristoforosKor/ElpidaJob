<?php 
// No direct access
defined('_JEXEC') or die; ?>

<section class="container-xxl">
    <div class="mb-4 text-center title_with_selection">
                <!--<h2>Άμεσα διαθέσιμοι στην περιοχή: <span>Αττική</h2>-->
                <h2>Άμεσα διαθέσιμοι</h2>
                <!--<button id="getLocationBtn" class="button button_outlined button_sm blue">Δείτε κοντά σας</button>-->
            </div>
            <div class="noselect listSliderCategories">
                <button class="tab_button tab_button_list active" data-cat="all">Όλοι</button>
                <button class="tab_button tab_button_list" data-cat="frontida_ilikiomenwn">Φροντίδα ηλικιωμένων</button>
                <button class="tab_button tab_button_list" data-cat="oikiaki_voitheia">Οικιακή βοήθεια</button>
                <button class="tab_button tab_button_list" data-cat="filaksi_paidiwn">Φύλαξη παιδιών</button>
            </div>
    <div class="listSliderContainer">         
        <div class="swiper listSlider">
            <div class="swiper-wrapper">

    <?php foreach($data as $item): 
                    $ids = explode( ",",$item->idSpeciality);
                    // var_dump($ids);
                    $filter ="";
                    if (in_array('57',$ids) ) {
                        $filter = "frontida_ilikiomenwn";
                    }
                    else if (in_array('58',$ids) ) {
                        $filter = "filaksi_paidiwn";
                    } else if (in_array('60',$ids) ) {
                        $filter = "oikiaki_voitheia";
                    }?>
                <div class="swiper-slide list_slide" data-filter="<?php echo $filter?>">
                    <a href="/personnel?id=<?php echo $item->id?>" class="userListTile hoverFx">
                        <div class="userListTileImg">
                            <img src=/<?php if ($item->allowphoto == 1) { echo $item->image; }?>>
                        </div>
                        <div class="userListTileTxt">
                            <h4><?php echo $item->name, " ", mb_substr($item ->lastname,0,1),".";?></h4>
                            <p class="location"><?php echo $item->suburb?></p>
                            <?php /* <p class="recommended"><?php echo $item->id?> προτείνουν</p> */ ?>
                            <p class="recommended"><?php echo  $item->speciality?></p>
                            
                        </div>
                    </a>
                </div>

    <?php    endforeach; unset($item); ?>

            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>