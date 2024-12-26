<?php while ($comment = mysqli_fetch_assoc($comments)): ?>
    <div class="comment">
        <p class="comment-author"><?= htmlspecialchars($comment['userEmail']); ?></p>
        <p class="comment-title"><?= htmlspecialchars($comment['kommentarTitel']); ?></p>
        <p class="comment-text"><?= nl2br(htmlspecialchars($comment['kommentarText'])); ?></p>

        <?php if ($_SESSION['user_id'] == $comment['userId']): ?>
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
        <?php endif; ?>
    </div>
<?php endwhile; ?>
