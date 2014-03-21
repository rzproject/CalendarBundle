<?php

namespace Rz\CalendarBundle\Model;


interface CategoryInterface
{
    /**
     * @param mixed $color
     */
    public function setColor($color);

    /**
     * @return mixed
     */
    public function getColor();

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param mixed $name
     */
    public function setName($name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

}