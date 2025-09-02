<?php
/**
 * ! Inmutabilidad con copia
 * Aunque la inmutabilidad es una buena práctica, no siempre es posible.
 * En estos casos, podemos hacer una copia del objeto y modificar la copia.
 *
 * Es útil para mantener un historial de estados en aplicaciones interactivas.
 */

class CodeEditorState {
    public readonly string $_content; // Readonly
    public readonly  int $_cursorPosition; // Readonly
    public readonly  bool $_unsavedChanges; // Readonly

    public function displayState()
    {
        echo "Content: {$this->_content}<br>";
        echo "Cursor Position: {$this->_cursorPosition}<br>";
        echo "Unsaved Changes: {$this->_unsavedChanges}<br>";
    }

    public function __construct(string $content = '', int $cursorPosition = 0, bool $unsavedChanges = false)
    {
        $this->_content = $content;
        $this->_cursorPosition = $cursorPosition;
        $this->_unsavedChanges = $unsavedChanges;
    }

    public function copyWith(string $content = null, int $cursorPosition = null, bool $unsavedChanges = null): CodeEditorState
    {
        return new CodeEditorState(
            $content ?? $this->_content,
            $cursorPosition ?? $this->_cursorPosition,
            $unsavedChanges ?? $this->_unsavedChanges
        );
    }
}

class CodeEditorHistory {
    private Array $history = [];
    private int $currentIndex = -1;

    public function save(CodeEditorState $state)
    {
        if($this->currentIndex < count($this->history) - 1) {
            $this->history = array_slice($this->history, 0, $this->currentIndex + 1);
        }
        $this->history[] = $state;
        $this->currentIndex++;
    }

    public function redo(): ?CodeEditorState
    {
        if($this->currentIndex < count($this->history) - 1) {
            $this->currentIndex++;
            return $this->history[$this->currentIndex];
        }
        return null;
    }

}

$editor = new CodeEditorState();
$editor->_content = 'Hello World';