<?php
declare(strict_types = 1);

/**
 * @covers XmlBackend
 * @uses FileBackend
 * @uses \TheSeer\fDOM\fDOMDocument
 */
class XmlBackendTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $filePath;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $fileBackend;
    /**
     * @var XmlBackend
     */
    private $xmlBackend;
    /**
     * @var array
     */
    private $data;
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $fDom;

    public function setUp()
    {
        $this->filePath = '/var/www/bibliothek.competec.ch/prototypes/books.xml';
        $this->fileBackend = $this->getMockBuilder(FileBackend::class)->disableOriginalConstructor()->getMock();
        $this->xmlBackend = new XmlBackend($this->filePath, $this->fileBackend);
        $this->fDom = $this->getMockBuilder(\TheSeer\fDOM\fDOMDocument::class)->disableOriginalConstructor()->getMock();

        $this->data = [
            'author' => 'Autor',
            'title' => 'Buchtitel',
            'genre' => 'Computer',
            'price' => '19.90',
            'publishDate' => '2016-12-12',
            'description' => 'Beschreibung'
        ];
    }

    public function testXmlStringCanBeWritten()
    {
        $xmlString = '<?xml version="1.0"?>
            <catalog>
                <book id="bk120">
                <author>Test</author>
                <title>Testtitel</title>
                <genre>Computer</genre>
                <price>50.00</price>
                <publish_date>2016-12-12</publish_date>
                <description>Beschreibung</description>
                </book>
            </catalog>';

        $this->fileBackend
            ->expects($this->exactly(2))
            ->method('load')
            ->with($this->filePath)
            ->willReturn($xmlString);

//        $this->fDom
//            ->expects($this->once())
//            ->method('loadXML')
//            ->with($xmlString);

        $this->xmlBackend->writeDataToXml($this->data);
        $this->assertXmlStringEqualsXmlString($xmlString, $this->fileBackend->load($this->filePath));
    }
}
