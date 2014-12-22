<?php

/**
 *  @file
 *  Configuration settings for Wunderhub client.
 */

function wunderub_client_settings() {
  $form = array();

  $form['wunderhub_client_team_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Url where the JSON team feed is'),
    '#size' => 150,
    '#default_value' => variable_get('wunderhub_client_team_url', ''),
  );


  return system_settings_form($form);
}
