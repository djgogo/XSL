<?php
declare(strict_types = 1);

class XmlBackend
{
    /**
     * @var string
     */
    private $filePath;
    /**
     * @var FileBackend
     */
    private $fileBackend;

    /**
     * XmlBackend constructor.
     * @param string $filePath
     * @param FileBackend $fileBackend
     */
    public function __construct(string $filePath, FileBackend $fileBackend)
    {
        $this->filePath = $filePath;
        $this->fileBackend = $fileBackend;
    }

    /**
     * @param array $data
     * @throws Exception
     * @throws XmlBackendException
     * @throws \TheSeer\fDOM\fDOMException
     */
    public function writeDataToXml(array $data)
    {
        $xmlString = $this->fileBackend->load($this->filePath);

        /**
         * @var $dom \TheSeer\fDOM\fDOMDocument
         */
        $dom = new \TheSeer\fDOM\fDOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        $dom->loadXML($xmlString);

        $book = $dom->createElement('book');
        $book->setAttribute('id', $this->evaluateBookId($dom));

        $book->appendElement('author', $data['author']);
        $book->appendElement('title' , $data['title']);
        $book->appendElement('genre' , $data['genre']);
        $book->appendElement('price' , $data['price']);
        $book->appendElement('publish_date' , $data['publishDate']);
        $book->appendElement('description' , $data['description']);

        $dom->documentElement->appendChild($book);

        $this->fileBackend->save($this->filePath, $dom->saveXML());
    }

    /**
     * @param \TheSeer\fDOM\fDOMDocument $dom
     * @return string
     */
    private function evaluateBookId(\TheSeer\fDOM\fDOMDocument $dom) : string
    {
        $books = $dom->query("/catalog/book[last()]");

        $lastAssignedId = '';
        foreach($books as $book) {
            /**
             * @var $book DOMElement
             */
            $lastAssignedId = $book->getAttribute('id');
        }

        $newId = (int)substr($lastAssignedId, -3);
        $newId++;

        return 'bk' . $newId;
    }
}
