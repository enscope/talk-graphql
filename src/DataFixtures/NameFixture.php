<?php

namespace App\DataFixtures
{
    use App\Entity\Name;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

    class NameFixture
        extends AbstractTSVSourceFixture
        implements OrderedFixtureInterface, FixtureGroupInterface
    {
        public function __construct(ParameterBagInterface $params)
        {
            parent::__construct($params, 'name.basics.tsv');
        }

        protected function processSingleRecord(ObjectManager $manager, array $record): bool
        {
            @list(
                $nconst, $primaryName, $birthYear, $deathYear, /* primary_profession */, /* knownForTitles */
                ) = $record;

            $name = new Name();
            $name->setId($nconst);
            $name->setPrimaryName($primaryName);
            $name->setBirthYear(self::intOrNull($birthYear));
            $name->setDeathYear(self::intOrNull($deathYear));

            // persist in database
            $manager->persist($name);

            return true;
        }

        public function getOrder()
        {
            return 0;
        }

        public static function getGroups(): array
        {
            return [
                'all', 'names',
            ];
        }
    }
}