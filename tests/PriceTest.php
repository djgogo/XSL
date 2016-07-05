<?php
declare(strict_types = 1);

/**
 * @covers Price
 */
class PriceTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validPriceProvider
     */
    public function testValidPrice($number)
    {
        $price = new Price($number);
        $this->assertInstanceOf(Price::class, $price);
        $this->assertSame($number, (string) $price);
    }

    /**
     * @dataProvider invalidPriceProvider
     */
    public function testInvalidPrice($number)
    {
        $this->expectException('InvalidPriceException');
        new Price($number);
    }

    public function validPriceProvider()
    {
        return [
            ['100'],
            ['100.99'],
            ['1'],
            ['1.00']
        ];
    }

    public function invalidPriceProvider()
    {
        return [
            ['101'],
            ['10.123'],
            ['1.123456'],
            ['-10.00'],
            ['+10.00'],
            ['ichBinKeineZahl'],
            [''],
            [str_repeat('1', 30)],
        ];
    }
}
