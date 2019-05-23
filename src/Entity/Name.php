<?php
namespace App\Entity
{
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\ORM\Mapping\Index;

    /**
     * Class Name
     *
     * @ORM\Entity(repositoryClass="App\Repository\NameRepository")
     * @ORM\Table(indexes={
     *     @Index(name="idx_primaryName", columns={"primary_name"}),
     *     @Index(name="idx_birthYear", columns={"birth_year"}),
     *     @Index(name="idx_deathYear", columns={"death_year"}),
     * })
     * @package App\Entity
     */
    class Name
    {
        /**
         * Name constructor.
         */
        public function __construct()
        {
            $this->titles = new ArrayCollection();
        }

        /**
         * @return string
         */
        public function getId(): string
        {
            return $this->id;
        }

        /**
         * @param string $id
         */
        public function setId(string $id): void
        {
            $this->id = $id;
        }

        /**
         * @return string
         */
        public function getPrimaryName(): string
        {
            return $this->primaryName;
        }

        /**
         * @param string $primaryName
         */
        public function setPrimaryName(string $primaryName): void
        {
            $this->primaryName = $primaryName;
        }

        /**
         * @return int|null
         */
        public function getBirthYear(): ?int
        {
            return $this->birthYear;
        }

        /**
         * @param int|null $birthYear
         */
        public function setBirthYear(?int $birthYear): void
        {
            $this->birthYear = $birthYear;
        }

        /**
         * @return int|null
         */
        public function getDeathYear(): ?int
        {
            return $this->deathYear;
        }

        /**
         * @param int|null $deathYear
         */
        public function setDeathYear(?int $deathYear): void
        {
            $this->deathYear = $deathYear;
        }

        /**
         * @return TitleName[]|ArrayCollection
         */
        public function getTitles()
        {
            return $this->titles;
        }

        /**
         * @param TitleName[] $titles
         */
        public function setTitles(array $titles): void
        {
            $this->titles = $titles;
        }

        //region --- Private members ---

        /**
         * @ORM\Id()
         * @ORM\Column(type="string", length=12, nullable=false)
         * @var string
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=128, nullable=false)
         * @var string
         */
        private $primaryName;

        /**
         * @ORM\Column(type="smallint", options={"unsigned"=true}, nullable=true)
         * @var int|null
         */
        private $birthYear;

        /**
         * @ORM\Column(type="smallint", options={"unsigned"=true}, nullable=true)
         * @var int|null
         */
        private $deathYear;

        /**
         * @ORM\OneToMany(targetEntity="TitleName", mappedBy="name")
         * @var TitleName[]
         */
        private $titles;

        //endregion
    }
}