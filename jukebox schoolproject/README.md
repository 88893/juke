# Jukebox Project - The Hatchet

## Inleiding

Dit project is een digitale jukebox applicatie voor "The Hatchet", een moderne bar in het centrum van Rotterdam. De applicatie stelt bezoekers in staat om muziek te kiezen die in de bar wordt afgespeeld.

## Inhoudsopgave

1. [Projectbeschrijving](#projectbeschrijving)
2. [Installatie](#installatie)
3. [Ontwikkelingsproces](#ontwikkelingsproces)
4. [Projectstructuur](#projectstructuur)
5. [Functionaliteiten](#functionaliteiten)
6. [Juridische overwegingen](#juridische-overwegingen)
7. [Voortgangsrapportage](#voortgangsrapportage)

## Projectbeschrijving

De eigenaar van "The Hatchet", Marien, heeft gevraagd om een digitale jukebox applicatie waarmee bezoekers op een leuke manier muziek kunnen kiezen. De applicatie toont een overzichtelijke lijst met beschikbare nummers en bijbehorende afbeeldingen. Wanneer een bezoeker een nummer kiest, wordt dit afgespeeld en verschijnen de titel, artiest en een afbeelding in beeld.

## Installatie

1. Clone de repository:
   ```
   git clone [repository-url]
   ```
2. Navigeer naar de projectmap:
   ```
   cd jukebox
   ```
3. Installeer de dependencies:
   ```
   composer install
   npm install
   ```
4. Kopieer het .env.example bestand naar .env:
   ```
   cp .env.example .env
   ```
5. Genereer een applicatie sleutel:
   ```
   php artisan key:generate
   ```
6. Configureer de database verbinding in het .env bestand
7. Voer de migraties uit:
   ```
   php artisan migrate
   ```
8. Vul de database met voorbeeldgegevens:
   ```
   php artisan db:seed
   ```
9. Start de ontwikkelingsserver:
   ```
   php artisan serve
   ```

## Ontwikkelingsproces

### Stap 1: Project Opzetten

- Laravel project aangemaakt via Composer
- Git repository geïnitialiseerd
- Basisstructuur van het project opgezet

### Stap 2: Database Ontwerp

- Database migraties aangemaakt voor de benodigde tabellen:
  - 'songs' tabel voor het opslaan van liedjes
  - 'reviews' tabel voor het opslaan van beoordelingen
  - 'plays' tabel voor het bijhouden van het aantal keer dat een liedje is afgespeeld

### Stap 3: Models en Relaties

- Model classes gemaakt voor Song, Review en Play
- Relaties tussen de models gedefinieerd

### Stap 4: Controllers

- SongController aangemaakt voor het beheren van liedjes
- ReviewController aangemaakt voor het beheren van beoordelingen
- PlayController aangemaakt voor het bijhouden van afgespeelde liedjes

### Stap 5: Views

- Blade templates gemaakt voor verschillende pagina's:
  - Overzichtspagina met alle liedjes
  - Detailpagina voor het afspelen van een liedje
  - Formulier voor het toevoegen van beoordelingen
  - Statistiekenpagina voor het tonen van afspeelgegevens

### Stap 6: Muziek en Afbeeldingen

- Map aangemaakt voor het opslaan van muziekbestanden
- Map aangemaakt voor het opslaan van afbeeldingen
- Minimaal 5 liedjes toegevoegd aan de applicatie

### Stap 7: Beheerfunctionaliteit

- Beheerpagina's gemaakt voor het toevoegen van nieuwe liedjes

### Stap 8: Responsief Ontwerp

- Responsive design geïmplementeerd voor gebruik op verschillende apparaten
- Mobiele interface toegevoegd voor bezoekers

### Stap 9: Testen en Debuggen

- Applicatie getest op verschillende apparaten en browsers
- Bugs opgelost en verbeteringen doorgevoerd

## Projectstructuur

```
jukebox/
├── app/                    # Applicatielogica
│   ├── Http/              # HTTP-gerelateerde code
│   │   ├── Controllers/   # Controllers
│   ├── Models/            # Database models
├── database/              # Database-gerelateerde bestanden
│   ├── migrations/        # Database migraties
│   ├── seeds/             # Database seeders
├── public/                # Publiek toegankelijke bestanden
│   ├── css/               # CSS-bestanden
│   ├── js/                # JavaScript-bestanden
│   ├── music/             # Muziekbestanden
│   ├── images/            # Afbeeldingen
├── resources/             # Onbewerkte bronbestanden
│   ├── views/             # Blade templates
├── routes/                # Route definities
└── tests/                 # Automatische tests
```

## Functionaliteiten

- Weergave van een lijst met beschikbare liedjes
- Afspelen van gekozen liedjes
- Bijhouden van afspeelstatistieken per liedje
- Mogelijkheid om reviews te schrijven over liedjes
- Beheerinterface voor het toevoegen van nieuwe liedjes (wens)
- Mobiele interface voor bezoekers (wens)

## Juridische overwegingen

### BUMA/Stemra rechten

Voor het afspelen van muziek in een openbare gelegenheid zoals "The Hatchet" is een licentie van BUMA/Stemra vereist. De eigenaar moet zorgen voor een juiste licentie voor het openbaar afspelen van muziek. In deze applicatie is rekening gehouden met deze vereiste door:

- Een duidelijke melding over auteursrechten
- Documentatie over hoe de licentie moet worden verkregen

### Aanstootgevende teksten

Om problemen met aanstootgevende teksten te voorkomen, zijn de volgende maatregelen genomen:

- Een moderatieproces voor het toevoegen van nieuwe liedjes
- Mogelijkheid voor beheerders om ongepaste content te verwijderen
- Filtersysteem voor het detecteren van potentieel ongepaste teksten

## Voortgangsrapportage

### Wat is er gerealiseerd?

- Volledig functionele jukebox applicatie met Laravel
- Database structuur voor liedjes, reviews en afspeel-logs
- Gebruiksvriendelijke interface voor het afspelen van muziek
- Statistiekenmodule voor het bijhouden van populariteit
- Reviewsysteem voor bezoekers
- Beheerinterface voor eigenaar

### Uitdagingen tijdens de ontwikkeling

- Het correct implementeren van de bestandsupload functionaliteit
- Het opzetten van een intuïtieve gebruikersinterface
- Het waarborgen van de toegankelijkheid op zowel desktop als mobiel
- Het correct implementeren van de relaties tussen de models

### Leermomenten

- Verdieping in Laravel's relationele database functionaliteiten
- Ervaring opgedaan met het werken met multimedia in web applicaties
- Verbeterd inzicht in het ontwikkelen van gebruiksvriendelijke interfaces
- Kennis vergaard over juridische aspecten van muziek in openbare gelegenheden

### Toekomstige verbeteringen

- Implementatie van een zoekfunctie
- Toevoegen van een afspeelwachtrij functionaliteit
- Integratie met populaire streamingdiensten
- Uitbreiding van de beheermodule met geavanceerde statistieken
- Toevoegen van een betalingssysteem voor premium liedjes
