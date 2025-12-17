<?php
// Include helper functions
require_once 'includes/functions.php';

// Handle saving notes
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note_content'])) {
    saveNote($_POST['note_content']);
    echo "<script>alert('Note saved!');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Markdown Note Taker</title>
    <link rel="stylesheet" href="styles.css">
    <script src="assets/showdown/showdown.min.js"></script>
</head>
<body>
    <h1>Markdown Note Taker</h1>
    <div class="container">
        <div class="editor">
            <textarea id="note-input" placeholder="Write your note in Markdown..."></textarea>
        </div>
        <div class="preview" id="note-preview"></div>
    </div>
    <button id="save-note">Save Note</button>
    <div id="saved-notes">
        <h2>Saved Notes</h2>
        <ul id="notes-list"></ul>
    </div>
    <script src="script.js"></script>
</body>
</html>
