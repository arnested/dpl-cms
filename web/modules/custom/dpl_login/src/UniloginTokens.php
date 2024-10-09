<?php

namespace Drupal\dpl_login;

/**
 * Access Token.
 */
class UniloginTokens {
  /**
   * The access token.
   *
   * @var string
   */
  public string $accessToken;
  /**
   * The id token.
   *
   * @var string
   */
  public string $idToken;
  /**
   * The refresh token.
   *
   * @var string
   */
  public string $refreshToken;
  /**
   * Token expiration timestamp.
   *
   * @var int
   */
  public int $expire;

  /**
   * Named constructor that create an Access Token object.
   *
   * From the data of the openid connect context.
   *
   * @param mixed[] $context
   *   The openid connect context.
   *
   * @return AccessToken
   *   Token object created based on a json formed response.
   */
  public static function createFromOpenidConnectContext(array $context): self {
    // @todo Validate context.
    $tokens = new static();
    $tokens->accessToken = $context['tokens']['access_token'];
    $tokens->idToken = $context['tokens']['id_token'];
    $tokens->refreshToken = $context['tokens']['refresh_token'];
    $tokens->expire = $context['tokens']['expire'];

    return $tokens;
  }

}
