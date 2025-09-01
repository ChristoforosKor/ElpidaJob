<?php
// no direct access
defined('_JEXEC') or die('Restricted access');



/**
 * @todo  "ΚΩΔ. ΑΓΓΕΛΙΑΣ", "τμ", "ρεπό/μήνα"  από μετάφραση, να μεφναίζω τα κουμπία της κατηγορίας όπου τα έχει ο Ρεβής.
 */
?>











<section class="aggeliesSlider">
    <div class="aggelies_slider_container">
        <div class="container-xxl">
            <div class="title"><h2 class="text-center mb-4 noselect"><?php echo $module -> title; ?></h2></div>
            <div style="position: relative;" class="text-center">
                <div class="aggeliesSliderCategoriesContainer mb-2">
                            
                <?php if ( $idSelected === 0 ): ?>
                    <div class="noselect aggeliesSliderCategories">
                        <button class="tab_button active tab_button_aggelies" data-cat="all">Όλα</button>
                        <button class="tab_button tab_button_aggelies" data-cat="frontida_ilikiomenwn">Φροντίδα ηλικιωμένων</button>
                        <button class="tab_button tab_button_aggelies" data-cat="oikiaki_voitheia">Οικιακή βοήθεια</button>
                        <button class="tab_button tab_button_aggelies" data-cat="filaksi_paidiwn">Φύλαξη παιδιών</button>
                    </div>
                <?php endif; ?>
                    </div>
                <div class="button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 512 512"><polyline points="328 112 184 256 328 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"/></svg>
                </div>
                <div class="button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 512 512"><polyline points="184 112 328 256 184 400" style="fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px"/></svg>
                </div>
            </div>
        </div>
        <div class="swiper aggelies_slider">
            <div class="swiper-wrapper leftGap">
                <?php foreach ($data as $item):
                    if ($item->idSpeciality==57) {
                        $filter = "frontida_ilikiomenwn";
                    }
                    else if ($item->idSpeciality==58){
                        $filter = "filaksi_paidiwn";
                    } else if ($item->idSpeciality==60) {
                        $filter = "oikiaki_voitheia";
                    }?>
                    <div class="swiper-slide aggelies_slide" data-filter="<?php echo $filter?>">
                        <a href="/<?php echo $item -> linkToPage . '?id=' . $item -> id; ?>">
                            <div class="aggelies_slide_top">
                                <h3><?php echo $item->title; ?></h3>
                                <p>ΚΩΔ. ΑΓΓΕΛΙΑΣ: <?php echo $item->id; ?></p>
                            </div>
                            <p class="description"><?php echo $item->description; ?></p>
                            <div class="specs">
                                <?php foreach ($item->specs as $specKey => $spec):
                                    if ($spec !== ''):
                                ?>
                                        <p class="<?php echo $specKey; ?>"><?php echo $spec; ?></p>
                                    <?php endif;
                                endforeach;
                                unset($specKey);
                                unset($spec); ?>

                                <?php /* if ( $item -> fullparttime !== ''): ?>
                                  <p class="fullparttime"><?php echo $item -> fullparttime; ?></p>
                                  <?php endif; ?>
                                  <?php if ( $item -> location !== ''): ?>
                                  <p class="location"><?php echo $item -> location ; ?></p>
                                  <?php endif; ?>
                                  <?php if ( $item -> housesize !== ''): ?>
                                  <p class="housesize"><?php echo $item -> housesize;?>τμ</p>
                                  <?php endif; ?>
                                  <?php if ( $item -> salary !== ''): ?>
                                  <p class="salary"><?php echo $item -> salary; ?>€</p>
                                  <?php endif; ?>
                                  <?php if ( $item -> daysOff !== ''): ?>
                                  <p class="daysOff"><?php echo $item -> daysOff; ?> ρεπό/μήνα</span></p>
                                  <?php endif; ?>
                                  <?php if ( $item -> disability !== ''): ?>
                                  <p class="disability"><?php echo $item -> disability; ?></p>
                                  <?php endif; */ ?>
                            </div>
                            <div class="date_added">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 488.152 488.152">
                                    <path d="M177.854,269.311c0-6.115-4.96-11.069-11.08-11.069h-38.665c-6.113,0-11.074,4.954-11.074,11.069v38.66    c0,6.123,4.961,11.079,11.074,11.079h38.665c6.12,0,11.08-4.956,11.08-11.079V269.311L177.854,269.311z"/>
                                    <path d="M274.483,269.311c0-6.115-4.961-11.069-11.069-11.069h-38.67c-6.113,0-11.074,4.954-11.074,11.069v38.66    c0,6.123,4.961,11.079,11.074,11.079h38.67c6.108,0,11.069-4.956,11.069-11.079V269.311z"/>
                                    <path d="M371.117,269.311c0-6.115-4.961-11.069-11.074-11.069h-38.665c-6.12,0-11.08,4.954-11.08,11.069v38.66    c0,6.123,4.96,11.079,11.08,11.079h38.665c6.113,0,11.074-4.956,11.074-11.079V269.311z"/>
                                    <path d="M177.854,365.95c0-6.125-4.96-11.075-11.08-11.075h-38.665c-6.113,0-11.074,4.95-11.074,11.075v38.653    c0,6.119,4.961,11.074,11.074,11.074h38.665c6.12,0,11.08-4.956,11.08-11.074V365.95L177.854,365.95z"/>
                                    <path d="M274.483,365.95c0-6.125-4.961-11.075-11.069-11.075h-38.67c-6.113,0-11.074,4.95-11.074,11.075v38.653    c0,6.119,4.961,11.074,11.074,11.074h38.67c6.108,0,11.069-4.956,11.069-11.074V365.95z"/>
                                    <path d="M371.117,365.95c0-6.125-4.961-11.075-11.069-11.075h-38.67c-6.12,0-11.08,4.95-11.08,11.075v38.653    c0,6.119,4.96,11.074,11.08,11.074h38.67c6.108,0,11.069-4.956,11.069-11.074V365.95L371.117,365.95z"/>
                                    <path d="M440.254,54.354v59.05c0,26.69-21.652,48.198-48.338,48.198h-30.493c-26.688,0-48.627-21.508-48.627-48.198V54.142    h-137.44v59.262c0,26.69-21.938,48.198-48.622,48.198H96.235c-26.685,0-48.336-21.508-48.336-48.198v-59.05    C24.576,55.057,5.411,74.356,5.411,98.077v346.061c0,24.167,19.588,44.015,43.755,44.015h389.82    c24.131,0,43.755-19.889,43.755-44.015V98.077C482.741,74.356,463.577,55.057,440.254,54.354z M426.091,422.588    c0,10.444-8.468,18.917-18.916,18.917H80.144c-10.448,0-18.916-8.473-18.916-18.917V243.835c0-10.448,8.467-18.921,18.916-18.921    h327.03c10.448,0,18.916,8.473,18.916,18.921L426.091,422.588L426.091,422.588z"/>
                                    <path d="M96.128,129.945h30.162c9.155,0,16.578-7.412,16.578-16.567V16.573C142.868,7.417,135.445,0,126.29,0H96.128    C86.972,0,79.55,7.417,79.55,16.573v96.805C79.55,122.533,86.972,129.945,96.128,129.945z"/>
                                    <path d="M361.035,129.945h30.162c9.149,0,16.572-7.412,16.572-16.567V16.573C407.77,7.417,400.347,0,391.197,0h-30.162    c-9.154,0-16.577,7.417-16.577,16.573v96.805C344.458,122.533,351.881,129.945,361.035,129.945z"/>
                                </svg> <span><?php echo $item->timeText; ?></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach;
                unset($item); ?>

                <div class="swiper-slide aggelies_slide more_aggelies" data-filter="all" style="margin-right: 30px;" role="group" aria-label="5 / 5">
                        <a href="/el/aggelies.html">
                            <svg version="1.1" width="150" height="150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 960 960">
                                <style type="text/css">
                                    .st0{fill:#FFFFFF;}
                                    .st1{fill:#EBF7FE;}
                                    .st2{fill:#3BB3F1;}
                                    .st3{fill:#f7fcff;}
                                </style>
                                <g>
                                    <path class="st0" d="M703.7,736.5v-574H159.9v581.9c0,29.4,23.8,53.2,53.2,53.2h490.7h31.6v-61h-31.7L703.7,736.5L703.7,736.5z"></path>
                                    <path class="st3" d="M751.7,797.2L751.7,797.2c-26.8,0-48.5-21.7-48.5-48.5V414.4h96.9v334.3C800.1,775.5,778.4,797.2,751.7,797.2z
                                        "></path>
                                    <rect x="216.4" y="309.1" class="st1" width="437.9" height="133.1"></rect>
                                    <rect x="216.4" y="255.5" class="st2" width="437.9" height="27.6"></rect>
                                    <rect x="216.4" y="483.3" class="st1" width="437.9" height="26.8"></rect>
                                    <rect x="216.4" y="544.9" class="st1" width="437.9" height="26.8"></rect>
                                    <rect x="216.4" y="606.6" class="st1" width="249.8" height="26.8"></rect>
                                    <rect x="216.4" y="668.3" class="st1" width="249.8" height="26.8"></rect>
                                    <rect x="498.6" y="606.6" class="st2" width="155.8" height="88.5"></rect>
                                </g>
                            </svg>
                            <span>Περισσότερες αγγελίες</span>
                        </a>
                    </div>
            </div>
        </div>
    </div>
</section>