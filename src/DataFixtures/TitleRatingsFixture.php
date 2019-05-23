<?php

namespace App\DataFixtures
{
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\ORM\Query;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

    class TitleRatingsFixture
        extends AbstractTSVSourceFixture
        implements OrderedFixtureInterface, FixtureGroupInterface
    {
        public function __construct(ParameterBagInterface $params)
        {
            parent::__construct($params, 'title.ratings.tsv', 50000);
        }

        protected function processSingleRecord(ObjectManager $manager, array $record): bool
        {
            @list($tconst, $averageRating, $numVotes) = $record;

            /** @var EntityManagerInterface $em */
            $em = $manager;

            if ($this->updateQuery === null)
            {
                // create new parametrized doctrine query
                /** @noinspection SqlDialectInspection */
                /** @noinspection SqlNoDataSourceInspection */
                $queryDql = 'update App:Title t set t.rating=?1, t.numVotes=?2 where t.id=?3';
                $this->updateQuery = $em->createQuery($queryDql);
            }

            // set parameters
            $this->updateQuery->setParameter(1, $averageRating);
            $this->updateQuery->setParameter(2, $numVotes);
            $this->updateQuery->setParameter(3, $tconst);

            // perform update
            $this->updateQuery->execute();

            return true;
        }

        public function getOrder()
        {
            return 12;
        }

        public static function getGroups(): array
        {
            return [
                'all', 'ratings',
            ];
        }

        //region --- Private members ---

        /** @var Query */
        private $updateQuery;

        //endregion
    }
}