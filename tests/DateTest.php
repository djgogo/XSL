<?php
declare(strict_types = 1);

/**
 * @covers Date
 */
class DateTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validDateProvider
     */
    public function testValidDates($number)
    {
        $date = new Date($number);
        $this->assertInstanceOf(Date::class, $date);
        $this->assertSame($number, (string) $date);
    }

    /**
     * @dataProvider invalidDateProvider
     */
    public function testInvalidDates($number)
    {
        $this->expectException('InvalidDateException');
        new Date($number);
    }

    public function validDateProvider()
    {
        return [
            ['2016-12-31'],
            ['2016-02-29'],
            ['2015-02-28'],
            ['2016-01-01']
        ];
    }

    public function invalidDateProvider()
    {
        return [
            ['2016-12-32'],
            ['2016-13-31'],
            ['2015-02-29'],
            ['20161231'],
            ['1.1.2016'],
            ['01.01.2016'],
            ['01-01-2016'],
            [''],
            [str_repeat('1', 30)],
        ];
    }
}
