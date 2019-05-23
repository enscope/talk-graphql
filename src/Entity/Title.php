<?php

namespace App\Entity
{
    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\ORM\Mapping as ORM;
    use Doctrine\ORM\Mapping\Index;
    use Doctrine\ORM\Mapping\JoinTable;

    /**
     * Class Title
     *
     * @ORM\Entity(repositoryClass="App\Repository\TitleRepository")
     * @ORM\Table(indexes={
     *     @Index(name="idx_type", columns={"type"}),
     *     @Index(name="idx_adult", columns={"adult"}),
     *     @Index(name="idx_primaryTitle", columns={"primary_title"}),
     *     @Index(name="idx_releaseYear", columns={"release_year"}),
     *     @Index(name="idx_rating", columns={"rating"}),
     * })
     * @package App\Entity
     */
    class Title
    {
        /**
         * Title constructor.
         */
        public function __construct()
        {
            $this->genres = new ArrayCollection();
            $this->names = new ArrayCollection();
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
        public function getType(): string
        {
            return $this->type;
        }

        /**
         * @param string $type
         */
        public function setType(string $type): void
        {
            $this->type = $type;
        }

        /**
         * @return string
         */
        public function getPrimaryTitle(): string
        {
            return $this->primaryTitle;
        }

        /**
         * @param string $primaryTitle
         */
        public function setPrimaryTitle(string $primaryTitle): void
        {
            $this->primaryTitle = $primaryTitle;
        }

        /**
         * @return string
         */
        public function getOriginalTitle(): string
        {
            return $this->originalTitle;
        }

        /**
         * @param string $originalTitle
         */
        public function setOriginalTitle(string $originalTitle): void
        {
            $this->originalTitle = $originalTitle;
        }

        /**
         * @return bool
         */
        public function isAdult(): bool
        {
            return $this->adult;
        }

        /**
         * @param bool $adult
         */
        public function setAdult(bool $adult): void
        {
            $this->adult = $adult;
        }

        /**
         * @return int|null
         */
        public function getReleaseYear(): ?int
        {
            return $this->releaseYear;
        }

        /**
         * @param int|null $releaseYear
         */
        public function setReleaseYear(?int $releaseYear): void
        {
            $this->releaseYear = $releaseYear;
        }

        /**
         * @return int|null
         */
        public function getRuntimeMinutes(): ?int
        {
            return $this->runtimeMinutes;
        }

        /**
         * @param int|null $runtimeMinutes
         */
        public function setRuntimeMinutes(?int $runtimeMinutes): void
        {
            $this->runtimeMinutes = $runtimeMinutes;
        }

        /**
         * @return float|null
         */
        public function getRating(): ?float
        {
            return $this->rating;
        }

        /**
         * @param float|null $rating
         */
        public function setRating(?float $rating): void
        {
            $this->rating = $rating;
        }

        /**
         * @return int|null
         */
        public function getNumVotes(): ?int
        {
            return $this->numVotes;
        }

        /**
         * @param int|null $numVotes
         */
        public function setNumVotes(?int $numVotes): void
        {
            $this->numVotes = $numVotes;
        }

        /**
         * @return Genre[]|ArrayCollection
         */
        public function getGenres(): array
        {
            return $this->genres;
        }

        /**
         * @param Genre[] $genres
         */
        public function setGenres(array $genres): void
        {
            $this->genres = $genres;
        }

        public function addGenre(Genre $genre): void
        {
            $this->genres->add($genre);
        }

        /**
         * @return TitleName[]|ArrayCollection
         */
        public function getNames()
        {
            return $this->names;
        }

        /**
         * @param TitleName[] $names
         */
        public function setNames(array $names): void
        {
            $this->names = $names;
        }

        //region --- Entity mapping ---

        /**
         * @ORM\Id()
         * @ORM\Column(type="string", length=12, nullable=false)
         * @var string
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=32, nullable=false)
         * @var string
         */
        private $type;

        /**
         * @ORM\Column(type="string", length=255, nullable=false)
         * @var string
         */
        private $primaryTitle;

        /**
         * @ORM\Column(type="string", length=255, nullable=false)
         * @var string
         */
        private $originalTitle;

        /**
         * @ORM\Column(type="boolean", nullable=false)
         * @var boolean
         */
        private $adult = false;

        /**
         * @ORM\Column(type="smallint", options={"unsigned"=true}, nullable=true)
         * @var int|null
         */
        private $releaseYear;

        /**
         * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
         * @var int|null
         */
        private $runtimeMinutes;

        /**
         * @ORM\Column(type="decimal", precision=3, scale=1, options={"unsigned"=true}, nullable=true)
         * @var float|null
         */
        private $rating;

        /**
         * @ORM\Column(type="integer", options={"unsigned"=true}, nullable=true)
         * @var int|null
         */
        private $numVotes;

        /**
         * @ORM\ManyToMany(targetEntity="Genre", inversedBy="titles")
         * @JoinTable(name="title_genre",
         *     joinColumns={@ORM\JoinColumn(fieldName="id_title", referencedColumnName="id")},
         *     inverseJoinColumns={@ORM\JoinColumn(fieldName="genre_code", referencedColumnName="code")})
         * @var Genre[]
         */
        private $genres;

        /**
         * @ORM\OneToMany(targetEntity="TitleName", mappedBy="title")
         * @var TitleName[]
         */
        private $names;

        //endregion
    }
}