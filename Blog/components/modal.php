<div id="comment-modal" class="modal">
    <div class="modal-content">
        <span id="close-modal" class="close">&times;</span>
        <h3 id="modal-title">Neuen Kommentar schreiben</h3>
        <form method="POST">
            <input type="hidden" name="action" value="add" id="modal-action">
            <input type="hidden" name="comment-id" id="comment-id">
            <div class="form-group">
                <label for="comment-title">Titel</label>
                <input type="text" id="comment-title" name="comment-title" required>
            </div>
            <div class="form-group">
                <label for="comment-text">Kommentar</label>
                <textarea id="comment-text" name="comment-text" rows="4" required></textarea>
            </div>
            <button type="submit">Speichern</button>
        </form>
    </div>
</div>
