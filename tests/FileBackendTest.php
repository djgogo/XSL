<?php
declare(strict_types = 1);

class FileBackendTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $filePath;
    /**
     * @var FileBackend
     */
    private $fileBackend;

    public function setUp()
    {
        $this->filePath =  sys_get_temp_dir() . '/' . uniqid('test');
        $this->fileBackend = new FileBackend();
    }

    public function testContentFromFileCanBeLoaded()
    {
        file_put_contents($this->filePath, 'test');
        $this->assertEquals('test', $this->fileBackend->load($this->filePath));
    }

    public function testThrowsExceptionWhileLoadingIfFileDoesNotExist()
    {
        $this->expectException('FileBackendException');
        $this->fileBackend->load(__DIR__ . '/does/not/exist/');
    }

    public function testContentCanBeSaved()
    {
        $this->fileBackend->save($this->filePath, 'test');
        $this->assertContains('test', file_get_contents($this->filePath));
    }
}
