<?php

namespace App\Security
{
    use Symfony\Component\Security\Core\User\EquatableInterface;
    use Symfony\Component\Security\Core\User\UserInterface;

    class ApiUser
        implements UserInterface, EquatableInterface
    {
        public function __construct(
            ?string $username = null, ?string $password = null,
            ?string $salt = null, array $roles = [])
        {
            $this->username = $username;
            $this->password = $password;
            $this->salt = $salt;
            $this->roles = $roles;
        }

        /**
         * @return string|null
         */
        public function getUsername(): ?string
        {
            return $this->username;
        }

        /**
         * @param string|null $username
         */
        public function setUsername(?string $username): void
        {
            $this->username = $username;
        }

        /**
         * @return string|null
         */
        public function getPassword(): ?string
        {
            return $this->password;
        }

        /**
         * @param string|null $password
         */
        public function setPassword(?string $password): void
        {
            $this->password = $password;
        }

        /**
         * @return string|null
         */
        public function getSalt(): ?string
        {
            return $this->salt;
        }

        /**
         * @param string|null $salt
         */
        public function setSalt(?string $salt): void
        {
            $this->salt = $salt;
        }

        /**
         * @return array
         */
        public function getRoles(): array
        {
            return $this->roles;
        }

        /**
         * @param array $roles
         */
        public function setRoles(array $roles): void
        {
            $this->roles = $roles;
        }

        public function eraseCredentials()
        {
            $this->password = null;
        }

        public function isEqualTo(UserInterface $user)
        {
            return (($user instanceof self)
                && ($this->password === $user->getPassword())
                && ($this->salt === $user->getSalt())
                && ($this->username === $user->getUsername()));
        }

        //region --- Private members ---

        /** @var string|null */
        private $username;
        /** @var string|null */
        private $password;
        /** @var string|null */
        private $salt;
        /** @var array string[] */
        private $roles = [];

        //endregion
    }
}