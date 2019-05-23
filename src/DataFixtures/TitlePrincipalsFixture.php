<?php

namespace App\DataFixtures
{
    use App\Entity\Name;
    use App\Entity\Title;
    use App\Entity\TitleName;
    use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
    use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\ORM\EntityManagerInterface;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

    class TitlePrincipalsFixture
        extends AbstractTSVSourceFixture
        implements OrderedFixtureInterface, FixtureGroupInterface
    {
        public function __construct(ParameterBagInterface $params)
        {
            parent::__construct($params, 'title.principals.tsv', 50000);
        }

        protected function processSingleRecord(ObjectManager $manager, array $record): bool
        {
            @list($tconst, $ordering, $nconst, $category, /* job */, /* characters */) = $record;

            /** @var EntityManagerInterface $em */
            $em = $manager;

            // create partial references to avoid lookups
            /** @var Title $titleRef */
            $title = $em->find(Title::class, $tconst);
            /** @var Name $nameRef */
            $name = $em->find(Name::class, $nconst);

            if (!$title
                || !$name)
            {
                // if not found, ignore...
                return false;
            }

            // create title-name binding with additional data
            $tn = new TitleName();
            $tn->setTitle($title);
            $tn->setName($name);
            $tn->setOrdering($ordering);
            $tn->setCategory($category);

            // persist in database
            $manager->persist($tn);

            return true;
        }

        public function getOrder()
        {
            return 11;
        }

        public static function getGroups(): array
        {
            return [
                'all', 'principals',
            ];
        }
    }
}