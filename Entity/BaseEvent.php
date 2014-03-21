<?php


namespace Rz\CalendarBundle\Entity;

use Rz\CalendarBundle\Model\Event;


/**
 * Class BaseEvent
 * @package Rz\CalendarBundle\Entity
 */
abstract class BaseEvent extends Event
{
    /**
     *
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime;
        $this->updatedAt = new \DateTime;
    }

    /**
     *
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime;
    }
}