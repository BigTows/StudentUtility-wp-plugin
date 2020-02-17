<?php
namespace StudentUtility\Component\TemplateManager;

use RuntimeException;

require 'Template.php';

/**
 * Manager of template
 */
final class TemplateManager
{
    private const PATH_TO_TEMPLATE = 'template/';
    public const STUDENT_FORM_TEMPLATE = 'studentFormTemplate';
    public const STUDENT_FORM_VIEW_TEMPLATE = 'studentFormViewTemplate';
    public const STUDENT_FORM_EDIT_TEMPLATE = 'studentFormEditTemplate';

    private static $mapOfTemplate = [
        self::STUDENT_FORM_TEMPLATE      => 'form-student-add-new-user.phtml',
        self::STUDENT_FORM_VIEW_TEMPLATE => 'form-student-view-user.phtml',
        self::STUDENT_FORM_EDIT_TEMPLATE => 'form-student-edit-user.phtml'
    ];

    /**
     * @param $nameOfTemplate
     *
     * @return Template
     */
    public static function load($nameOfTemplate): Template
    {
        if (!isset(static::$mapOfTemplate[$nameOfTemplate])) {
            throw new RuntimeException("Can't find template with name: {$nameOfTemplate}");
        }

        return new Template(self::PATH_TO_TEMPLATE . static::$mapOfTemplate[$nameOfTemplate]);
    }
}