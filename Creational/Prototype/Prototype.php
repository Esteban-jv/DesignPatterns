<?php
/**
 * ! Patrón Prototype:
 *
 * Es un patrón de diseño creacional que nos permite copiar objetos existentes sin tener que hacer
 * que el código dependa de sus clases.
 *
 * Es útil cuando queremos duplicar el contenido,
 * el título y el autor de un documento, por ejemplo cualquier objeto complejo
 */

class Document {
    public string $title;
    public string $author;
    private string $content;

    public function __construct(string $title, string $content, string $author)
    {
        $this->title = $title;
        $this->author = $author;
        $this->content = $content;
    }

    public function displayInfo()
    {
        echo "Title: {$this->title}\n";
        echo "Author: {$this->author}\n";
        echo "Content: {$this->content}\n";
    }

    // Fix in PHP: https://www.php.net/manual/en/language.oop5.cloning.php
    public function __clone()
    {
        return new Document($this->title, $this->content, $this->author);
    }

    // Pattern fix
    public function clone() : Document
    {
        return new Document($this->title, $this->content, $this->author); // Cuidar que los atributos no se pasen por referencia
    }
}

function main()
{
    $document = new Document('Design Patterns', 'This is a book about design patterns', 'John Doe');
    $document->displayInfo();
    var_dump($document);
    echo "<br><br>";

//    $documentCopy = clone $document; // the same
    $documentCopy = clone $document->clone(); // the same
    $documentCopy->title = 'Design Patterns 2';
    $documentCopy->displayInfo();
    var_dump($documentCopy);
}

require_once 'Pokemon.php';
function main2()
{
    $charmander = new Pokemon('Charmander', 'Fire', 5, ['Scratch', 'Ember', 'Flamethrower']);
    $charmander->displayInfo();
    var_dump($charmander);
    echo "<br><br>";

    $charmilio = clone $charmander;
    $charmilio->attacks[] = 'Lanzallamas';
    $charmilio->displayInfo();
    var_dump($charmilio);
    echo "<br><br>";
    var_dump($charmander);
}

//main();
main2();