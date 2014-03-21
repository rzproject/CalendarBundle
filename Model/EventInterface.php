<?php

namespace Rz\CalendarBundle\Model;


interface EventInterface
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
     * @param mixed $description
     */
    public function setDescription($description);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param mixed $end
     */
    public function setEnd($end);

    /**
     * @return mixed
     */
    public function getEnd();

    /**
     * @param mixed $start
     */
    public function setStart($start);

    /**
     * @return mixed
     */
    public function getStart();

    /**
     * @param mixed $title
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt);

    /**
     * @return mixed
     */
    public function getUpdatedAt();
}