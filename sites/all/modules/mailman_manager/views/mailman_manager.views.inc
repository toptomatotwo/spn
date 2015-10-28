<?php

/**
 * @file
 * View defnition.
 */

/**
 * Defineing a view that lists subscribers.
 */
function mailman_manager_views_data() {
  
  $data = array();

  // Lists.
  $data['mailman_lists']['table']['group'] = t('Mailing Lists');
  $data['mailman_lists']['table']['base'] = array(
    'field' => 'lid',
    'title' => t('Mailman'),
    'help' => t('Mailing lists maintained by mailman_manager module'),
  );

  $data['mailman_lists']['lid'] = array(
    'title' => t('List ID'),
    'help' => t('lid'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  $data['mailman_users']['table']['group'] = t('Mailing List Subscribers');
  $data['mailman_users']['table']['base'] = array(
    'field' => 'uid',
    'title' => t('Subscriber'),
    'help' => t('Subscriber'),
  );
  $data['mailman_users']['lid'] = array(
    'title' => t('List Id'),
    'help' => t('list'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  $data['mailman_users']['uid'] = array(
    'title' => t('User Id'),
    'help' => t('uid'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  $data['mailman_lists']['table']['join'] = array(
    'node' => array(
      'left_field' => 'lid',
      'field' => 'lid',
    ),
    'help' => t('Photos imported from Flickr.com'),
  );

  $data['mailman_lists']['name'] = array(
    'title' => t('Name'),
    'help' => t('name of this mailing list'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );
  $data['mailman_lists']['command'] = array(
    'title' => t('Request Address'),
    'help' => t('Subscribe/Unsubscribe commands are sent here'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  $data['mailman_lists']['admin'] = array(
    'title' => t('Admin Address'),
    'help' => t('BCCed'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  $data['mailman_lists']['web'] = array(
    'title' => t('Web Address'),
    // 'help' => t('Subscribe/Unsubscribe commands are sent here'),
    'field' => array(
      'views_handler_field',
      'click sortable' => false,
    ),
    'sort' => array(
      'handler' => 'views_handler_sort',
    ),
    'filter' => array(
      'handler' => 'views_handler_filter_string',
    ),
  );

  return $data;
}
