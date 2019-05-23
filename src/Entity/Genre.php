<?php
namespace App\Entity
{
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * Class Genre
     *
     * @ORM\Entity()
     * @package App\Entity
     */
    class Genre
    {
        /**
         * Genre constructor.
         */
        public function __construct()
        {
            $this->titles = new ArrayCollection();
        }

        /**
         * @return string
         */
        public function getCode(): string
        {
            return $this->code;
        }

        /**
         * @param string $code
         */
        public function setCode(string $code): void
        {
            $this->code = $code;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @param string $name
         */
        public function setName(string $name): void
        {
            $this->name = $name;
        }

        /**
         * @return Title[]|ArrayCollection
         */
        public function getTitles(): array
        {
            return $this->titles;
        }

        /**
         * @param Title[] $titles
         */
        public function setTitles(array $titles): void
        {
            $this->titles = $titles;
        }

        //region --- Private members ---

        /**
         * @ORM\Id()
         * @ORM\Column(type="string", length=16, nullable=false)
         * @var string
         */
        private $code;

        /**
         * @ORM\Column(type="string", length=32, nullable=false)
         * @var string
         */
        private $name;

        /**
         * @ORM\ManyToMany(targetEntity="Title", mappedBy="genres")
         * @var Title[]
         */
        private $titles;

        //endregion
    }
}