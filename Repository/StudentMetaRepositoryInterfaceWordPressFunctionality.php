<?php
namespace StudentUtility\Repository;

use StudentUtility\Repository\Meta\StudentMeta;

require_once 'StudentMetaRepositoryInterface.php';

final class StudentMetaRepositoryInterfaceWordPressFunctionality implements StudentMetaRepositoryInterface
{

    public function getByUserId(int $userId): StudentMeta
    {
        return StudentMeta::builder($userId, $this->getSingleMetaOrNull($userId, self::NUMBER_OF_STUDENT_CARD));
    }


    public function save(StudentMeta $student_Meta): void
    {
        if ($student_Meta->getNumberOfStudentCard() !== null) {
            $this->setMeta($student_Meta->getUserId(), self::NUMBER_OF_STUDENT_CARD, $student_Meta->getNumberOfStudentCard());
        }
    }


    private function setMeta($userId, $metaName, $metaValue): void
    {
        if ($this->getSingleMetaOrNull($userId, $metaName) === null) {
            add_user_meta($userId, $metaName, $metaValue);
        } else {
            update_user_meta($userId, $metaName, $metaValue);
        }
    }

    private function getSingleMetaOrNull($userId, $metaName)
    {
        $result = get_user_meta($userId, $metaName);
        if (!is_array($result) || count($result) === 0) {
            return null;
        }
        return current($result);
    }
}