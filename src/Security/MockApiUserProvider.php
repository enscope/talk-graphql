<?php

namespace App\Security
{
    use Symfony\Component\Security\Core\User\UserInterface;
    use Symfony\Component\Security\Core\User\UserProviderInterface;

    class MockApiUserProvider
        implements UserProviderInterface
    {
        public function loadUserByUsername($accessToken)
        {
            return $this->createMockUser();
        }

        public function refreshUser(UserInterface $user)
        {
            return $this->createMockUser();
        }

        public function supportsClass($class)
        {
            return (ApiUser::class === $class);
        }

        private function createMockUser(): ApiUser
        {
            return new ApiUser(
                'donald', 'donald',
                'MANY Salt. Ketchup! WIN!',
                ['ROLE_USER']);
        }
    }
}