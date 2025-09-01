<?php 
// No direct access
defined('_JEXEC') or die; ?>

<?php $countAged  = array_key_exists(57,$counts) ? $counts[57]->sunolo: 0?>
<?php $countHouse  = array_key_exists(60,$counts) ? $counts[60]->sunolo: 0?>
<?php $countChildren  = array_key_exists(58,$counts) ? $counts[58]->sunolo: 0?>


<section class="container-xxl">
<!--            <div class="title pb-2">
                <h2 class="text-center mb-4 noselect">Αγγελίες εύρεσης εργασίας</h2>
            </div>-->
            <div class="row gx-xxl-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <a href="/search-personnel.html?filter[types]=<?php  echo $specialities[57]->speciality?>" class="home_cat">
                    <!-- <a href="/aggelies.html?filter[types]=<?php // echo $specialities[57]->speciality?>" class="home_cat"> -->
                        <img src="/templates/elpidajob_home/img/frontida_ilikiomenwn_cat.jpg">
                        <div class="homecat_overlay">
                            <div>
                                <h3>Φροντίδα ηλικιωμένων</h3>
                                <p>Βρες εργασία ως γηροκόμος κατ&#39; οίκον. Το γραφείο Elpida Job με την πολυετή εμπειρία του
στον τομέα της φροντίδας ηλικιωμένων, σου βρίσκει άμεσα την κατάλληλη εργασία, με την
ώρα ή 24ωρη.</p>
                                <p><?php echo $countAged?> προτάσεις</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <a href="/search-personnel.html?filter[types]=<?php  echo $specialities[60]->speciality?>" class="home_cat">
                    <!-- <a href="/aggelies.html?filter[types]=<?php //echo $specialities[60]->speciality?>" class="home_cat"> -->
                        <img src="/templates/elpidajob_home/img/oikiaki_voitheia_cat.jpg">
                        <div class="homecat_overlay">
                            <div>
                                <h3>Φροντίδα σπιτιού</h3>
                                <!-- <h3>Φροντίδα/Καθάρισμα σπιτιού</h3> -->
                                 <p>Βρες εργασία ως εξωτερική οικιακή βοηθός ή ως εσωτερική σε σπίτι. Επίλεξε τον χώρο που θα
φροντίζεις και θα είσαι υπεύθυνη για τις οικιακές εργασίες (καθάρισμα σπιτιού, μαγείρεμα,
σίδερο).</p>
                                <p><?php echo $countHouse?> προτάσεις</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-0 mb-md-0">
                    <a href="/search-personnel.html?filter[types]=<?php  echo $specialities[58]->speciality?>" class="home_cat">
                    <!-- <a href="/aggelies.html?filter[types]=<?php //echo $specialities[58]->speciality?>" class="home_cat"> -->
                        <img src="/templates/elpidajob_home/img/babysitter_cat.jpg">
                        <div class="homecat_overlay">
                            <div>
                                <h3>Φύλαξη παιδιών</h3>
                                <p>Βρες εργασία ως babysitter (νταντά) με πλήρη ή μερική απασχόληση. Χιλιάδες
οικογένειες αναζητούν το ιδανικό άτομο για τη φροντίδα των παιδιών τους. Βρες άμεσα αυτή
που σου ταιριάζει.</p>
                                <p><?php echo $countChildren?> προτάσεις</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>