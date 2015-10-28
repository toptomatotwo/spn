<?php

/**
 * @file
 * Implimentation of hook_form_system_theme_settings_alter()
 *
 * To use replace "adaptivetheme_subtheme" with your themeName and uncomment by
 * deleting the comment line to enable.
 *
 * @param $form: Nested array of form elements that comprise the form.
 * @param $form_state: A keyed array containing the current state of the form.
 */
/* -- Delete this line to enable. 
function spn_at_form_system_theme_settings_alter(&$form, &$form_state)  {
  // Your knarly custom theme settings go here...
	echo '<script>alert("do me")</script>';
}
*/
function spn_at_form_system_theme_settings_alter($variables){
	$form['breadcrumb_delimiter'] = array(
		'#type' => 'textfield',
		'#title' => t('Breadcrumb delimiter'),
		'#size' => 4
		);
	$form['use_twitter'] = array(
		'#type' => 'checkbox',
		'#title' => t('Use Twitter for site slogan')	
		);
	$form['twitter_search_term'] = array(
		'#type' => 'textfield',
		'#title' => t('Twitter search term')	
		);
}
