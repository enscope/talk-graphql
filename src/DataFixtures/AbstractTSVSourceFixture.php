<?php
namespace App\DataFixtures
{
    use Doctrine\Bundle\FixturesBundle\Fixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Doctrine\ORM\EntityManagerInterface;
    use Exception;
    use Symfony\Component\Console\Helper\ProgressBar;
    use Symfony\Component\Console\Output\ConsoleOutput;
    use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

    abstract class AbstractTSVSourceFixture
        extends Fixture
    {
        public function __construct(ParameterBagInterface $params, $fileName, $batchSize = 1000, $recordLimit = null)
        {
            $this->params = $params;
            $this->fileName = $fileName;
            $this->batchSize = $batchSize;
            $this->recordLimit = $recordLimit;
        }

        /**
         * @param ObjectManager $manager
         *
         * @throws Exception
         */
        public function load(ObjectManager $manager)
        {
            /** @var EntityManagerInterface $em */
            $em = $manager;
            // disable sql logger
            $em->getConnection()->getConfiguration()->setSQLLogger(null);

            $projectDirectory = $this->params->get('kernel.project_dir');
            $tsvFileName = "{$projectDirectory}/seed-source/{$this->fileName}";


            @$fh = fopen($tsvFileName, 'r');
            if (!$fh)
            {
                throw new Exception("Unable to open data source file expected at: {$tsvFileName}");
            }

            // get file size for progress display
            $tsvFileSize = filesize($tsvFileName);

            // skip header row
            fgets($fh, 2048);

            $lineNumber = 1;

            $output = new ConsoleOutput();
            $progressBar = new ProgressBar($output, $tsvFileSize);
            /** @noinspection PhpParamsInspection */
            $progressBar->setFormat("{$this->fileName} %current%/%max% [%bar%] %percent:3s%% (%remaining% remaining) [mem: %memory:6s%]\n");

            while (!feof($fh))
            {
                $record = fgetcsv($fh, 2048, "\t");
                $lineNumber++;

                if (is_array($record))
                {
                    if (!$this->processSingleRecord($manager, $record))
                    {
                        continue;
                    }
                }

                if (($lineNumber % 100) === 0)
                {
                    // advance progress bar
                    $currentPosition = ftell($fh);
                    /** @noinspection PhpParamsInspection */
                    $progressBar->setProgress($currentPosition);
                }

                if (($lineNumber % $this->batchSize) === 0)
                {
                    $manager->flush();
                    self::clearFromManager($manager, $this->getObjectNamesToClear());
                }

                if ($this->recordLimit
                    && ($lineNumber > $this->recordLimit))
                {
                    break;
                }
            }

            // flush & clear the rest
            $manager->flush();
            self::clearFromManager($manager, $this->getObjectNamesToClear());

            // advance to 100%
            /** @noinspection PhpParamsInspection */
            $progressBar->setProgress($tsvFileSize);

            fclose($fh);
        }

        abstract protected function processSingleRecord(ObjectManager $manager, array $record): bool;

        protected function getObjectNamesToClear(): ?array
        {
            return null;
        }

        protected static function clearFromManager(ObjectManager $manager, ?array $objectNames): void
        {
            if (!is_array($objectNames))
            {
                $manager->clear();
                return;
            }

            foreach ($objectNames as $objectName)
            {
                $manager->clear($objectName);
            }
        }

        protected static function intOrNull($value): ?int
        {
            if ($value === '\N')
            {
                return null;
            }

            return intval($value);
        }

        //region --- Private members ---

        /** @var ParameterBagInterface */
        private $params;
        /** @var string */
        private $fileName;
        /** @var int */
        private $batchSize = 10000;
        /** @var int|null */
        private $recordLimit = null;

        //endregion
    }
}