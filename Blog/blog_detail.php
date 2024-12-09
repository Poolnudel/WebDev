<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detailseite</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detail-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .detail-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .detail-title {
            font-size: 2rem;
            color: #294936;
        }

        .detail-meta {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .detail-content {
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
        }

        .comments-section {
            margin-top: 2rem;
        }

        .comments-section h2 {
            font-size: 1.5rem;
            color: #294936;
            margin-bottom: 1rem;
        }

        .comment {
            border-top: 1px solid #ccc;
            padding: 1rem 0;
        }

        .comment-author {
            font-weight: bold;
            color: #555;
        }

        .comment-text {
            margin-top: 0.5rem;
            color: #333;
        }

        .comment-form {
            margin-top: 1.5rem;
        }

        .comment-form textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .comment-form button {
            margin-top: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: #294936;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .comment-form button:hover {
            background-color: #3E6259;
        }
    </style>
</head>
<body>
    <!-- Kopfzeile -->
    <header style="background-color: #294936; width: 100%;">
        <div class="header-logo" style="padding: 1em; text-align: center; color: white; font-size: 1.5em;">
            <span>WInf</span>
        </div>
    </header>

    <!-- Detailansicht -->
    <div class="detail-container">
        <div class="detail-header">
            <h1 class="detail-title">Blogeintrag Titel</h1>
            <p class="detail-meta">Verfasst von Autorname am 01.01.2024</p>
        </div>

        <div class="detail-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vel nisi id nisl tempor vehicula. Nulla facilisi. Duis volutpat, nisl et suscipit fermentum, lacus erat euismod sapien, eget ullamcorper orci mi vitae velit.</p>
            <p>Quisque ut sapien nec lorem tincidunt condimentum. Phasellus congue consequat libero, at vehicula est efficitur non.</p>
        </div>

        <div class="comments-section">
            <h2>Kommentare</h2>

            <div id="comments"></div>

            <!-- Kommentarformular -->
            <div class="comment-form">
                <textarea id="comment-input" rows="4" placeholder="Hinterlassen Sie einen Kommentar..."></textarea>
                <button onclick="addComment()">Kommentar absenden</button>
            </div>
        </div>
    </div>

    <script>
        // Temporäres Array, um Kommentare zu speichern
        const comments = [];

        function addComment() {
            const commentInput = document.getElementById('comment-input');
            const commentText = commentInput.value.trim();

            if (commentText) {
                // Kommentar dem Array hinzufügen
                comments.push({
                    author: 'Anonymer Nutzer',
                    text: commentText
                });

                // Kommentar anzeigen
                renderComments();

                // Eingabefeld leeren
                commentInput.value = '';
            } else {
                alert('Bitte geben Sie einen Kommentar ein.');
            }
        }

        function renderComments() {
            const commentsContainer = document.getElementById('comments');
            commentsContainer.innerHTML = '';

            comments.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.classList.add('comment');

                const author = document.createElement('p');
                author.classList.add('comment-author');
                author.textContent = comment.author;

                const text = document.createElement('p');
                text.classList.add('comment-text');
                text.textContent = comment.text;

                commentDiv.appendChild(author);
                commentDiv.appendChild(text);
                commentsContainer.appendChild(commentDiv);
            });
        }
    </script>

    <!-- Fußzeile -->
    <footer>
        <div class="footer-content">
            <a href="impressum.html">Impressum</a> | <a href="kontakt.html">Kontakt</a>
        </div>
    </footer>
</body>
</html>
