<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Detailseite</title>
    <link rel="stylesheet" href="stylesheet.css">
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

            <!-- Beispiel-Kommentar -->
            <div class="comment">
                <p class="comment-author">Max Mustermann</p>
                <p class="comment-text">Das ist ein wirklich interessanter Beitrag. Danke!</p>
            </div>

            <!-- Kommentarformular -->
            <div class="comment-form">
                <textarea rows="4" placeholder="Hinterlassen Sie einen Kommentar..."></textarea>
                <button>Kommentar absenden</button>
            </div>
        </div>
    </div>

    <!-- Fußzeile -->
    <footer>
        <div class="footer-content">
            <a href="impressum.html">Impressum</a> | <a href="kontakt.html">Kontakt</a>
        </div>
    </footer>
</body>
</html>