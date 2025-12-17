document.addEventListener('DOMContentLoaded', () => {
    const noteInput = document.getElementById('note-input');
    const notePreview = document.getElementById('note-preview');
    const saveButton = document.getElementById('save-note');
    const notesList = document.getElementById('notes-list');

    // Initialize Showdown converter
    const converter = new showdown.Converter();

    // Update preview as user types
    noteInput.addEventListener('input', () => {
        const markdownText = noteInput.value;
        const html = converter.makeHtml(markdownText);
        notePreview.innerHTML = html;
    });

    // Save note
    saveButton.addEventListener('click', async () => {
        const noteContent = noteInput.value;
        const response = await fetch('index.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `note_content=${encodeURIComponent(noteContent)}`
        });
        const result = await response.text();
        loadNotes(); // Refresh the notes list
    });

    // Load saved notes
    async function loadNotes() {
        const response = await fetch('includes/load_notes.php');
        const notes = await response.json();
        notesList.innerHTML = notes.map(note =>
            `<li><a href="#" onclick="loadNote('${note.filename}')">${note.filename}</a></li>`
        ).join('');
    }

    // Load a specific note
    async function loadNote(filename) {
        const response = await fetch(`notes/${filename}`);
        const content = await response.text();
        noteInput.value = content;
        notePreview.innerHTML = converter.makeHtml(content);
    }

    // Load notes on page load
    loadNotes();

    // Expose loadNote to global scope for onclick
    window.loadNote = loadNote;
});
