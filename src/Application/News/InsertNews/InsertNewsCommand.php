<?php
/**
 * Created by PhpStorm.
 * User: programador
 * Date: 30/05/18
 * Time: 9:39
 */

namespace App\Application\News\InsertNews;

use Assert\Assertion;

class InsertNewsCommand
{
    private $title;
    private $image;
    private $content;

    /**
     * InsertNewsCommand constructor.
     *
     * @param string $title
     * @param string $image
     * @param string $content
     *
     * @throws \Assert\AssertionFailedException
     */
    public function __construct(
        string $title,
        string $content
    ) {
        Assertion::notBlank($title);
        Assertion::string($title);
        Assertion::notBlank($content);
        Assertion::string($content);

        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Get Title
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


    /**
     * Get Content
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }


}
