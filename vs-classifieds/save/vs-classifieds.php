<?php
/**
 * Plugin Name:     VS Classifieds
 * Description:     Create shortcodes to display classifieds
 * Author:          Ray St. Onge
 * Text Domain:     vs-classifieds
 * Domain Path:     /languages
 * Version:         1.2.0
 *
 * @package         VS_Classifieds
 */

// Your code starts here.
add_shortcode('classifiedsYardSales','getClassifiedsYardSales');

function getClassifiedsYardSales() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'category_name' => '1335 Garage Sales',
    //'category_in' => array(207,181,208,209,210),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

add_shortcode('classifiedsPublicNotices','getClassifiedsPublicNotices');

function getClassifiedsPublicNotices() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'category_name' => '1007 General Notices,1000 Public Notices,1001 Legal Notices',
    //'category_in' => array(207,181,208,209,210),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

add_shortcode('classifiedsMerchandise','getClassifiedsMerchandise');

function getClassifiedsMerchandise() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'category_name' => '1300 Antiques Collectibles,1307 Auctions,1312 Business Opportunities,1321 Craft Fairs,1340 General Merchandise,1350 Lawn and Garden,1375 Sports Exercise,1385 Wanted To Buy,1405 Boats Canoes Kayaks,1410 Camping Equipment,1420 Fishing Hunting Supply,1425 Hot Tubs Saunas Pools,1435 Skies Skates & Equip,1440 Snowmobiles & Access,1445 Sports Craft',
    //'category_in' => array(207,181,208,209,210),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

add_shortcode('classifiedsServiceDirectory','getClassifiedsServiceDirectory');

function getClassifiedsServiceDirectory() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'category_name' => '5510 Books,5120 Carpentry & Remodeling,5130 Carpet & Flooring Serv,5140 Chimney Services,5150 Cleaning Service,5155 Oil Tanks,5156 Coal Oil Wood,5160 Computer Services,5170 Construction,5180 Contractors,5189 Driveways,5190 Drywall & Plastering,5195 Educational Services,5200 Electrician,5210 Excavation,5213 Exterior Cleaning,5220 Franchises,
    5228 Garage Doors,5230 General Services,5240 Handyperson,5250 Health Care Services,5260 Home Improvement,5270 HVAC,5271 Air Conditioners,5280 Insulation,5290 Landscaping,5292 Lawn & Yard Care,5300 Loam Sand Gravel,5310 Masonry Concrete Brick,5320 Moving Shipping Storage,5330 Painting Plaster Paper,5340 Paving & Seal Coating,5345 Plumbing,5350 Pool Services,
    5356 Removal-Salvage,5358 Repair-Service,5360 Roofing Siding Gutters,5370 Rubbish Hauling,5373 Sealcating,5380 Snow Removal,5390 Tree Services, Professional Directory',
    //'category_in' => array(207,181,208,209,210),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

/*************************/
add_shortcode('randomClassifieds','getRandomClassifieds');

function getRandomClassifieds() {
  $type='classified';
  $args = array(
    'posts_per_page' => 3,
    'orderby'   => 'rand',
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifieds($args);
}

add_shortcode('allClassifiedsPretty','getAllClassifiedsPretty');

function getAllClassifiedsPretty() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

add_shortcode('classifiedsRealEstate','getClassifiedsRealEstate');

function getClassifiedsRealEstate() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'category_name' => '3505 Commercial Sale,3515 Homes For Sale,3545 Property Auction,3550 Real Estate Services,3572 Real Estate Wanted,3575 Community Open House,3590 RE Professionals Ad,3600 Miscellaneous',
    //'category_in' => array(217,204,211,212,213,214,215,216),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

add_shortcode('classifiedsRentals','getClassifiedsRentals');

function getClassifiedsRentals() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    //'category_name' => '3005 Commercial Lease',
    'category_name' => '3005 Commercial Lease,3040 Apartments,3045 Apt-House To Share,3055 Houses For Rent,3068 Rental Services,3070 Rooms for Rent,3075 Seasonal Rentals,3095 Wanted to Rent',
    //'category_in' => array(188,194,186,202,195,218,219,220),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}

add_shortcode('classifiedsHelpWanted','getClassifiedsHelpWanted');

function getClassifiedsHelpWanted() {
  $type='classified';
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $args = array(
    'posts_per_page' => 24,
    'paged' => $paged,
    'category_name' => 'Help Wanted,2000 Education,2005 General Help,2030 Positions Wanted,2055 Schools Instruction,2065 Social Services',
    //'category_in' => array(207,181,208,209,210),
    'post_status' => 'publish',
    'post_type' => $type
  );
  return getClassifiedsPretty($args);
}
function getClassifiedsPretty($args){
  ob_start();
?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clamp-js/0.7.0/clamp.min.js" integrity="sha512-Zf7q41OZ49XVIFrkbCVLkBEklVxQv4sVdMGnCwL9bfuCfA862QmAJSU61yrcrMwze7Ij7oUXpQVoUXmftBfk0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function(){
    var clampable = $( ".classified" );
    var arrayLength = clampable.length;
    for (var i = 0; i < arrayLength; i++) {
      $clamp(clampable[i], {
        clamp:11
      });
    }
    $( "#comments" ).remove();
  });
</script>
<div class="classifiedWrapperOuter">
<?php
  displayHeader();
 // print_r($args);
  ?>
  <div class="classifiedWrapper">
  <?php

  $cpt_query = new WP_Query($args);
  if ($cpt_query->have_posts())
  {
    while ($cpt_query->have_posts())
    {
      $cpt_query->the_post();
      if (strlen(get_the_content())){
   $className="classLinerAd";
 } else {
   $className ="classDisplayAd";
 }
 ?>

 <div class="<?php echo $className;?>">
   <a class="classified" href="<?php echo the_permalink();?>">
     <?php
 if (strlen(get_the_content()))
 {
   echo get_the_content();
 }
 else
 {
   //echo "This is a display ad. Need the image<br>";
   //the_post_thumbnail( array(150, 100), ['class' => 'prettyThumbnail', 'style' => 'float:left; margin-right: 25px;'] );
   echo get_the_post_thumbnail(get_the_ID(),'medium');
 }
 ?>
   </a>
   <br/>
 </div>

 <?php
    }
  }
?>
</div>
</div>
<nav>
    <div>
      <div class = "classifiedsPreviousButton" ><?php previous_posts_link( 'Back...', $cpt_query->max_num_pages) ?></div>
      <div class = "classifiedsNextButton"><?php next_posts_link( 'More...', $cpt_query->max_num_pages) ?></div>
    </div>
</nav>



<?php
wp_reset_postdata();
return ob_get_clean();
}
function displayHeader(){
//  echo date("Y-m-d H:i:s");
?>
<div class = 'classifiedIntructions'>
  <p>To place a Classified ad, please call the office, 207-594-4401, 207-338-3333, 207-596-0055 or email to&nbsp;classifieds@mainestaymedia.com </p>
  <p>$10.00 per week for the first 15 words. $0.50 per week for each additional word.</p>
 <!--
  <p>Ads submitted and scheduled before&nbsp;<strong>10:30AM FRIDAY</strong>&nbsp;will be included in the Tuesday edition of The Free Press and Thursday edition of The Courier-Gazette, The Camden Herald, and The Republican Journal.</p>
 -->
  <p>Ads submitted and scheduled before&nbsp;<strong>4:30PM MONDAY</strong>&nbsp;will be included in the Thursday edition of The&nbsp;Courier-Gazette, The&nbsp;Camden&nbsp;Herald, and The&nbsp;Republican&nbsp;Journal and the following Tuesday edition of The Free Press.</p>
  <!--<p><strong>Due to Monday, 9/5 being Labor Day our Deadline is this Friday at 5pm.</strong> </p>-->
</div>
<?php
}
function getClassifieds($args){
  ob_start();
  $htmlText = '';
  $htmlText ='
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clamp-js/0.7.0/clamp.min.js" integrity="sha512-Zf7q41OZ49XVIFrkbCVLkBEklVxQv4sVdMGnCwL9bfuCfA862QmAJSU61yrcrMwze7Ij7oUXpQVoUXmftBfk0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function(){
    var clampable = $( ".classified" );
    var arrayLength = clampable.length;
    for (var i = 0; i < arrayLength; i++) {
      $clamp(clampable[i], {
        clamp:11
      });
    }
    $( "#comments" ).remove();
  });
</script>
<div class="classifiedWrapperOuter">';
$htmlText=$htmlText.'
  <div class="classifiedWrapper">';
  $cpt_query = new WP_Query($args);
  if ($cpt_query->have_posts())
  {
    while ($cpt_query->have_posts())
    {
      $cpt_query->the_post();
      if (strlen(get_the_content())){
      $className="classLinerAd";
     } else {
        $className ="classDisplayAd";
   }


  $htmlText = $htmlText.'<div class="' . $className . '">';
  $htmlText = $htmlText.'<a class="classified" href="'.the_permalink().'">';
  if (strlen(get_the_content()))
  {
    $htmlText = $htmlText.get_the_content();
  }
  else
  {
   //echo "This is a display ad. Need the image<br>";
   //the_post_thumbnail( array(150, 100), ['class' => 'prettyThumbnail', 'style' => 'float:left; margin-right: 25px;'] );
   $htmlText = $htmlText.get_the_post_thumbnail(get_the_ID(),"medium");
  }
  $htmlText = $htmlText.' </a>
   <br/>
 </div>';

    }
  }

  $htmlText = $htmlText.'</div>
</div>';


wp_reset_postdata();
ob_get_clean();

return $htmlText;
}
