<?php


namespace StudentUtility\Repository\Meta;

require 'RecordBook/AcademicYear.php';

use StudentUtility\Repository\Meta\RecordBook\AcademicYear;

final class StudentRecordBook
{
    /**
     * @var AcademicYear[]
     */
    private $academicYear;

    /**
     * StudentRecordBook constructor.
     *
     * @param AcademicYear[] $academicYear
     */
    public function __construct(array $academicYear)
    {
        $this->academicYear = $academicYear;
    }

    /**
     * @return AcademicYear[]
     */
    public function getAcademicYear(): array
    {
        return $this->academicYear;
    }

    /**
     * @inheritDoc
     */
    public function serialize(): string
    {
        $data = ['academicYearList' => []];

        foreach ($this->academicYear as $value) {
            $data['academicYearList'][] = $value->serialize();
        }
        return json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE, 512);
    }

    /**
     * @inheritDoc
     */
    public static function unserialize($serialized): StudentRecordBook
    {
        $data = json_decode($serialized, true, 512, JSON_THROW_ON_ERROR);

        $academicYears = [];
        foreach ($data['academicYearList'] as $value) {
            $academicYears[] = AcademicYear::unserialize($value);
        }
        return new self($academicYears);
    }
}