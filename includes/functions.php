<?php
// Save a note to the 'notes' directory
function saveNote($content) {
    $filename = 'notes/' . date('Y-m-d_H-i-s') . '.md';
    if (!file_exists('notes')) {
        mkdir('notes', 0777, true);
    }
    file_put_contents($filename, $content);
}

// Load all saved notes
function loadNotes() {
    $notes = [];
    if (file_exists('notes')) {
        $files = scandir('notes');
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'md') {
                $notes[] = [
                    'filename' => $file,
                    'content' => file_get_contents('notes/' . $file)
                ];
            }
        }
    }
    return $notes;
}
?>
