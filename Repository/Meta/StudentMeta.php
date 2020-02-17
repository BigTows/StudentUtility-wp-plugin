<?php


final class Student_Meta
{
    /**
     * @var int|null
     */
    private ?int $numberOfStudentCard;
    /**
     * @var int
     */
    private int $userId;


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


    public function setNumberOfStudentCard(int $numberOfStudentCard): void
    {
        $this->numberOfStudentCard = $numberOfStudentCard;
    }


    public static function builder(int $userId, ?int $numberOfStudentCard): \Student_Meta
    {
        return new Student_Meta($userId, $numberOfStudentCard);
    }
}