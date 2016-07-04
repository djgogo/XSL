<?php
declare(strict_types = 1);

class BooksFormCommand
{
    /**
     * @var string
     */
    private $author;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $genre;
    /**
     * @var string
     */
    private $price;
    /**
     * @var string
     */
    private $publishDate;
    /**
     * @var string
     */
    private $description;
    /**
     * @var \TheSeer\fDOM\fDOMDocument
     */
    private $dataModel;
    /**
     * @var Request
     */
    private $postRequest;
    /**
     * @var XmlBackend
     */
    private $xmlBackend;

    /**
     * BooksFormCommand constructor.
     * @param XmlBackend $xmlBackend
     * @param Request $postRequest
     * @param \TheSeer\fDOM\fDOMDocument $dataModel
     */
    public function __construct(XmlBackend $xmlBackend, Request $postRequest, \TheSeer\fDOM\fDOMDocument $dataModel)
    {
        $this->author = $postRequest->getParameter('author');
        $this->title = $postRequest->getParameter('title');
        $this->genre = $postRequest->getParameter('genre');
        $this->price = $postRequest->getParameter('price');
        $this->publishDate = $postRequest->getParameter('publishDate');
        $this->description = $postRequest->getParameter('description');

        $this->dataModel = $dataModel;
        $this->postRequest = $postRequest;
        $this->xmlBackend = $xmlBackend;
    }

    public function validateRequest()
    {
        try {
            new Price($this->price);
        } catch (\InvalidArgumentException $e) {
            $this->dataModel->queryOne('//field[@name="price"]/error')->nodeValue = 'Bitte geben Sie einen gültigen Preis ein';
        }

        $allowedGenres = [
            'Computer',
            'Fantasy',
            'Romance',
            'Horror',
            'Science Fiction'
        ];

        if (!in_array($this->genre, $allowedGenres)) {
            throw new Exception('Genre nicht gültig ' . $this->genre);
        }

        try {
            new Date($this->publishDate);
        } catch (\InvalidArgumentException $e) {
            $this->dataModel->queryOne('//field[@name="publishDate"]/error')->nodeValue = 'Bitte geben Sie ein gültiges Datum ein';
        }

        $this->validateEmptyFormField($this->author, 'author', 'Bitte geben Sie den Author Namen ein');
        $this->validateEmptyFormField($this->title, 'title', 'Bitte geben Sie den Titelnamen ein');
        $this->validateEmptyFormField($this->genre, 'genre', 'Bitte geben sie das Genre ein');
        $this->validateEmptyFormField($this->price, 'price', 'Bitte geben sie den Preis ein');
        $this->validateEmptyFormField($this->publishDate, 'publishDate', 'Bitte geben Sie das Publikationsdatum ein');
        $this->validateEmptyFormField($this->description, 'description', 'Bitte geben sie die Beschreibung ein');
    }

    /**
     * @param string $field
     * @param string $fieldName
     * @param string $value
     */
    private function validateEmptyFormField(string $field, string $fieldName, string $value)
    {
        if ($field === '') {
            $this->dataModel->queryOne('//field[@name="'. $fieldName .'"]/error')->nodeValue = $value;
        }
    }

    public function performAction()
    {
        $book = [
            'author' => $this->author,
            'title' => $this->title,
            'genre' => $this->genre,
            'price' => $this->price,
            'publishDate' => $this->publishDate,
            'description' => $this->description
        ];

        try {
            $this->xmlBackend->writeDataToXml($book);
            $this->dataModel->queryOne('//field[@name="message"]/value')->nodeValue = 'Buch wurde erfolgreich gespeichert';
        } catch (\Throwable $e) {
            $this->dataModel->queryOne('//field[@name="message"]/value')->nodeValue = 'Fehler: Das Buch konnte nicht gespeichert werden!';
        }
    }

    /**
     * @return bool
     */
    public function hasErrors() : bool
    {
        $nodeList = $this->dataModel->query('//field/error');
        foreach ($nodeList as $node) {
            /** @var \TheSeer\fDOM\fDOMElement */
            if ($node->nodeValue !== '') {
                return true;
            }
        }
        return false;
    }

    public function repopulateForm()
    {
        switch ($this->genre){
            case 'Computer':
                $this->selectDropDownValue('computer');
                $this->unSelectDropDownValue(['fantasy', 'romance', 'horror', 'scienceFiction']);
                break;
            case 'Fantasy';
                $this->selectDropDownValue('fantasy');
                $this->unSelectDropDownValue(['computer', 'romance', 'horror', 'scienceFiction']);
                break;
            case 'Romance';
                $this->selectDropDownValue('romance');
                $this->unSelectDropDownValue(['computer', 'fantasy', 'horror', 'scienceFiction']);
                break;
            case 'Horror';
                $this->selectDropDownValue('horror');
                $this->unSelectDropDownValue(['computer', 'fantasy', 'romance', 'scienceFiction']);
                break;
            case 'Science Fiction';
                $this->selectDropDownValue('scienceFiction');
                $this->unSelectDropDownValue(['computer', 'fantasy', 'romance', 'horror']);
                break;
            default:
                throw new Exception('Genre nicht in Datei vorhanden! ' . $this->genre);
        }

        $this->repopulate($this->author, 'author');
        $this->repopulate($this->title, 'title');
        $this->repopulate($this->price, 'price');
        $this->repopulate($this->publishDate, 'publishDate');
        $this->repopulate($this->description, 'description');
    }

    /**
     * @param string $dropDownElement
     */
    private function selectDropDownValue(string $dropDownElement)
    {
        $this->dataModel->queryOne('//field[@name="genre"]/'. $dropDownElement)->nodeValue = 'selected';
    }

    /**
     * @param array $dropDownElements
     */
    private function unSelectDropDownValue(array $dropDownElements)
    {
        foreach ($dropDownElements as $dropDownElement) {
            $this->dataModel->queryOne('//field[@name="genre"]/'. $dropDownElement)->nodeValue = '';
        }
    }

    /**
     * @param string $field
     * @param string $fieldName
     */
    private function repopulate(string $field, string $fieldName)
    {
        if (!empty($field)) {
            $this->dataModel->queryOne('//field[@name="'. $fieldName .'"]/value')->nodeValue = $field;
        }
    }

}
