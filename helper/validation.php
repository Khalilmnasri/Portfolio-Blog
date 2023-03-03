<?php

function checkForm($array, $fields) {
  foreach($fields as $field) {
    if(!array_key_exists($field, $array) || empty($array[$field])) {
      return false;
    }
  }
  return true;
}