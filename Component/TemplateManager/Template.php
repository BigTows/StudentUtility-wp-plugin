<?php

namespace StudentUtility\Component\TemplateManager

final class Template
{
    /**
     * Path to file
     *
     * @var string
     */
    private string $pathToFile;

    public function __construct($pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }


    /**
     * Show template on page
     *
     * @param array $data
     */
    public function show($data = []): void
    {
        include $this->pathToFile;
    }
}