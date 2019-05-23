<?php
namespace App\Entity
{
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\ORM\Mapping\Index;

    /**
     * Class TitleName
     *
     * @ORM\Entity()
     * @ORM\Table(indexes={
     *     @Index(name="idx_category", columns={"category"}),
     * })
     * @package App\Entity
     */
    class TitleName
    {
        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @param int $id
         */
        public function setId(int $id): void
        {
            $this->id = $id;
        }

        /**
         * @return Title
         */
        public function getTitle(): Title
        {
            return $this->title;
        }

        /**
         * @param Title $title
         */
        public function setTitle(Title $title): void
        {
            $this->title = $title;
        }

        /**
         * @return Name
         */
        public function getName(): Name
        {
            return $this->name;
        }

        /**
         * @param Name $name
         */
        public function setName(Name $name): void
        {
            $this->name = $name;
        }

        /**
         * @return int
         */
        public function getOrdering(): int
        {
            return $this->ordering;
        }

        /**
         * @param int $ordering
         */
        public function setOrdering(int $ordering): void
        {
            $this->ordering = $ordering;
        }

        /**
         * @return mixed
         */
        public function getCategory()
        {
            return $this->category;
        }

        /**
         * @param mixed $category
         */
        public function setCategory($category): void
        {
            $this->category = $category;
        }

        //region --- Private members ---

        /**
         * @ORM\Id()
         * @ORM\GeneratedValue(strategy="AUTO")
         * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=false)
         * @var int
         */
        private $id;

        /**
         * @ORM\ManyToOne(targetEntity="Title", inversedBy="names")
         * @var Title
         */
        private $title;

        /**
         * @ORM\ManyToOne(targetEntity="Name", inversedBy="titles")
         * @var Name
         */
        private $name;

        /**
         * @ORM\Column(type="smallint", options={"unsigned"=true}, nullable=false)
         * @var int
         */
        private $ordering;

        /**
         * @ORM\Column(type="string", length=48, nullable=false)
         * @var string
         */
        private $category;

        //endregion
    }
}