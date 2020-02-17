<?php

namespace StudentUtility\Action;

use StudentUtility\Component\TemplateManager\TemplateManager;
use StudentUtility\Repository\StudentMetaRepositoryInterface;

final class StudentFormActions
{

    /**
     * Instance of student meta repository
     *
     * @var StudentMetaRepositoryInterface
     */
    private $repository;

    public function __construct(StudentMetaRepositoryInterface $repository)
    {

        $this->repository = $repository;
    }


    /**
     * @uses edit_admin_registration_form
     * @uses update_student_meta
     * @uses crf_show_extra_profile_fields
     */
    public function init_actions(): void
    {
        add_action('user_new_form', [$this, 'edit_admin_registration_form']);
        add_action('edit_user_created_user', [$this, 'update_student_meta']);
        add_action('show_user_profile', [$this, 'crf_show_extra_profile_fields']);
        add_action('edit_user_profile', [$this, 'crf_show_extra_profile_fields']);
    }

    /**
     * @param $operation
     */
    public function edit_admin_registration_form($operation): void
    {
        if ('add-new-user' === $operation) {
            TemplateManager::load(TemplateManager::STUDENT_FORM_TEMPLATE)->show();
        }
    }


    public function update_student_meta($user_id): void
    {
        if (!empty($_POST['numberOfStudentCard'])) {
            $meta = $this->repository->getByUserId($user_id);
            $meta->setNumberOfStudentCard((int)$_POST['numberOfStudentCard']);
            $this->repository->save($meta);
        }
    }

    public function crf_show_extra_profile_fields($user): void
    {
        $meta = $this->repository->getByUserId($user->ID);
        TemplateManager::load(TemplateManager::STUDENT_FORM_VIEW_TEMPLATE)->show([
            'numberOfStudentCard' => $meta->getNumberOfStudentCard()
        ]);
    }

}