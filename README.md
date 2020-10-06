# DT173G - Moment 5 - REST-webbtjänster Server

## Info

Används ihop med klient som går att hitta här:
https://github.com/veglinus/DT173G_moment5_client

Klona och lägg in i webbserver för att köra. Kopplas till en databas med följande struktur:
code(varchar 6) PK
name(text)
progression(varchar 5)
syllabus(text)

## API

Alla requests görs till api.php. Det finns single-files där varje funktion är uppdelad till en fil var i mappen single-files.

### Create
Skapar en ny kurs. POST request med code, name, progression och syllabus.

### Read
Visar alla kurser i JSON format. Använd GET.

### Update
Redigerar en kolumn i en kurs. Ange radens kurskod som 'index', vilken kolumn som ska ändras som 'what' och nya värdet som 'newvalue'.
Exempel: Jag har följande kurs:
IK060G - Projektledning - B - Kursplan

Om jag vill ändra namnet på projektledning till 'nytt värde' skickar jag följande request:
index = 'IK060G', what = 'kursnamn', newvalue = 'nytt värde'
Kursnamn syftar alltså här på kolumnen kursnamn i tabellen.

### Delete
Tar bort en kurs. DELETE request där 'code' är kurskoden.
