<?php
declare(strict_types = 1);

/**
 * @covers Request
 * @covers PostRequest
 */
class RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PostRequest
     */
    private $postRequest;

    private $post;

    public function setUp()
    {
        $this->post['author'] = 'Jule Verne';
        $this->post['title'] = 'Die Reise zum Mond';
        $this->post['genre'] = 'Science Fiction';

        $this->postRequest = new PostRequest($this->post);
    }

    public function testHasParameterReturnsRightBoolean()
    {
        $this->assertTrue($this->postRequest->hasParameter('author'));
        $this->assertFalse($this->postRequest->hasParameter('Invlaid Parameter'));
    }

    public function testParameterCanBeRetrieved()
    {
        $this->assertEquals('Jule Verne', $this->postRequest->getParameter('author'));
    }

    public function testWrongParameterThrowsException()
    {
        $this->expectException('Exception');
        $this->postRequest->getParameter('invalid parameter');
    }

    public function testParametersCanBeRetrieved()
    {
        $this->assertEquals($this->post, $this->postRequest->getParameters());
    }
}
