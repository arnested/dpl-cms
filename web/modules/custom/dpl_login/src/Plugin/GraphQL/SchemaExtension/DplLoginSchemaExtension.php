<?php

namespace Drupal\dpl_login\Plugin\GraphQL\SchemaExtension;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\graphql\GraphQL\ResolverBuilder;
use Drupal\graphql\GraphQL\ResolverRegistryInterface;
use Drupal\graphql_compose\Plugin\GraphQL\SchemaExtension\ResolverOnlySchemaExtensionPluginBase;

/**
 * @SchemaExtension(
 *   id = "mik",
 *   name = "Mik",
 *   description = @Translation("Misc schema extensions for GraphQL Compose."),
 *   schema = "graphql_compose",
 * )
 */
class DplLoginSchemaExtension extends ResolverOnlySchemaExtensionPluginBase implements ContainerFactoryPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function registerResolvers(ResolverRegistryInterface $registry) {

    $builder = new ResolverBuilder();

    // TODO: This is a hack. We \should not be using the service container directly.
    $library_token_handler = \Drupal::service('dpl_library_token.handler');
    $user_token_handler = \Drupal::service('dpl_login.user_tokens');
    $user_token = $user_token_handler->getCurrent();
    // TODO same here. We should not be using the service container directly.
    /* @var  \Drupal\Drupal\dpl_logi\n\UniloginTokensProvider $tokens */
    $unilogin_tokens_provider = \Drupal::service('dpl_login.unilogin_user_tokens');
    /* @var  \Drupal\Drupal\dpl_login\UniloginTokens $tokens */
    $tokens = $unilogin_tokens_provider->getTokens();

    $unilogin_tokens_are_valid = count(array_filter([
      $tokens->accessToken,
      $tokens->idToken,
      $tokens->refreshToken,
      $tokens->expire,
    ])) === 4;

    $values = [
      'adgangsplatformen' => [
        'library' => $library_token_handler->getToken(),
        'user' => $user_token ? $user_token->token : NULL,
      ],
    ];

    if ($unilogin_tokens_are_valid) {
      $values['unilogin'] = [
        'access_token' => $tokens->accessToken,
        'id_token' => $tokens->idToken,
        'refresh_token' => $tokens->refreshToken,
        'expires_in' => $tokens->expire,
      ];
    }

    $registry->addFieldResolver(
      type: 'Query',
      field: 'dplTokens',
      resolver: $builder->callback(fn() => $values)
    );
  }

}
