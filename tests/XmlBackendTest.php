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
        $this->filePath = __DIR__.'/test.xml';
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
        $xmlString = file_get_contents(__DIR__.'/xmlString.xml');
        $expectedOutput = file_get_contents(__DIR__.'/expectedXmlOutput.xml');
        
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
        $this->assertXmlStringEqualsXmlFile(__DIR__.'/xmlString.xml', $this->fileBackend->load($this->filePath));
    }
}
