<?php

namespace StudentUtility\Repository;

use StudentUtility\Repository\Meta\StudentMeta;
use StudentUtility\Repository\Meta\StudentRecordBook;
use Throwable;

require_once 'StudentMetaRepositoryInterface.php';

/**
 * Implements of student meta repository based on wordpress functionality
 *
 * @package StudentUtility\Repository
 */
final class StudentMetaRepositoryWordPressFunctionality implements StudentMetaRepositoryInterface
{

    /**
     * {@inheritDoc}
     */
    public function getByUserId(int $userId): StudentMeta
    {
        $studentMeta = StudentMeta::builder($userId, $this->getSingleMetaOrNull($userId, self::NUMBER_OF_STUDENT_CARD));
        $studentRecordBook = $this->tryGetStudentRecordBookByUserId($userId);
        if ($studentRecordBook !== null) {
            $studentMeta->setStudentRecordBook($studentRecordBook);
        }
        return $studentMeta;
    }

    /**
     * {@inheritDoc}
     */
    public function getStudentByStudentId(int $studentId): ?StudentMeta
    {
        $users = get_users(
            [
                'meta_key'    => self::NUMBER_OF_STUDENT_CARD,
                'meta_value'  => $studentId,
                'number'      => 1,
                'count_total' => false
            ]);
        if (count($users) === 1) {
            $user = current($users);
            return $this->getByUserId($user->ID);
        }

        return null;
    }

    /**
     * {@inheritDoc}
     */
    public function save(StudentMeta $studentMeta): void
    {
        if ($studentMeta->getNumberOfStudentCard() !== null) {
            $this->setOrUpdateMetaData($studentMeta->getUserId(), self::NUMBER_OF_STUDENT_CARD, $studentMeta->getNumberOfStudentCard());
        }
        if ($studentMeta->getStudentRecordBook() !== null) {
            $this->setOrUpdateMetaData($studentMeta->getUserId(), self::STUDENT_RECORD_BOOK, $studentMeta->getStudentRecordBook()->serialize());
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
     * Try get student record book
     *
     * @param int $userId
     *
     * @return StudentRecordBook|null
     */
    private function tryGetStudentRecordBookByUserId(int $userId): ?StudentRecordBook
    {
        try {
            $data = StudentRecordBook::unserialize($this->getSingleMetaOrNull($userId, self::STUDENT_RECORD_BOOK));
            if ($data instanceof StudentRecordBook) {
                return $data;
            }
            return null;
        } catch (Throwable $exception) {
            return null;
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