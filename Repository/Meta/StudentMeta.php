<?php

namespace StudentUtility\Repository\Meta;

use http\Encoding\Stream;

require 'StudentRecordBook.php';

/**
 * Student Meta (entity)
 *
 * @package StudentUtility\Repository\Meta
 */
final class StudentMeta
{
    /**
     * User id in WordPress System
     *
     * @var int
     */
    private $userId;

    /**
     * Number of student card
     *
     * @var int|null
     */
    private $numberOfStudentCard;

    /**
     * Students middle name
     *
     * @var string|null
     */
    private $middleNameOfStudent;

    /**
     * @var ?StudentRecordBook
     */
    private $studentRecordBook;

    /**
     * StudentMeta constructor.
     *
     * @param int      $userId
     * @param int|null $numberOfStudentCard
     * @param string|null $middleNameOfStudent
     */
    private function __construct(int $userId, ?int $numberOfStudentCard, ?string $middleNameOfStudent)
    {
        $this->userId = $userId;
        $this->numberOfStudentCard = $numberOfStudentCard;
        $this->middleNameOfStudent = $middleNameOfStudent;
    }


    /**
     * Get user id of student
     *
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * Number of student card
     *
     * @return int|null
     */
    public function getNumberOfStudentCard(): ?int
    {
        return $this->numberOfStudentCard;
    }

    /**
     * Students middle name
     *
     * @return string|null
     */
    public function getMiddleNameOfStudent(): ?string
    {
        return $this->middleNameOfStudent;
    }

    /**
     * Set number of student card
     *
     * @param int $numberOfStudentCard
     */
    public function setNumberOfStudentCard(int $numberOfStudentCard): void
    {
        $this->numberOfStudentCard = $numberOfStudentCard;
    }

    /**
     * Set middle name of student
     *
     * @param string $middleNameOfStudent
     */
    public function setMiddleNameOfStudent(string $middleNameOfStudent): void
    {
        $this->middleNameOfStudent = $middleNameOfStudent;
    }

    public function setStudentRecordBook(StudentRecordBook $studentRecordBook): StudentMeta
    {
        $this->studentRecordBook = $studentRecordBook;
        return $this;
    }

    /**
     * @return StudentRecordBook
     */
    public function getStudentRecordBook(): ?StudentRecordBook
    {
        return $this->studentRecordBook;
    }

    /**
     * Builder
     *
     * @param int      $userId
     * @param int|null $numberOfStudentCard
     * @param string|null $middleNameOfStudent
     *
     * @return StudentMeta
     */
    public static function builder(int $userId, ?int $numberOfStudentCard, ?string $middleNameOfStudent): StudentMeta
    {
        return new StudentMeta($userId, $numberOfStudentCard, $middleNameOfStudent);
    }
}