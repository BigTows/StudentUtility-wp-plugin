<?php


namespace StudentUtility;


use StudentUtility\Repository\StudentMetaRepositoryWordPressFunctionality;

/**
 * API of plugin
 *
 * @package StudentUtility
 */
final class API
{


    private static $instanceApi;

    private $repository;

    private function __construct()
    {
        $this->repository = new StudentMetaRepositoryWordPressFunctionality();
    }


    /**
     * @return StudentMetaRepositoryWordPressFunctionality
     */
    public function getRepository(): StudentMetaRepositoryWordPressFunctionality
    {
        return $this->repository;
    }


    public static function getApiInstance(): API
    {
        return self::initApi();
    }


    private static function initApi(): API
    {
        if (self::$instanceApi === null) {
            self::$instanceApi = new API();
        }
        return self::$instanceApi;
    }
}