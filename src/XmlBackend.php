<?php
declare(strict_types = 1);

class XmlBackend
{
    /**
     * @var \TheSeer\fDOM\fDOMDocument
     */
    private $dom;
    /**
     * @var string
     */
    private $filePath;

    /**
     * XmlBackend constructor.
     * @param string $filePath
     * @param \TheSeer\fDOM\fDOMDocument $dom
     */
    public function __construct(string $filePath, \TheSeer\fDOM\fDOMDocument $dom)
    {
        $this->filePath = $filePath;
        $this->dom = $dom;
    }

    /**
     * @param array $data
     * @throws XmlBackendException
     * @throws \TheSeer\fDOM\fDOMException
     */
    public function writeDataToXml(array $data)
    {
        $book = $this->dom->createElement('book');
        $book->setAttribute('id', $this->evaluateBookId());

        $book->appendElement('author', $data['author']);
        $book->appendElement('title' , $data['title']);
        $book->appendElement('genre' , $data['genre']);
        $book->appendElement('price' , $data['price']);
        $book->appendElement('publish_date' , $data['publishDate']);
        $book->appendElement('description' , $data['description']);

        $this->dom->documentElement->appendChild($book);

        $xml = $this->dom->save($this->filePath);
        if ($xml === false) {
            throw new XmlBackendException('Datei "' . $this->filePath . '" konnte nicht gespeichert werden');
        }
    }

    /**
     * @return string
     */
    public function evaluateBookId() : string
    {
        $books = $this->dom->query("/catalog/book[last()]");

        $lastAssignedId = '';
        foreach($books as $book) {
            /**
             * @var $book DOMElement
             */
            $lastAssignedId = $book->getAttribute('id');
        }

        $newId = substr($lastAssignedId, -3);
        $newId++;

        return "bk$newId";
    }
}
