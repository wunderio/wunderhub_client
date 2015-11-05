<?php

/**
 * @file
 * Contains \Drupal\wunderhub_client\Form\WunderHubConfigForm.
 */

namespace Drupal\wunderhub_client\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

/**
 * Provides the WunderHub client configuration form.
 */
class WunderHubConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormID() {
    return 'wunderhub_client_config_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['wunderhub_client.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('wunderhub_client.settings');
//    dpm($config);

    $form['endpoints'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Endpoints'),
    ];

    $form['endpoints']['wunderhub_api_url'] = [
      '#type' => 'url',
      '#title' => $this->t('WunderHub API URL'),
      '#description' => $this->t('Enter the URL of the WunderHub API'),
      '#default_value' => $config->get('wunderhub_api_url'),
    ];
    $form['endpoints']['team'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Team Endpoints'),
//      '#tree' => TRUE,
    ];
    $form['endpoints']['team']['team_api_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Team API endpoint'),
      '#description' => $this->t('Enter URL to team endpoint.'),
      '#default_value' => $config->get('team_api_endpoint'),
    ];

    $form['endpoints']['team']['team_member_api_endpoint'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Single team member API URL'),
      '#description' => $this->t('Enter URL to single team member endpoint. Note that <code>/[id]</code> is appended automatically.'),
      '#default_value' => $config->get('team_member_api_endpoint'),
    ];

    if (\Drupal::moduleHandler()->moduleExists('wunderhub_client_blog')) {
      $form['endpoints']['blog'] = array(
        '#type' => 'fieldset',
        '#title' => $this->t('Blog endpoints'),
//        '#tree' => TRUE,
      );

      $form['endpoints']['blog']['blog_api_endpoint'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Blog API endpoint'),
        '#description' => $this->t('Enter URL to blog endpoint.'),
        '#default_value' => $config->get('blog_api_endpoint'),
      ];

      $form['endpoints']['blog']['blog_entry_api_endpoint'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Single blog entry API URL'),
        '#description' => $this->t('Enter URL to single team member endpoint. Note that <code>/[id]</code> is appended automatically.'),
        '#default_value' => $config->get('blog_entry_api_endpoint'),
      ];
    }

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $endpoints = array(
      'team_api_endpoint',
      'team_member_api_endpoint',
    );
    if (\Drupal::moduleHandler()->moduleExists('wunderhub_client_blog')) {
      $endpoints = array_merge($endpoints, array('blog_api_endpoint', 'blog_entry_api_endpoint'));
    }
//    dpm($endpoints);

    foreach ($endpoints as $endpoint) {
      // Validate $endpoint path.
      if (($value = $form_state->getValue($endpoint)) && $value[0] !== '/') {
        $form_state->setErrorByName($endpoint, $this->t("The path '%path' has to start with a slash.", ['%path' => $form_state->getValue($endpoint)]));
      }
    }

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $endpoints = array(
      'wunderhub_api_url',
      'team_api_endpoint',
      'team_member_api_endpoint',
    );
    if (\Drupal::moduleHandler()->moduleExists('wunderhub_client_blog')) {
      $endpoints = array_merge($endpoints, array('blog_api_endpoint', 'blog_entry_api_endpoint'));
    }

    $config = \Drupal::configFactory()->getEditable('wunderhub_client.settings');
    foreach ($endpoints as $key) {
      $config->set($key, $form_state->getValue($key));
    }

    $config->save();

    drupal_set_message($this->t('The configuration options have been saved.'));
  }
}
