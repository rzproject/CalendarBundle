<?php


namespace Rz\CalendarBundle\Entity;

use Rz\CalendarBundle\Model\Setting;


/**
 * Class BaseSetting
 * @package Rz\CalendarBundle\Entity
 */
abstract class BaseSetting extends Setting
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