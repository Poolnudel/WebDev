<?php while ($comment = mysqli_fetch_assoc($comments)): ?>
    <div class="comment">
        <!-- Autor -->
        <p class="comment-author"><?= htmlspecialchars($comment['userEmail']); ?></p>
        
        <!-- Titel -->
        <p class="comment-title"><?= htmlspecialchars($comment['kommentarTitel']); ?></p>
        
        <!-- Text und Bild -->
        <div class="comment-body">
            <p class="comment-text"><?= nl2br(htmlspecialchars($comment['kommentarText'])); ?></p>
            
            <?php if (!empty($comment['kommentarBild'])): ?>
                <img src="components/<?= htmlspecialchars($comment['kommentarBild']); ?>" alt="Kommentarbild">
            <?php endif; ?>
        </div>

        <!-- Buttons -->
        <?php if ($_SESSION['user_id'] == $comment['userId']): ?>
            <div class="comment-buttons">
                <form method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="comment-id" value="<?= $comment['kommentarId']; ?>">
                    <button type="submit" class="delete-comment-button">Löschen</button>
                </form>
                <button class="edit-comment-button" 
                        data-id="<?= $comment['kommentarId']; ?>" 
                        data-title="<?= htmlspecialchars($comment['kommentarTitel']); ?>" 
                        data-text="<?= htmlspecialchars($comment['kommentarText']); ?>">
                    Bearbeiten
                </button>
            </div>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
