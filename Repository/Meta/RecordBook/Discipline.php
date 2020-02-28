<?php


namespace StudentUtility\Repository\Meta\RecordBook;


use DateTimeImmutable;
use DateTimeInterface;

/**
 * Discipline on semester
 *
 * @package StudentUtility\Repository\Meta\RecordBook
 */
final class Discipline
{
    /**
     * Name of discipline
     *
     * @var string
     */
    private $name;

    /**
     * Type of exam
     *
     * @var string
     */
    private $typeExam;

    /**
     * Hours for this discipline per year
     *
     * @var int
     */
    private $hoursPerYear;

    /**
     * Rating getting on this discipline
     *
     * @var string
     */
    private $rating;

    /**
     * @var DateTimeInterface
     */
    private $resultDate;

    /**
     * @var string
     */
    private $teacher;

    /**
     * Discipline constructor.
     *
     * @param string $name
     * @param string $type
     * @param int    $hoursPerYear
     */
    public function __construct(string $name, string $type, int $hoursPerYear)
    {
        $this->name = $name;
        $this->typeExam = $type;
        $this->hoursPerYear = $hoursPerYear;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getTypeExam(): string
    {
        return $this->typeExam;
    }

    /**
     * @return int
     */
    public function getHoursPerYear(): int
    {
        return $this->hoursPerYear;
    }

    /**
     * @return string
     */
    public function getRating(): ?string
    {
        return $this->rating;
    }

    /**
     * @return DateTimeInterface
     */
    public function getResultDate(): ?DateTimeInterface
    {
        return $this->resultDate;
    }

    /**
     * @return string
     */
    public function getTeacher(): ?string
    {
        return $this->teacher;
    }

    /**
     * @param string $name
     *
     * @return Discipline
     */
    public function setName(string $name): Discipline
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $typeExam
     *
     * @return Discipline
     */
    public function setTypeExam(string $typeExam): Discipline
    {
        $this->typeExam = $typeExam;
        return $this;
    }

    /**
     * @param int $hoursPerYear
     *
     * @return Discipline
     */
    public function setHoursPerYear(int $hoursPerYear): Discipline
    {
        $this->hoursPerYear = $hoursPerYear;
        return $this;
    }

    /**
     * @param string $rating
     *
     * @return Discipline
     */
    public function setRating(string $rating): Discipline
    {
        $this->rating = $rating;
        return $this;
    }

    /**
     * @param DateTimeInterface $resultDate
     *
     * @return Discipline
     */
    public function setResultDate(DateTimeInterface $resultDate): Discipline
    {
        $this->resultDate = $resultDate;
        return $this;
    }

    /**
     * @param string $teacher
     *
     * @return Discipline
     */
    public function setTeacher(string $teacher): Discipline
    {
        $this->teacher = $teacher;
        return $this;
    }


    /**
     * @inheritDoc
     */
    public function serialize(): array
    {
        return [
            'name'         => $this->name,
            'type'         => $this->typeExam,
            'hoursPerYear' => $this->hoursPerYear,
            'rating'       => $this->rating,
            'resultDate'   => $this->resultDate === null ? null : $this->resultDate->format('Y-m-d'),
            'teacher'      => $this->teacher
        ];
    }

    /**
     * @inheritDoc
     */
    public static function unserialize($serialized): Discipline
    {
        $name = $serialized['name'];
        $type = $serialized['type'];
        $hoursPerYear = $serialized['hoursPerYear'];
        $self = new self($name, $type, $hoursPerYear);
        $self->resultDate = empty($serialized['resultDate']) ? null : DateTimeImmutable::createFromFormat('Y-m-d', $serialized['resultDate']);
        $self->teacher = $serialized['teacher'];
        $self->rating = $serialized['rating'];
        return $self;
    }
}