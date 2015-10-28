<?php

/**
 * @file
 * Process theme data.
 *
 * Use this file to run your theme specific implimentations of theme functions,
 * such preprocess, process, alters, and theme function overrides.
 *
 * Preprocess and process functions are used to modify or create variables for
 * templates and theme functions. They are a common theming tool in Drupal, often
 * used as an alternative to directly editing or adding code to templates. Its
 * worth spending some time to learn more about these functions - they are a
 * powerful way to easily modify the output of any template variable.
 *
 * Preprocess and Process Functions SEE: http://drupal.org/node/254940#variables-processor
 * 1. Rename each function and instance of "adaptivetheme_subtheme" to match
 *    your subthemes name, e.g. if your theme name is "footheme" then the function
 *    name will be "footheme_preprocess_hook". Tip - you can search/replace
 *    on "adaptivetheme_subtheme".
 * 2. Uncomment the required function to use.
 */



/**
 * Preprocess variables for the html template.
 */
/* -- Delete this line to enable.
function adaptivetheme_subtheme_preprocess_html(&$vars) {
  global $theme_key;

  // Two examples of adding custom classes to the body.

  // Add a body class for the active theme name.
  // $vars['classes_array'][] = drupal_html_class($theme_key);

  // Browser/platform sniff - adds body classes such as ipad, webkit, chrome etc.
  // $vars['classes_array'][] = css_browser_selector();

}
// */


/**
 * Process variables for the html template.
 */
/* -- Delete this line if you want to use this function
function adaptivetheme_subtheme_process_html(&$vars) {
}
// */


/**
 * Override or insert variables for the page templates.
*/

/*
function spn_at_preprocess_page(&$vars) {
  kpr($vars);
}

function adaptivetheme_subtheme_process_page(&$vars) {
}
*/


/**
 * Override or insert variables into the node templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_node(&$vars) {
}
function adaptivetheme_subtheme_process_node(&$vars) {
}
// */


/**
 * Override or insert variables into the comment templates.
 */
/* -- Delete this line if you want to use these functions
function adaptivetheme_subtheme_preprocess_comment(&$vars) {
}
function adaptivetheme_subtheme_process_comment(&$vars) {
}
// */


/**
 * Override or insert variables into the block templates.
 */
/* -- Delete this line if you want to use these functions */
function spn_at_preprocess_block(&$vars) {
  //kpr($vars);
}

function spn_at_process_block(&$vars) {
}


function spn_at_css_alter(&$css) {
  unset($css[drupal_get_path('module','system').'/system.menus.css']);
}


/*
function spn_at_menu_link_alter($variables){

}

function spn_at_preprocess_links(&$vars) {

}
*/


function spn_at_preprocess_page(&$variables){

if($variables['is_front'] == TRUE) {
    drupal_add_css(path_to_theme(). '/css/front_page.css', array('group'=>CSS_THEME));
  }
if (!empty($variables['node']) && !empty($variables['node']->type)) {
    $variables['theme_hook_suggestions'][] = 'page__node__' . $variables['node']->type;
  }

 if($variables['id'] == 1) {
  $variables['content_header_attributes_array']['class'][] = 'about';
 } 
/*
if($variables['theme_hook_suggestions'][4] = 'page__taxonomy__term__20') {
  echo '<script>alert("huh?")</script>';
}
kpr($variables);
*/
//kpr($variables['node']);
/* REDID IN NODE PREPROCESS INSTEAD, LOAD CONDITIONAL CSS
$node = $variables['node'];
$nid = $node->nid;

if($nid == '83') {
  $variables['theme_hook_suggestions'][] = 'page__archive_landing.tpl.php';
  
   } 
print $nid;
kpr($variables);
*/
/* FOR FEATURE, DETERMINE IF IS A FEATURE OR LIBRARY */
if((!empty($variables['node'])) && ($variables['node']->type == 'feature')) {
  $output = '';
  $node = $variables['node'];
  $items = field_get_items('node', $node, 'field_feature_library_status');

  //var_dump($items);

  foreach($items as $item) {
  /*  $field_output = field_view_value('node', $node, 'field_feature_library_status', $item);
    $output .= render($field_output); */
    foreach ($item as $libStatus) {
      if ($libStatus == 16) {
        $featlibdates = field_get_items('node', $node, 'field_feature_date');
        foreach($featlibdates as $featlibdate) {
          foreach($featlibdate as $breakdown) {
            $dateraw = $breakdown;
            break;
            } 

          }
      $year = substr($dateraw, 0, 4);
      $monthInt = substr($dateraw, 5, 2);
        //print $monthInt;
      switch($monthInt) {
        case "08":
        $month = 'August';
        break;
        case "09":
        $month = 'September';
        break;
        case "10":
        $month = 'October';
        break;
        case "11":
        $month = 'November';
        break;
        case "12":
        $month = 'December';
        break;
        }
      $variables['year'] = $year;
      $variables['month'] = $month;
          $variables['featLibHeader'] = '<h1 class="feature-lib-hdr library-hdr">Library</h1><div class="dateholder"><span class="month"><h5>'. $month .'</h5></span><span class="year"><h5>' . $year.'</h5></span></div>';
        } else {
          $variables['featLibHeader'] = '<h1 class="feature-lib-hdr featured-hdr">Featured Content</h1>';
      }
    }
  } 
}


 
/* END IF FEATURE OR LIBRARY */
}

function spn_at_links($variables) {
 
//if((!$variables['heading']['text']) && ($variables['heading']['text'] == "Main menu")) {$isMainMenu = true;} else {$isMainMenu = false;}
  

  $links = $variables['links'];
  $attributes = $variables['attributes'];
  $heading = $variables['heading'];
  if($heading)
  global $language_url;
  $output = '';
  


  if (count($links) > 0) {
    $output = '';

    // Treat the heading first if it is present to prepend it to the
    // list of links.
    if (!empty($heading)) {
      if (is_string($heading)) {
        // Prepare the array that will be used when the passed heading
        // is a string.
        $heading = array(
          'text' => $heading,
          
          // Set the default level of the heading.
          'level' => 'h2',
        );
      }



      $output .= '<' . $heading['level'];
      if (!empty($heading['class'])) {
        $output .= drupal_attributes(array('class' => $heading['class']));
      }
      $output .= '>' . check_plain($heading['text']) . '</' . $heading['level'] . '>';
    }

    $output .= '<ul' . drupal_attributes($attributes) . '>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = array($key);

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class[] = 'first';
      }
      if ($i == $num_links) {
        $class[] = 'last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page())) && (empty($link['language']) || $link['language']->language == $language_url->language)) {
        $class[] = 'active';
      }
      $output .= '<li' . drupal_attributes(array('class' => $class)) . '>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      elseif (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes.
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span' . $span_attributes . '>' . $link['title'] . '</span>';
      }

      $i++;
      $output .= "</li>\n";
      
     // if($isMainMenu) {
      if((!empty($heading['text'])) && ($heading['text'] == 'Main menu')) {
        $output .= "<li class='main-m-bullets'>&bull;</li>";
      }
      
    }

    $output .= '</ul>';
  }

  return $output;
}


/* NOT WORKING, FUNC IS NOT FIRING */ 
function spn_at_links__system_main_menu($variables) {
  echo '<script>alert("sys menu func running")</script>';
  $html = "<div class='myclass'>";
  $html .= "  <ul>";  
  foreach ($variables['links'] as $link) {
    $html .= "<li>".l($link['title'], $link['path'], $link)."</li>";
  }
  $html .= "  </ul>";
  $html .= "</div>";

  return $html;
}
/*
function spn_at_theme($existing, $type, $theme, $path){
  echo '<script>alert("hook theme running")</script>';

} */

function spn_at_preprocess_node(&$vars) {
  //echo '<script>alert("running preprocess node")</script>';
//print $vars['nid']; 
//kpr($vars); 
/* BEGIN OG STUFF HERE */
  $og_title = array(
  '#tag' => 'meta',
  '#attributes' => array(
    'property' => 'og:title',
    'content' => $vars['title'],
    ),
  ); 
 
drupal_add_html_head($og_title, 'og_title');


$body_field = field_view_field('node', $vars['node'], 'body', array('type' => 'text_plain')); 

if($body_field){

$og_description = array( 
  '#tag' => 'meta', 
  '#attributes' => array( 
    'property' => 'og:description', 
   'content' => text_summary($body_field[0]['#markup']), ), ); 


 drupal_add_html_head($og_description, 'og_description'); 
}
/* END OG STUFF */
if(($vars['type']=='panelist') || ($vars['type']=='moderator')) {
  drupal_add_css(path_to_theme(). '/css/panelist-moderator.css', array('group'=>CSS_THEME));
}
  
  if($vars['title'] == 'About SPN') {
    drupal_add_css(path_to_theme(). '/css/about-spn-3.css', array('group'=>CSS_THEME));
  }  
  if($vars['type'] == 'feature') {
    drupal_add_css(path_to_theme(). '/css/feature-spn.css', array('group'=>CSS_THEME));
  }
/*
  if($vars['type'] == 'library') {
    drupal_add_css(path_to_theme(). '/css/feature-spn.css', array('group'=>CSS_THEME));
  }
  */
  if(($vars['type'] == 'landing_page') && ($vars['title'] == 'Network')) {
    //print 'network node deteced';
    drupal_add_css(path_to_theme(). '/css/network.css', array('group'=>CSS_THEME));
  }
  if(($vars['type'] == 'landing_page') && ($vars['title'] == 'Insights')) {
    //print 'network node deteced';
    drupal_add_css(path_to_theme(). '/css/insights.css', array('group'=>CSS_THEME));
  }
  if(($vars['type'] == 'landing_page') && ($vars['title'] == 'Events')) {
    //print 'network node deteced';
    drupal_add_css(path_to_theme(). '/css/events.css', array('group'=>CSS_THEME));
  }
  if(($vars['type'] == 'landing_page') || ($vars['nid'] == '71')) {
    $vars['display_submitted'] = FALSE;
  }
/* 
182 - 2013-14, 
83, 2012-13,
84, 2011 - 12,
177, 2010 - 11,
179, 2009 - 10,
180, 2008 - 09,
181, 2007 - 08
184, 2006 - 07,
183 2005 - 06,
*/
  $archiveLandingPageIds = array('182', '83', '84', '177', '179', '180', '181', '184', '183' );

  $alpc = count($archiveLandingPageIds);
 
foreach (array('182', '83', '84', '177', '179', '180', '181', '184', '183') as $value) {
    if($vars['nid'] == $value) {
      drupal_add_css(path_to_theme(). '/css/archive-landing.css', array('group'=>CSS_THEME));   
    }
}
/*
  if(($vars['nid'] == '83') || ($vars['nid'] == '72') || ($vars['nid'] == '84')){
   $vars['display_submitted'] = FALSE; 
   drupal_add_css(path_to_theme(). '/css/archive-landing.css', array('group'=>CSS_THEME));
  } */
}
 

function spn_at_preprocess_image(&$vars){
	//kpr($vars);
	if((isset($vars['style_name'])) && ($vars['style_name'] == 'large_logo')) {
		$vars['attributes']['class'][] = "homepage-logo";
	//	echo '<script>alert("logo assigned");</script>'; 
	}
  foreach(array('width', 'height') as $key){
    unset($vars[$key]);
  }
	
}
	


function spn_at_form_alter(&$form, &$form_state, &$form_id) {
  if($form_id == 'search_block_form'){
    $form['search_block_form']['#default_value'] = t('search...');
    $form['actions']['submit'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme() . '/images/search.png');
  }
  $form['search_block_form']['#attributes']['onfocus'] = "if (this.value == 'search...') {this.value = '';}";
  
}



/* FIELD FUNCTIONS */

/*FEATURE-LIBRARY PAGES */

function spn_at_field__field_source__feature($vars) {
$output = '';

  // Render the label, if it's not hidden.
  $output .= '<section class="feature-lib-section">'; 
   $output .= '<h2 class="feature-lib-label">Source</h2>:&nbsp;';
  

  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
  }
  
  $output .= '</section>';

  return $output;
}

 function spn_at_field__field_feature_summary_ii__feature($vars){
 $output = '';

  // Render the label, if it's not hidden.
  $output .= '<section class="feature-lib-section">';
  $output .= '<h2 class="feature-lib-label">Summary</h2>:&nbsp;';
  
  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
  }
  
  $output .= '<hr class="feature-summary-hr"/>';
  $output .= '</section>';
  // Render the top-level wrapper element.
  

  return $output;
}

function spn_at_field__field_feature_date__feature($vars){
  //kpr($vars);
  $output = '';

  // Render the label, if it's not hidden.
  if (!$vars['label_hidden']) {
    $output .= '<h2 class="field-label"' . $vars['title_attributes'] . '>' . $vars['label'] . ':&nbsp;</h2>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $vars['content_attributes'] . '>';
  foreach ($vars['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $vars['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level wrapper element.
  $tag = $vars['tag'];
  $output = "<$tag class=\"" . $vars['classes'] . '"' . $vars['attributes'] . '>' . $output . "</$tag>";

  return $output;
}

/* PROGRAM EVENT FUNCTIONS */

function spn_at_field__field_time_display__program_entry($vars){
 $output = '';
   $output .= '<div class="program-event-time">';
 
  // Render the label, if it's not hidden.

    $output .= '<h2 class="program-event-label">Time:&nbsp;</h2>';


  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    
    $output .= drupal_render($item);
    }
 

  // Render the top-level wrapper element.

  $output .= '</div>';
  return $output;
}

function spn_at_field__field_program_host__program_entry($vars){
  $output = '';
   $output .= '<div class="program-event-host">';
 
  // Render the label, if it's not hidden.

    $output .= '<h2 class="program-event-label">Host:&nbsp;</h2>';


  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    
    $output .= drupal_render($item);
    }
 

  // Render the top-level wrapper element.

  $output .= '</div>';
  return $output;
}

function spn_at_field__field_program_venu__program_entry($vars){
  $output = '';
   $output .= '<div class="program-event-venue">';
 
  // Render the label, if it's not hidden.

    $output .= '<h2 class="program-event-label">Venue:&nbsp;</h2>';


  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    
    $output .= drupal_render($item);
    }
 

  // Render the top-level wrapper element.

  $output .= '</div>';
  return $output;
}

/* PROGRAM EVENT ARCHIVE FUNCTIONS */

function spn_at_field__field_program_venu__program_event_archive($vars){
   $output = '';
   $output .= '<div class="program-event-archive-venue">';
  // Render the label, if it's not hidden.
    $output .= '<h2 class="program-event-label">Venue:&nbsp;</h2>';
  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
    }
  // Render the top-level wrapper element.
  $output .= '</div>';
  return $output;
}
function spn_at_field__field_program_host__program_event_archive($vars){
   $output = '';
   $output .= '<div class="program-event-archive-host">';
  // Render the label, if it's not hidden.
    $output .= '<h2 class="program-event-label">Host:&nbsp;</h2>';
  // Render the items.
  
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
    }
  // Render the top-level wrapper element.
  $output .= '</div>';
  return $output;
}
function spn_at_field__field_moderator_static__program_event_archive($vars){
  $output = '';
   $output .= '<div class="program-event-archive-moderator">';
  // Render the label, if it's not hidden.
  $output .= '<h2 class="program-event-label">Moderator:&nbsp;</h2>';
  // Render the items.
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
    }
  // Render the top-level wrapper element.
  $output .= '</div>';
  return $output;
}


function spn_at_field__field_panelists_static__program_event_archive($vars){
  $output = '';
   $output .= '<div class="program-event-archive-panelists">';
  // Render the label, if it's not hidden.
  $output .= '<h2 class="program-event-label">Panelists:&nbsp;</h2>';
  // Render the items.
  foreach ($vars['items'] as $delta => $item) {
    $output .= drupal_render($item);
    }
  // Render the top-level wrapper element.
  $output .= '</div>';
  return $output;
}
/*
function spn_at_preprocess_menu_link(&$variables){
  echo '<pre>' . print_r($variables, true) . '</pre>';
  if(menu_get_object()){
    $parsed_path = explode('/', drupal_get_path_alias());
    kpr($parsed_path);

  }

}
*/
/* ARCHIVES PROGRAM EVENT FUNCTIONS */

function spn_at_date_display_single($variables) {
  $date = $variables['date'];
  $timezone = $variables['timezone'];
  $attributes = $variables['attributes'];

  // Wrap the result with the attributes.
  $output = '<span class="date-display-single"' . drupal_attributes($attributes) . '>' . $date . $timezone . '</span>';

  if ($variables['add_microdata']) {
    $output .= '<meta' . drupal_attributes($variables['microdata']['value']['#attributes']) . '/>';
  }

  return $output;
}