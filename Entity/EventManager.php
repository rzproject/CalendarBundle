<?php


namespace Rz\CalendarBundle\Entity;

use Sonata\CoreBundle\Model\BaseEntityManager;

class EventManager extends BaseEntityManager
{

    public function findAll() {
        $query = $this->em->createQuery("SELECT e
                                         FROM $this->class e
                                         ORDER BY e.start ASC, e.end ASC");
        return $query->getResult();
    }

    public function findNext() {
        $query = $this->em->createQuery("SELECT e
                                         FROM $this->class e
                                         WHERE e.end >= :now
                                         ORDER BY e.start ASC, e.end ASC")
                           ->setParameter(':now', new \DateTime);
        return $query->getResult();
    }

    public function findBetween(\DateTime $start, \DateTime $end) {
        $query = $this->em->createQuery("SELECT e
                                         FROM $this->class e
                                         WHERE e.start >= :start
                                         AND e.end <= :end
                                         ORDER BY e.start ASC, e.end ASC")
                            ->setParameter(':start', $start)
                            ->setParameter(':end', $end);
        return $query->getResult();
    }

    public function findAllByDay(\DateTime $date) {
        $start = new \DateTime($date->format('Y-m-d 00:00'));
        $end = new \DateTime($date->format('Y-m-d 23:59'));
        return $this->findAllByDates($start, $end);
    }

    public function findAllByWeek(\DateTime $date) {
        $monday = DatesTransformer::toMonday($date)->setTime(0, 0);
        $sunday = DatesTransformer::toSunday($date)->setTime(0, 0);
        return $this->findAllByDates($monday, $sunday);
    }

    public function findAllByMonth(\DateTime $date) {
        $start = DatesTransformer::toFirstMonthDay($date)->setTime(0, 0);
        $end = DatesTransformer::toLastMonthDay($date)->setTime(23, 59);
        return $this->findAllByDates($start, $end);
    }

    public function findAllByDates(\DateTime $start, \DateTime $end) {
        $query = $this->em->createQuery("SELECT e
                                         FROM $this->class e
                                         WHERE e.start >= :start AND e.start <= :end
                                         ORDER BY e.start ASC, e.end ASC")
            ->setParameter('start', $start)
            ->setParameter('end', $end);
        return $query->getResult();
    }
}