<?php
class user_mailman_register_handler_filter_sync_status extends views_handler_filter_in_operator {
  function get_value_options() {
    $this->value_options = _user_mailman_register_sync_options();
  }
}
