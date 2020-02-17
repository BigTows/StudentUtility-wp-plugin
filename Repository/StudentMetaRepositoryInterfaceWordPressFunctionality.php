<?php

namespace StudentUtility\Repository;

use StudentUtility\Repository\Meta\StudentMeta;

require_once 'StudentMetaRepositoryInterface.php';

/**
 * Implements of student meta repository based on wordpress functionality
 *
 * @package StudentUtility\Repository
 */
final class StudentMetaRepositoryInterfaceWordPressFunctionality implements StudentMetaRepositoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function getByUserId(int $userId): StudentMeta
    {
        return StudentMeta::builder($userId, $this->getSingleMetaOrNull($userId, self::NUMBER_OF_STUDENT_CARD));
    }

    /**
     * {@inheritDoc}
     */
    public function save(StudentMeta $studentMeta): void
    {
        if ($studentMeta->getNumberOfStudentCard() !== null) {
            $this->setOrUpdateMetaData($studentMeta->getUserId(), self::NUMBER_OF_STUDENT_CARD, $studentMeta->getNumberOfStudentCard());
        }
    }

    /**
     * Init or update meta value
     *
     * @param int    $userId    user id
     * @param string $metaName  name of meta
     * @param mixed  $metaValue value of meta
     */
    private function setOrUpdateMetaData(int $userId, $metaName, $metaValue): void
    {
        if ($this->getSingleMetaOrNull($userId, $metaName) === null) {
            add_user_meta($userId, $metaName, $metaValue);
        } else {
            update_user_meta($userId, $metaName, $metaValue);
        }
    }

    /**
     * Get only one meta value from storage
     *
     * @param int    $userId   user id
     * @param string $metaName meta name
     *
     * @return mixed|null
     */
    private function getSingleMetaOrNull(int $userId, string $metaName)
    {
        $result = get_user_meta($userId, $metaName);
        if (!is_array($result) || count($result) === 0) {
            return null;
        }
        return current($result);
    }
}