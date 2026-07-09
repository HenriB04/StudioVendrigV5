# Studio Vendrig V5 — "Atelier op papier"

Een nieuwe look voor [www.studiovendrig.nl](https://www.studiovendrig.nl), gebouwd in puur PHP
(geen frameworks, geen database). Alle inhoud van de originele site is 1-op-1 behouden:
projecten, nieuwsberichten, studio-tekst, samenwerking (Studio In Motion) en contactgegevens.

## Ontwerp

Warm papierkleurig canvas, inktzwart en een terracotta accent, met Space Grotesk en Inter
als typografie. Kenmerken: grote outline-typografie in de hero met wisselende projectfoto's,
een lopende tekstband, genummerde navigatie, strakke hairline-rasters voor de projectkaarten
en een lightbox-galerij per project.

## Lokaal draaien

Vereist alleen PHP (8.x):

```
php -S localhost:8050
```

Open daarna [http://localhost:8050](http://localhost:8050) in de browser.

## Structuur

| Pad | Inhoud |
| --- | --- |
| `index.php` | Homepage met hero, knowhow, uitgelichte projecten en nieuws |
| `projecten.php` | Alle projecten, filterbaar per categorie (`?cat=`) |
| `project.php` | Projectdetail met galerij en projectinfo (`?id=`) |
| `studio.php` | Over Studio Vendrig |
| `nieuws.php` | Nieuwsoverzicht en -detail (`?id=`) |
| `samenwerking.php` | Studio In Motion |
| `contact.php` | Contactgegevens en formulier (berichten komen lokaal in `berichten.log`) |
| `includes/` | Gedeelde header/footer, helpers en de project-/nieuwsdata |
| `assets/` | Foto's, CSS, JavaScript en downloadbare bestanden |
