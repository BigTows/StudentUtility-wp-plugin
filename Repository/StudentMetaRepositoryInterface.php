<?php

namespace StudentUtility\Repository;

use StudentUtility\Repository\Meta\StudentMeta;

require_once 'Meta/StudentMeta.php';


/**
 * Interface of student meta repository
 *
 * @see \StudentUtility\Repository\Meta\StudentMeta
 */
interface StudentMetaRepositoryInterface
{
    /**
     * Key of meta for number of student card
     */
    public const NUMBER_OF_STUDENT_CARD = 'number_of_student_card';

    /**
     * Key of meta for student record book
     */
    public const STUDENT_RECORD_BOOK = 'student_record_book';

    /**
     * Get Student meta by user id
     *
     * @param int $userId based on wordpress system
     *
     * @return StudentMeta
     */
    public function getByUserId(int $userId): StudentMeta;

    /**
     * Get student meta by student id
     *
     * @param int $studentId student id
     *
     * @return StudentMeta|null
     */
    public function getStudentByStudentId(int $studentId): ?StudentMeta;

    /**
     * Save student meta data
     *
     * @param StudentMeta $studentMeta instance for saving
     */
    public function save(StudentMeta $studentMeta): void;

}