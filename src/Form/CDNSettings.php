<?php

/**
 * @file
 * Contains \Drupal\cdn_pull_origin\Form\CDNSettings.
 */

namespace Drupal\cdn_pull_origin\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure site information settings for this site.
 */
class CDNSettings extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'cdn_pull_origin_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['cdn_pull_origin.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = \Drupal::config('cdn_pull_origin.settings');

    $form['domain'] = [
      '#type'          => 'textfield',
      '#title'         => $this->t('CDN Domain'),
      '#default_value' => $config->get('domain'),
      '#description'   => $this->t('Please specify CDN domain. For example, if CloudFront returns https://d111111abcdef8.cloudfront.net as the domain name for your distribution use <em>https://d111111abcdef8.cloudfront.net</em>.'),
      '#required'      => TRUE,
      '#attributes'    => [
        'placeholder' => 'https://cdn-domain-name.com',
      ],
    ];

    $form['enabled'] = [
      '#type'          => 'checkbox',
      '#title'         => $this->t('Enable CDN'),
      '#default_value' => $config->get('enabled'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('cdn_pull_origin.settings');

    // Save settings.
    $config
      ->set('domain', $form_state->getValue('domain'))
      ->set('enabled', $form_state->getValue('enabled'))
      ->save();

    // Clear Drupal cache.
    drupal_flush_all_caches();

    parent::submitForm($form, $form_state);

  }

}
