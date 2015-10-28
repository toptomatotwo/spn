

function spn_at_field__field_event_date_sl__program_event_archive($variables){
  

  
    $date = $variables['date'];
    $timezone = $variables['timezone'];
    $attributes = $variables['attributes'];
  


// Wrap the result with the attributes.
    return '<span class="date-display-single"' . drupal_attributes($attributes) . '>' . $date . $timezone . '</span>';
}
