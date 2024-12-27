<div id="comment-modal" class="modal">
    <div class="modal-content">
        <span id="close-modal">&times;</span>
        <h2 id="modal-title">Kommentar schreiben</h2>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" id="modal-action" value="add">
            <input type="hidden" name="comment-id" id="comment-id">
            
            <label for="comment-title">Titel:</label>
            <input type="text" name="comment-title" id="comment-title" required>
            
            <label for="comment-text">Kommentar:</label>
            <textarea name="comment-text" id="comment-text" rows="4" required></textarea>
            
            <label for="comment-image">Bild hinzufügen:</label>
            <input type="file" name="comment-image" id="comment-image" accept="image/png, image/jpeg, image/gif">
            
            <div>
                <button type="button" id="cancel-button">Abbrechen</button>
                <button type="submit">Speichern</button>
            </div>
        </form>
    </div>
</div>
