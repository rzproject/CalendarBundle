<?php

namespace Rz\CalendarBundle\Model;


interface SettingInterface
{
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

    /**
     * @param mixed $value
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();
}