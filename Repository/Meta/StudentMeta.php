<?php

namespace StudentUtility\Repository\Meta;

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


    private function __construct(int $userId, ?int $numberOfStudentCard)
    {
        $this->userId = $userId;
        $this->numberOfStudentCard = $numberOfStudentCard;
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
     * Set number of student card
     *
     * @param int $numberOfStudentCard
     */
    public function setNumberOfStudentCard(int $numberOfStudentCard): void
    {
        $this->numberOfStudentCard = $numberOfStudentCard;
    }

    /**
     * Builder
     *
     * @param int      $userId
     * @param int|null $numberOfStudentCard
     *
     * @return StudentMeta
     */
    public static function builder(int $userId, ?int $numberOfStudentCard): StudentMeta
    {
        return new StudentMeta($userId, $numberOfStudentCard);
    }
}