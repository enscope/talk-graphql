<?php
namespace App\GraphQL\Mutation
{
    use App\Entity\Title;
    use App\Entity\WatchlistEntry;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\EntityRepository;
    use GraphQL\Error\UserError;
    use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;
    use Symfony\Component\Security\Core\Security;
    use Symfony\Component\Security\Core\User\UserInterface;

    class WatchlistMutation
        implements MutationInterface
    {
        public function __construct(EntityManagerInterface $em, Security $security)
        {
            $this->em = $em;
            $this->security = $security;
            $this->repo = $em->getRepository(WatchlistEntry::class);
        }

        public function addToWatchlist(string $idTitle): Title
        {
            $currentUser = $this->requireCurrentUser();
            $title = $this->em->find(Title::class, $idTitle);
            $entry = $this->repo->findOneBy(['username' => $currentUser->getUsername(), 'title' => $title]);

            if ($entry === null)
            {
                $entry = new WatchlistEntry($currentUser->getUsername(), $title);
                $this->em->persist($entry);
                $this->em->flush();
            }

            return $title;
        }

        public function removeFromWatchlist(string $idTitle): Title
        {
            $currentUser = $this->requireCurrentUser();
            $title = $this->em->find(Title::class, $idTitle);
            $entry = $this->repo->findOneBy(['username' => $currentUser->getUsername(), 'title' => $title]);

            if ($entry !== null)
            {
                $this->em->remove($entry);
                $this->em->flush();
            }

            return $title;
        }

        //region --- Private methods ---

        private function requireCurrentUser(): UserInterface
        {
            $currentUser = $this->security->getUser();
            if ($currentUser === null)
            {
                throw new UserError('Authorization required to perform this action.');
            }

            return $currentUser;
        }

        //endregion

        //region --- Private members ---

        /** @var EntityManagerInterface */
        private $em;
        /** @var EntityRepository */
        private $repo;
        /** @var Security */
        private $security;

        //endregion
    }
}