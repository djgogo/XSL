<?php
declare(strict_types = 1);

class Price
{
    /**
     * @var string
     */
    private $price;

    /**
     * @param $price
     */
    public function __construct(string $price)
    {
        $this->ensureValid($price);
    }

    /**
     * @param $price
     */
    private function ensureValid(string $price)
    {
        $check = preg_match('/^\d{0,3}(\.\d{1,2})?$/', $price);

       if ($check === false || $check === 0 || empty($price) || !is_numeric($price) || $price >= 101) {
            throw new \InvalidPriceException();
       }

        $this->price = $price;
    }

    /**
     * @return string
     */
    function __toString() : string
    {
        return $this->price;
    }
}
