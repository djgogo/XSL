<?php
declare(strict_types = 1);

class Date
{
    /**
     * @var string
     */
    private $date;

    /**
     * @param $date
     */
    public function __construct(string $date)
    {
        $this->ensureValid($date);
    }

    /**
     * @param $date
     */
    private function ensureValid(string $date)
    {
        $dt = DateTime::createFromFormat("Y-m-d", $date);
        $check = $dt !== false && !array_sum($dt->getLastErrors());

       if ($check === false){
            throw new \InvalidDateException();
       }

        $this->date = $dt->format('Y-m-d');
    }

    /**
     * @return string
     */
    function __toString() : string
    {
        return $this->date;
    }
}
