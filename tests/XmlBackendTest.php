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

    public function setUp()
    {
        $this->filePath = __DIR__.'/../tests/test.xml';
        $this->fileBackend = $this->getMockBuilder(FileBackend::class)->disableOriginalConstructor()->getMock();
        $this->xmlBackend = new XmlBackend($this->filePath, $this->fileBackend);

        $this->data = [
            'author' => 'Autor',
            'title' => 'Neues Buch',
            'genre' => 'Computer',
            'price' => '19.90',
            'publishDate' => '2016-12-12',
            'description' => 'Neues Buch hinzufuegen'
        ];
    }

    public function testDataCanBeWrittenToXmlFile()
    {
        $xmlString = '<?xml version="1.0"?>
<catalog>
   <book id="bk120">
   <author>Test</author>
   <title>TestTitel</title>
   <genre>Romance</genre>
   <price>50.00</price>
   <publish_date>2016-02-01</publish_date>
   <description>Bestehendes Buch</description>
   </book>
</catalog>';

        $expectedOutput = '<?xml version="1.0"?>
<catalog>
  <book id="bk120">
    <author>Test</author>
    <title>TestTitel</title>
    <genre>Romance</genre>
    <price>50.00</price>
    <publish_date>2016-02-01</publish_date>
    <description>Bestehendes Buch</description>
  </book>
  <book id="bk121">
    <author>Autor</author>
    <title>Neues Buch</title>
    <genre>Computer</genre>
    <price>19.90</price>
    <publish_date>2016-12-12</publish_date>
    <description>Neues Buch hinzufuegen</description>
  </book>
</catalog>
';
        
        $this->fileBackend
            ->expects($this->exactly(2))
            ->method('load')
            ->with($this->filePath)
            ->willReturn($xmlString);

        $this->fileBackend
            ->expects($this->once())
            ->method('save')
            ->with($this->filePath, $expectedOutput);

        $this->xmlBackend->writeDataToXml($this->data);
        $this->assertXmlStringEqualsXmlString($xmlString, $this->fileBackend->load($this->filePath));
    }
}
