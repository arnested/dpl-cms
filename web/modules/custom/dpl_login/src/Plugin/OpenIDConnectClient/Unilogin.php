<?php

namespace Drupal\dpl_login\Plugin\OpenIDConnectClient;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\GeneratedUrl;
use Drupal\openid_connect\Plugin\OpenIDConnectClientBase;

/**
 * Unilogin openid_connect plugin.
 *
 * @OpenIDConnectClient(
 *   id = "Unilogin",
 *   label = @Translation("Unilogin")
 * )
 */
class Unilogin extends OpenIDConnectClientBase {

  /**
   * {@inheritdoc}
   *
   * @return mixed[]
   *   Default configuration.
   */
  public function defaultConfiguration(): array {
    return [
      'authorization_endpoint' => 'https://broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/auth',
      'token_endpoint' => 'https://broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/token',
      'userinfo_endpoint' => 'https://broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/userinfo',
      'logout_endpoint' => 'https://broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/logout',
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   *
   * @param mixed[] $form
   *   Drupal form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Drupal form state.
   *
   * @return mixed[]
   *   Drupal form array.
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['authorization_endpoint'] = [
      '#title' => $this->t('Authorization endpoint', [], ['context' => 'Dpl Login']),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['authorization_endpoint'],
    ];
    $form['token_endpoint'] = [
      '#title' => $this->t('Token endpoint', [], ['context' => 'Dpl Login']),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['token_endpoint'],
    ];
    $form['userinfo_endpoint'] = [
      '#title' => $this->t('UserInfo endpoint', [], ['context' => 'Dpl Login']),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['userinfo_endpoint'],
    ];
    $form['logout_endpoint'] = [
      '#title' => $this->t('Logout endpoint', [], ['context' => 'Dpl Login']),
      '#type' => 'textfield',
      '#default_value' => $this->configuration['logout_endpoint'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   *
   * @return mixed[]
   *   Various endpoints.
   */
  public function getEndpoints(): array {
    return [
      'authorization' => $this->configuration['authorization_endpoint'],
      'token' => $this->configuration['token_endpoint'],
      'userinfo' => $this->configuration['userinfo_endpoint'],
    ];
  }

  /**
   * {@inheritdoc}
   *
   * @param string $scope
   *   Oauth2 scope.
   * @param \Drupal\Core\GeneratedUrl $redirect_uri
   *   The redirect uri.
   *
   * @return mixed[]
   *   Url options array.
   */
  protected function getUrlOptions($scope, GeneratedUrl $redirect_uri): array {
    $options = parent::getUrlOptions($scope, $redirect_uri);
    // unset($options["query"]["redirect_uri"]);.
    // $options["query"]["redirect_uri"] = "https://stg.ereolengo.itkdev.dk/unilogin/callback";
    $options["query"]["code_challenge"] = "OexM_p_DZhy69S1ORWUKTY6L4pNnj94ySwL3bDELbjY";
    $options["query"]["code_challenge_method"] = "S256";
    $asdhasdh = '';

    return $options;
  }

  /**
   * {@inheritdoc}
   *
   * Unilogin doesn't return an ID Token. The inherited method cannot
   * handle / decode the missing / null value so we hardcode the decoded value
   * to be an empty array.
   *
   * @return mixed[]
   *   Decoded id token.
   */
  public function decodeIdToken($id_token): array {
    return [];
  }

}
