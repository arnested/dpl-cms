<?php

namespace Drupal\dpl_login;

use Drupal\Core\TempStore\PrivateTempStore;
use Drupal\Core\TempStore\PrivateTempStoreFactory;

/**
 * Handles the various user tokens from a STIL Unilogin Oauth authorization_code flow.
 */
class UniloginUserTokensProvider {
  /**
   * User session storage.
   *
   * @var \Drupal\Core\TempStore\PrivateTempStore
   */
  protected PrivateTempStore $tempStore;

  /**
   * Constructor of RegisteredUserTokensProvider.
   *
   * @param \Drupal\Core\TempStore\PrivateTempStoreFactory $temp_store_factory
   *   User session store factory.
   */
  public function __construct(PrivateTempStoreFactory $temp_store_factory) {
    $this->tempStore = $temp_store_factory->get(static::class);
  }

  /**
   * Set the various Unilogin tokens (access_token, refresh_token, id_token).
   */
  public function setTokens(UniloginTokens $tokens): void {
    $this->tempStore->set('tokens', $tokens);
    $test = $this->getTokens();
    $dwhds = '';
  }

  /**
   * Get the various Unilogin tokens (access_token, refresh_token, id_token).
   */
  public function getTokens(): ?UniloginTokens {
    return $this->tempStore->get('tokens');
  }

}
