<?php

namespace StudentUtility\Repository;

require_once 'meta/class-student-meta.php';


/**
 * Interface of student meta repository
 *
 * @see \StudentUtility\Repository\Meta\StudentMeta
 */
interface StudentMetaRepository
{

    public const NUMBER_OF_STUDENT_CARD = 'number_of_student_card';


    public function getByUserId(int $userId): StudentMeta;

    public function save(StudentMeta $student_Meta): void;


}