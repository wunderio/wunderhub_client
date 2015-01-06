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

  $form['wunderhub_client_team_member_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Base url where the JSON team member feed is'),
    '#description' => t('Don\'t include the id, i.e. http://example.com/user'),
    '#size' => 150,
    '#default_value' => variable_get('wunderhub_client_team_member_url', ''),
  );

  return system_settings_form($form);
}
