<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wirtschaftsinformatik</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesheet.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #294936;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-logo {
            padding: 1em;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-logo img {
            height: 60px;
        }

        .hero {
            text-align: center;
            padding: 0.75rem;
            background: linear-gradient(to right, #294936, #3E6259);
            color: white;
        }

        .hero h1 {
            font-size: 1rem;
            margin: 0;
            color: rgb(212, 217, 210);
        }

        .veranstaltungen {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            padding: 2rem;
            justify-content: center;
        }

        .veranstaltung {
            display: flex;
            width: calc(45% - 1rem);
            height: 200px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: #fff;
        }

        .veranstaltung:hover {
            transform: scale(1.03);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        .veranstaltung .text {
            flex: 2;
            display: flex;
            align-items: center;
            padding-left: 1rem;
            font-size: 1.2rem;
            color: #294936;
        }

        .veranstaltung .image {
            flex: 1.5;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .veranstaltung .image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
            z-index: 1;
        }

        @media screen and (max-width: 768px) {
            .veranstaltung {
                width: 100%;
            }
        }

        footer {
            background-color: #294936;
            text-align: center;
            padding: 1rem;
            color: white;
        }

        footer a {
            color: #d7e4c0;
            text-decoration: none;
            margin: 0 1rem;
            font-size: 0.9rem;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Kopfzeile -->
    <header>
        <div class="header-logo">
            <img src="images/winf-logo.png" alt="WInf Logo">
        </div>
    </header>

    <!-- Hero-Bereich mit Grafik und Titel -->
    <section class="hero">
        <h1>Vorlesungsveranstaltungen der Wirtschaftsinformatik</h1>
    </section>

    <!-- Galerie für Veranstaltungen -->
    <section class="veranstaltungen">
        <div class="veranstaltung">
            <div class="text">
                Application Development
            </div>
            <div class="image" style="background-image: url('images/kachel_appDev.webp');">
            </div>
        </div>
        <div class="veranstaltung">
            <div class="text">
                Web Development
            </div>
            <div class="image" style="background-image: url('images/kachel_webDev.png');">
            </div>
        </div>
        <div class="veranstaltung">
            <div class="text">
                IT Infrastrukturen
            </div>
            <div class="image" style="background-image: url('images/kachel_itInfrastructure.webp');">
            </div>
        </div>
        <div class="veranstaltung">
            <div class="text">
                IT Architekturen
            </div>
            <div class="image" style="background-image: url('images/kachel_itArchitecture.jpg');">
            </div>
        </div>
    </section>

    <!-- Fußzeile -->
    <footer>
        <div class="footer-content">
            <a href="impressum.html">Impressum</a> | <a href="kontakt.html">Kontakt</a>
        </div>
    </footer>
</body>
</html>
