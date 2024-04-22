<?php

namespace Drupal\dpl_login;

use Drupal\Core\TempStore\PrivateTempStore;
use Drupal\Core\TempStore\PrivateTempStoreFactory;

/**
 * Handles user token storage.
 */
class RegisteredUserTokensProvider implements UserTokensProviderInterface {
  /**
   * Access token type.
   */
  protected AccessTokenType $accessTokenType = AccessTokenType::USER;

  /**
   * User session storage.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStore
   */
  protected PrivateTempStore $tempStore;

  /**
   * Constructor of UserTokensProvider.
   *
   * @param \Drupal\Core\TempStore\PrivateTempStoreFactory $temp_store_factory
   *   User session store factory.
   */
  public function __construct(PrivateTempStoreFactory $temp_store_factory) {
    $this->tempStore = $temp_store_factory->get(static::class);
  }

  /**
   * {@inheritdoc}
   */
  public function setAccessToken(AccessToken $accessToken): void {
    $accessToken->type = $this->accessTokenType;
    $this->tempStore->set('access_token', $accessToken);
  }

  /**
   * {@inheritdoc}
   */
  public function getAccessToken(): ?AccessToken {
    $token = $this->tempStore->get('access_token');
    return $token;
  }

  /**
   * {@inheritdoc}
   */
  public function deleteAccessToken(): bool {
    return $this->tempStore->delete('access_token');
  }

}
