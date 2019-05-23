<?php

namespace App\DataFixtures
{
    use App\Entity\Genre;
    use App\Entity\Title;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

    class TitleFixture
        extends AbstractTSVSourceFixture
        implements OrderedFixtureInterface, FixtureGroupInterface
    {
        public function __construct(ParameterBagInterface $params)
        {
            parent::__construct($params, 'title.basics.tsv');
        }

        protected function processSingleRecord(ObjectManager $manager, array $record): bool
        {
            @list(
                $id, $type, $primaryTitle, $originalTitle,
                $isAdult,
                $startYear, /* endYear */,
                $runtimeMinutes,
                $genres
                ) = $record;

            $title = new Title();
            $title->setId($id);
            $title->setType($type);
            $title->setPrimaryTitle(mb_substr($primaryTitle, 0, 255));
            $title->setOriginalTitle(mb_substr($originalTitle, 0, 255));
            $title->setAdult($isAdult === '1');
            $title->setReleaseYear(self::intOrNull($startYear));
            $title->setRuntimeMinutes(self::intOrNull($runtimeMinutes));

            // add title to genres
            foreach (explode(',', $genres) as $genreName)
            {
                $genreCode = strtolower($genreName);
                if (!array_key_exists($genreCode, $this->genres))
                {
                    // fill genre instance
                    $newGenre = new Genre();
                    $newGenre->setCode($genreCode);
                    $newGenre->setName($genreName);

                    // persist in database
                    $manager->persist($newGenre);

                    // store in internal lookup table
                    $this->genres[$genreCode] = $newGenre;
                }

                // add genre to title
                $title->addGenre($this->genres[$genreCode]);
            }

            // persist in database
            $manager->persist($title);

            return true;
        }

        protected function getObjectNamesToClear(): ?array
        {
            return [
                Title::class,
            ];
        }

        public function getOrder()
        {
            return 10;
        }

        public static function getGroups(): array
        {
            return [
                'all', 'titles',
            ];
        }

        //region --- Private members ---

        /** @var Genre[] */
        private $genres = [];

        //endregion
    }
}