<?php


namespace StudentUtility\Repository\Meta\RecordBook;

require 'Semester.php';

final class AcademicYear
{

    /**
     * @var string
     */
    private $period;

    /**
     * @var Semester[]
     */
    private $semesterList;

    /**
     * AcademicYear constructor.
     *
     * @param string     $period
     * @param Semester[] $semesterList
     */
    public function __construct(string $period, array $semesterList)
    {
        $this->period = $period;
        $this->semesterList = $semesterList;
    }

    /**
     * @return string
     */
    public function getPeriod(): string
    {
        return $this->period;
    }

    /**
     * @return Semester[]
     */
    public function getSemesterList(): array
    {
        return $this->semesterList;
    }


    /**
     * @inheritDoc
     */
    public function serialize()
    {
        $data = [
            'period'       => $this->period,
            'semesterList' => []
        ];
        foreach ($this->semesterList as $value) {
            $data['semesterList'][] = $value->serialize();
        }
        return $data;
    }

    /**
     * @inheritDoc
     */
    public static function unserialize($serialized)
    {
        $period = $serialized['period'];
        $semesterList = [];

        foreach ($serialized['semesterList'] as $value) {
            $semesterList[] = Semester::unserialize($value);
        }
        return new self($period, $semesterList);
    }
}