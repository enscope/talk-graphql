<?php
namespace App\Entity
{
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\ORM\Mapping\Index;

    /**
     * Class WatchlistEntry
     *
     * @ORM\Entity()
     * @ORM\Table(indexes={
     *     @Index(name="idx_username", columns={"username"}),
     * })
     * @package App\Entity
     */
    class WatchlistEntry
    {
        public function __construct(?string $username = null, ?Title $title = null)
        {
            $this->setUsername($username);
            $this->setTitle($title);
        }

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
         * @return string
         */
        public function getUsername(): string
        {
            return $this->username;
        }

        /**
         * @param string $username
         */
        public function setUsername(string $username): void
        {
            $this->username = $username;
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
         * @ORM\ManyToOne(targetEntity="Title")
         * @var Title
         */
        private $title;

        /**
         * @ORM\Column(type="string", length=48, nullable=false)
         * @var string
         */
        private $username;

        //endregion
    }
}