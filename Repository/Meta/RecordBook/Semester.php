<?php


namespace StudentUtility\Repository\Meta\RecordBook;

require 'Discipline.php';

/**
 * Semester
 *
 * @package StudentUtility\Repository\Meta\RecordBook
 */
final class Semester
{
    /**
     * @var int
     */
    private $number;

    /**
     * @var Discipline[]
     */
    private $disciplineList;

    /**
     * Semester constructor.
     *
     * @param int          $number
     * @param Discipline[] $disciplineList
     */
    public function __construct(int $number, array $disciplineList)
    {
        $this->number = $number;
        $this->disciplineList = $disciplineList;
    }


    /**
     * Get number of semester
     *
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * Get discipline list on this semester
     *
     * @return Discipline[]
     */
    public function getDisciplineList(): array
    {
        return $this->disciplineList;
    }


    /**
     * Serialize this object
     *
     * @return array
     */
    public function serialize(): array
    {
        $data = [
            'number'         => $this->number,
            'disciplineList' => []
        ];
        foreach ($this->disciplineList as $value) {
            $data['disciplineList'][] = $value->serialize();
        }
        return $data;
    }

    /**
     * Unserialize
     *
     * @param array $serialized
     *
     * @return Semester
     */
    public static function unserialize($serialized): Semester
    {
        $number = $serialized['number'];
        $disciplineList = [];
        foreach ($serialized['disciplineList'] as $value) {
            $disciplineList[] = Discipline::unserialize($value);
        }

        return new self($number, $disciplineList);
    }
}