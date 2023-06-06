<?php
include('../helpers/classes/config.php');
  //declare(strict_types=1);
  require('../auth/vendor/autoload.php');

  use Auth0\SDK\Auth0;
  use Auth0\SDK\Configuration\SdkConfiguration;

  $configuration = new SdkConfiguration(
    domain: 'dev-b898rwcc.us.auth0.com',
    clientId: 'SH1zm0MK15kLFd9YLnm5EGTAmsWulxft',
    clientSecret: 'AhKiHHZyG9JaoYNYom5ZVrq6YNQOO3OgKhBHa-Qb1J5Zs2IXW3VCASvxfXpnn5Hh',
    redirectUri: 'http://miro.stageservices.xyz/callback.php', 
    cookieSecret: '4f60eb5de6b5904ad4b8e31d9193e7ea4a3013b476ddb5c259ee9077c05e1457'
  );

  $sdk = new Auth0($configuration);
  /**
   * Prepare application session and redirect to the Auth0 Universal Login page.
   *
   * The user will be redirected to your callback route to complete the authentication flow.
   */

  header(sprintf('Location: %s', $sdk->login()));