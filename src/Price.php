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
    private function ensureValid($price)
    {
        $check = preg_match('/^\d+(?:\.\d{2})?$/', $price);

       if ($check === false || $check === '0' || empty($price) || !is_numeric($price) || strlen((string)$price) > 5) {
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
