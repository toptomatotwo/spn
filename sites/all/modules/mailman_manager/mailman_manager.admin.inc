<?php

/**
 * @file
 * Admin stuff for mailmain_manager module
 */

/**
 * Admin display of mailman lists.
 */
function _mailman_manager_admin_display() {
  if (!user_access('administer mailman_manager')) {
    return '';
  }
  $output = '';

  $headers = array(
    array(
      'data' => t('Name'),
      'field' => 'name',
    ),
    array(
      'data' => t('Request Address'),
      'field' => 'command',
    ),
    t('Roles'),
    array('data' => t('Actions')),
  );

  $result = db_select('mailman_lists', 'ml')->fields('ml')->extend('PagerDefault')->extend('TableSort')->orderByHeader($headers)->limit(15)->execute();
  $lists = array();

  // Get the roles from the database.
  $all_roles = _mailman_manager_get_roles();
  $rows = array();
  foreach ($result as $list) {
    // The links/actions for this row.
    $actions = l(t('Edit'), 'admin/config/mailman_manager/edit/' . $list->lid) . '<br />' . l(t('Delete'), 'admin/config/mailman_manager/delete/' . $list->lid);
    $roles = unserialize($list->roles);
    $list->role_names = array();
    foreach ($roles as $rid => $value) {

      if ($value) {
        $list->role_names[] = $all_roles[$rid];
      }
    }

    $lists[] = array(
      $list->name,
      $list->command,
      implode($list->role_names, ', '),
      $actions,
    );
  }

  if (count($lists) == 0) {
    $output .= '<p>' . t('No lists.') . '</p>';
  }
  $output .= l(t('Add new mailing list'), 'admin/config/mailman_manager/add');
  if (count($lists)) {
    $output .= theme('table', array('header' => $headers, 'rows' => $lists));
    $output .= theme('pager', array());
  }

  return $output;
}

/**
 * Administrate mailling lists.
 * 
 * Path: admin/config/mailman_manager/add
 */
function mailman_manager_admin_form($form, &$form_state, $lid = NULL) {
  $form = array();
  if ($lid) {
    $form['lid'] = array(
      '#type' => 'hidden',
      '#value' => $lid,
    );
  }

  $form['name'] = array(
    '#title' => 'Mailing List name',
    '#default_value' => !empty($list->name) ? $list->name : '',
    '#type' => 'textfield',
    '#required' => TRUE,
  );
  $form['reqaddress'] = array(
    '#title' => t("Mailing List 'request' address"),
    '#default_value' => !empty($list->command) ? $list->command : '',
    '#description' => t('Commands are sent here'),
    '#type' => 'textfield',
    '#required' => TRUE,
  );
  $form['adminaddress'] = array(
    '#title' => t("Mailing List 'admin' address"),
    '#default_value' => !empty($list->admin) ? $list->admin : '',
    '#description' => t('(Optional. admin is used for BCC)'),
    '#type' => 'textfield',
  );
  $form['webaddress'] = array(
    '#title' => t('Mailing list web address for users'),
    '#default_value' => !empty($list->web) ? $list->web : '',
    '#description' => t('http://...') . t('Leave empty if hidden.'),
    '#type' => 'textfield',
  );
  $form['webarchive'] = array(
    '#title' => t('Mailing list web archive address for users'),
    '#default_value' => !empty($list->webarch) ? $list->webarch : '',
    '#description' => t('http://.... ') . t('Leave empty if hidden.'),
    '#type' => 'textfield',
  );

  $form['roles'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Roles'),
    '#description' => t('Only offer to users in these roles.'),
    '#options' => _mailman_manager_get_roles(),
  );
  if (isset($list->roles)) {
    $form['roles']['#default_value'] = unserialize($list->roles);
  }

  $form['Submit'] = array(
    '#type' => 'submit',
    '#value' => ($lid ? t('Save') : t('Add')),
  );

  return $form;
}

/**
 * Validate form.
 */
function mailman_manager_admin_form_validate($form, &$form_state) {
  // Check name is unique.
  $lid = !empty($form_state['values']['lid']) ? $form_state['values']['lid'] : 0;

  $query = db_select('mailman_lists', 'ml')->fields('ml')->condition('name', $form_state['values']['name'], '=');

  if ($lid) {
    $query->condition('lid', $lid, '<>');
  }

  $query->countQuery();

  $result = $query->execute();

  $num_rows = $result->fetchField();
  if ($num_rows != '0') {
    form_set_error('name', 'Name already in use');
  }
  if ($form_state['values']['reqaddress'] && !valid_email_address($form_state['values']['reqaddress'])) {
    form_set_error('reqaddress', t('"%reqaddress" is not a valid email address', array('%reqaddress' => $form_state['values']['reqaddress'])));
  }
  if ($form_state['values']['adminaddress'] && !valid_email_address($form_state['values']['adminaddress'])) {
    form_set_error('adminaddress', t('"%adminaddress" is not a valid email address', array('%adminaddress' => $form_state['values']['adminaddress'])));
  }
  if ($form_state['values']['webaddress'] && !valid_url($form_state['values']['webaddress'])) {
    form_set_error('webaddress', t('"%webaddress" is not a valid url', array('%webaddress' => $form_state['values']['webaddress'])));
  }
  if ($form_state['values']['webarchive'] && !valid_url($form_state['values']['webarchive'])) {
    form_set_error('webarchive', t('"%webarchive" is not a valid url', array('%webarchive' => $form_state['values']['webarchive'])));
  }
}

/**
 * Save new mailing list.
 */
function mailman_manager_admin_form_submit($form, &$form_state) {
  if (!user_access('administer mailman_manager')) {
    return '';
  }

  $list = new stdClass();

  $list->name = $form_state['values']['name'];
  $list->command = $form_state['values']['reqaddress'];
  $list->admin = $form_state['values']['adminaddress'];
  $list->web = $form_state['values']['webaddress'];
  $list->webarch = $form_state['values']['webarchive'];
  $list->roles = serialize($form_state['values']['roles']);

  // Update.
  if (!empty($form_state['values']['lid'])) {
    $list->lid = $form_state['values']['lid'];
    drupal_write_record('mailman_lists', $list, array('lid'));
    drupal_set_message(t('Mailing List %name updated', array('%name' => $list->name)));
  }
  else {
    $lid = drupal_write_record('mailman_lists', $list);
    drupal_set_message(t('New Mailman list %name successfully created', array('%name' => $list->name)));
  }
  drupal_goto('admin/config/mailman_manager');
}
