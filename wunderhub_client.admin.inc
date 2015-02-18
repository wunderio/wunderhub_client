<?php

/**
 *  @file
 *  Configuration settings for WunderHub Client.
 */

/**
 * Configuration form.
 */
function wunderhub_client_settings($form, &$form_state) {
  $form = array('#tree' => TRUE);
  $settings = variable_get('wunderhub_client', array());

  $form['endpoints'] = array(
    '#type' => 'fieldset',
    '#title' => t('Endpoints'),
  );

  $form['endpoints']['team_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Team URL'),
    '#description' => t('Enter URL to team endpoint.'),
    '#default_value' => isset($settings['team_url']) ? $settings['team_url'] : '',
  );

  $form['endpoints']['team_member_url'] = array(
    '#type' => 'textfield',
    '#title' => t('Single team member URL'),
    '#description' => t('Enter URL to single team member endpoint. Note that <code>/[id]</code> is appended automatically.'),
    '#default_value' => isset($settings['team_member_url']) ? $settings['team_member_url'] : '',
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

/**
 * Submit callback for configuration form.
 */
function wunderhub_client_settings_submit($form, &$form_state) {
  $settings = variable_get('wunderhub_client', array());
  $endpoints = $form_state['values']['endpoints'];

  foreach ($endpoints as $name => $url) {
    $settings[$name] = $url;
  }

  variable_set('wunderhub_client', $settings);

  drupal_set_message(t('The configuration options have been saved.'));
}
