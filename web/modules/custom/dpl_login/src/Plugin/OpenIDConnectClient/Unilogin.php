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
      'authorization_endpoint' => 'https://et-broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/auth',
      'token_endpoint' => 'https://et-broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/token',
      'userinfo_endpoint' => 'https://et-broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/userinfo',
      'logout_endpoint' => 'https://et-broker.unilogin.dk/auth/realms/broker/protocol/openid-connect/logout',
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

    // Explicitly set scope to "openid" as Unilogin requires this.
    // @see https://viden.stil.dk/display/OFFSKOLELOGIN/Opgradering+af+Unilogin+Broker+-+Breaking+changes
    $options["query"]["scope"] = "openid";

    // Generate PKCE code verifier and code challenge.
    // @see https://auth0.com/docs/get-started/authentication-and-authorization-flow/authorization-code-flow-with-pkce
    // @see https://viden.stil.dk/display/OFFSKOLELOGIN/Implementering+af+tjeneste#Implementeringaftjeneste-1.3.1Hvordangenerereskorrektcode_challengeogcodeverifier
    $code_verifier = bin2hex(random_bytes(32));
    $code_challenge = rtrim(strtr(base64_encode(hash('sha256', $code_verifier, TRUE)), '+/', '-_'), '=');

    $options["query"]["code_challenge"] = $code_challenge;
    $options["query"]["code_challenge_method"] = "S256";

    $_SESSION['unilogin_oauth2_code_verifier'] = $code_verifier;

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
