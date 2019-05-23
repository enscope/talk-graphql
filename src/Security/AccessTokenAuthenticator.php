<?php
namespace App\Security
{
    use GraphQL\Error\UserError;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
    use Symfony\Component\Security\Core\Exception\AuthenticationException;
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\UserProviderInterface;
    use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

    class AccessTokenAuthenticator
        extends AbstractGuardAuthenticator
    {
        const AuthorizationHeader = 'Authorization';

        public function supports(Request $request)
        {
            return $request->headers->has(self::AuthorizationHeader);
        }

        public function getCredentials(Request $request)
        {
            $headerValue = $request->headers->get(self::AuthorizationHeader);
            list($tokenType, $accessToken) = explode(' ', $headerValue);

            return [
                'tokenType' => $tokenType,
                'accessToken' => $accessToken,
            ];
        }

        public function getUser($credentials, UserProviderInterface $userProvider)
        {
            $accessToken = $credentials['accessToken'];
            if ($accessToken === null)
            {
                return null;
            }

            return $userProvider->loadUserByUsername($accessToken);
        }

        public function checkCredentials($credentials, UserInterface $user)
        {
            return true;
        }

        public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
        {
            throw new UserError('Authentication failure.');
        }

        public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
        {
            return null;
        }

        public function start(Request $request, AuthenticationException $authException = null)
        {
            return null;
        }

        public function supportsRememberMe()
        {
            return false;
        }

    }
}