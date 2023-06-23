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

//Register style on initalization
add_action('init', 'register_classifieds_style');
function register_classifieds_style() {
  wp_register_style( 'classifieds_style', plugins_url('/css/classifieds.css', __FILE__), false, '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_classifieds_style');
function enqueue_classifieds_style(){
  wp_enqueue_style( 'classifieds_style' );
}

// Add a menu for our option page
add_action( 'admin_menu', 'vs_classified_plugin_add_settings_menu' );

function vs_classified_plugin_add_settings_menu() {

    add_options_page( 'VS Classified Plugin Settings', 'VS Classified Settings', 'manage_options',
        'vs_classified_plugin', 'vs_classified_plugin_option_page' );

}
// Create the option page
function vs_classified_plugin_option_page() {
    ?>
    <div class="wrap">

	    <form action="options.php" method="post">
		    <?php
            settings_fields( 'vs_classified_plugin_options' );
		    do_settings_sections( 'vs_classified_plugin' );
		    submit_button( 'Save Changes', 'primary' );
            ?>
	    </form>
    </div>
    <?php
}
// Register and define the settings
add_action('admin_init', 'vs_classified_plugin_admin_init');

function vs_classified_plugin_admin_init(){

	// Define the setting args
	$args = array(
	    'type' 				=> 'string',
	    'sanitize_callback' => 'vs_classified_plugin_validate_options',
	    'default' 			=> NULL
	);

    // Register our settings
    register_setting( 'vs_classified_plugin_options', 'vs_classified_plugin_options', $args );

    // Add a settings section
    add_settings_section(
    	'vs_classified_plugin_main',
    	'VS Classified Plugin Settings',
        'vs_classified_plugin_section_text',
        'vs_classified_plugin'
    );

    // Create our settings field for session
    add_settings_field(
    	'vs_classified_plugin_phone',
    	'Phone',
        'vs_classified_plugin_setting_phone',
        'vs_classified_plugin',
        'vs_classified_plugin_main'
    );
    // Create our settings field for session
    add_settings_field(
    	'vs_classified_plugin_rate',
    	'Rate',
        'vs_classified_plugin_setting_rate',
        'vs_classified_plugin',
        'vs_classified_plugin_main'
    );
    // Create our settings field for session
    add_settings_field(
    	'vs_classified_plugin_deadline',
    	'Deadline',
        'vs_classified_plugin_setting_deadline',
        'vs_classified_plugin',
        'vs_classified_plugin_main'
    );
    add_settings_field(
      'vs_classified_plugin_additional',
      'Optional Message',
        'vs_classified_plugin_setting_additional',
        'vs_classified_plugin',
        'vs_classified_plugin_main'
    );

    // Create our settings field for session
    /*
    add_settings_field(
    	'vs_classified_plugin_phone',
    	'Phone',
        'vs_classified_plugin_setting_phone',
        'vs_classified_plugin',
        'vs_classified_plugin_main'
    );
    */
    // Create our settings field for beast mode
    /*
    add_settings_field(
      'vs_classified_plugin_display_results',
      'Enable Display Results?',
        'vs_classified_plugin_setting_display_results',
        'vs_classified_plugin',
        'vs_classified_plugin_main'
    );
    */
}

// Draw the section header
function vs_classified_plugin_section_text() {

    echo '<p>Enter your settings here.</p>';

}

// Display and fill the session text form field
function vs_classified_plugin_setting_phone() {

    // Get option 'text_string' value from the database
    $options = get_option( 'vs_classified_plugin_options' );
    $phone = $options['phone'];

    // Echo the field
    echo "<textarea id='phone' name='vs_classified_plugin_options[phone]' rows='4' cols='50'>" . esc_attr( $phone ) . "</textarea>";
}

function vs_classified_plugin_setting_rate() {
    $options = get_option( 'vs_classified_plugin_options' );
    $rate = $options['rate'];

    // Echo the field
    echo "<textarea id='rate' name='vs_classified_plugin_options[rate]' rows='4' cols='50'>" . esc_attr( $rate ) . "</textarea>";

}
function vs_classified_plugin_setting_deadline() {
   $options = get_option( 'vs_classified_plugin_options' );
  $deadline = $options['deadline'];

    // Echo the field
    echo "<textarea id='deadline' name='vs_classified_plugin_options[deadline]' rows='4' cols='50'>" . esc_attr( $deadline ) . "</textarea>";
}
function vs_classified_plugin_setting_additional() {
   $options = get_option( 'vs_classified_plugin_options' );
  $additional = $options['additional'];

    // Echo the field
    echo "<textarea id='additional' name='vs_classified_plugin_options[additional]' rows='4' cols='50'>" . esc_attr( $additional ) . "</textarea>";
}
function vs_classified_plugin_setting_display_results() {

	// Get option 'display_results' value from the database
  // Set to 'disabled' as a default if the option does not exist
	$options = get_option( 'vs_classified_plugin_options', [ 'display_results' => 'disabled' ] );
	$display_results = $options['display_results'];

	// Define the radio button options
	$items = array( 'enabled', 'disabled' );

	foreach( $items as $item ) {

		// Loop the two radio button options and select if set in the option value
		echo "<label><input " . checked( $display_results, $item, false ) . " value='" . esc_attr( $item ) . "' name='vs_classified_plugin_options[display_results]' type='radio' />" . esc_html( $item ) . "</label><br />";

	}

}

// Validate user input for all three options
function vs_classified_plugin_validate_options( $input ) {

	// Only allow letters and spaces for the session
	/*
    $valid['session'] = preg_replace(
        '/[^a-z0-9]/i',
        '',
        $input['session'] );

    if( $valid['session'] !== $input['session'] ) {

        add_settings_error(
            'vse_plugin_text_string',
            'vse_plugin_texterror',
            'Incorrect value entered! Please only input letters and spaces.',
            'error'
        );

    }
*/
   $valid = $input;
   echo $valid;

    return $valid;
}
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
  //Display Header at the bottom - 6/23/23
  displayHeader();
?>
</div>
</div>
<nav>
    <div id="classifiedsNavButtons">
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
$options = get_option( 'vs_classified_plugin_options' );
$phone = $options['phone'];
$rate = $options['rate'];
$deadline = $options['deadline'];
$additional = $options['additional'];

?>
<div class = 'classifiedIntructions'>
  <p><?php echo $phone;?></p>
  <p><?php echo $rate;?></p>
 <!--
  <p>Ads submitted and scheduled before&nbsp;<strong>10:30AM FRIDAY</strong>&nbsp;will be included in the Tuesday edition of The Free Press and Thursday edition of The Courier-Gazette, The Camden Herald, and The Republican Journal.</p>
 -->
  <p><?php echo $deadline;?></p>
  <?php
  if (strlen($additional))
  {
    ?>
      <p><strong><?php echo $additional;?></strong> </p>
    <?php
  }
     ?>
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
