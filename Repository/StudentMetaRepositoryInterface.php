<?php

namespace StudentUtility\Repository;

use StudentUtility\Repository\Meta\StudentMeta;

require_once 'meta/StudentMeta.php';


/**
 * Interface of student meta repository
 *
 * @see \StudentUtility\Repository\Meta\StudentMeta
 */
interface StudentMetaRepositoryInterface
{

    public const NUMBER_OF_STUDENT_CARD = 'number_of_student_card';


    public function getByUserId(int $userId): StudentMeta;

    public function save(StudentMeta $student_Meta): void;


}