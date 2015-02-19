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

  $form['display_options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Data display options'),
  );

  $form['display_options']['group'] = array(
    '#type' => 'select',
    '#options' => array('country' => t('Country'), 'office' => t('Office'), 'jobTitle' => t('Job title')),
    '#title' => t('Group field'),
    '#description' => t('Select the field for grouping the data.'),
    '#default_value' => isset($settings['group']) ? $settings['group'] : 'country',
  );

  $form['display_options']['sort'] = array(
    '#type' => 'select',
    '#options' => array('firstName' => t('First name'), 'lastName' => t('Last name'), 'jobTitle' => t('By job title'), 'randomSort' => t('Randomly')),
    '#title' => t('Sort field'),
    '#description' => t('Select the field for sorting the data.'),
    '#default_value' => isset($settings['sort']) ? $settings['sort'] : 'alphabetically',
  );

  $form['display_options']['promoted_group'] = array(
    '#type' => 'textfield',
    '#title' => t('Promoted group'),
    '#description' => t('The group (office, country, job title) promoted by this option will be displayed the first in the list. Leave empty for no action.'),
    '#default_value' => isset($settings['promoted_group']) ? $settings['promoted_group'] : '',
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

/**
 * Submit callback for the configuration form.
 */
function wunderhub_client_settings_submit($form, &$form_state) {
  $settings = variable_get('wunderhub_client', array());
  foreach (array('endpoints', 'display_options') as $option) {
    $elements = $form_state['values'][$option];
    foreach ($elements as $name => $value) {
      $settings[$name] = $value;
    }
  }

  variable_set('wunderhub_client', $settings);

  drupal_set_message(t('The configuration options have been saved.'));
}
