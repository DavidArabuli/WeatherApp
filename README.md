# Weather App

Laikapstākļu aplikācija, kas izmanto OpenWeather API, lai parādītu
pašreizējos laikapstākļus dažādās pilsētās visā pasaulē.
Lietotājam ir iespēja pievienot jaunas pilsētas un apskatīt detalizētāku
informāciju par katras pilsētas laikapstākļiem.

## Tehnoloģijas
- PHP 8.2
- PostgreSQL
- Docker & Docker Compose
- Nginx
- OpenWeather API
- CSS

## Deployment
Projekts ir pieejams publiski šeit:  
https://weatherapp.devstack.lv/

## Setup
Projektu iespējams palaist lokāli, izmantojot Docker Compose
(konfigurācijā tiek izmantots API atslēgas fails).

## Piezīmes, ierobežojumi un potenciālie uzlabojumi

Šis risinājums ir veidots kā neliela apjoma testa uzdevums, koncentrējoties
uz galveno funkcionalitāti un prasību izpildi ierobežota laika ietvarā.

Pilna mēroga publiskā projektā vai produkcijas vidē es ieviestu vairākus
papildu uzlabojumus, kas šī uzdevuma ietvaros apzināti netika realizēti.

### Autorizācija un lietotāju pārvaldība

Pašlaik aplikācijā nav lietotāju autorizācijas, un visi lietotāji strādā ar
vienu kopīgu datu kopu (pilsētu sarakstu).

Pilnā versijā tiktu ieviests:
- lietotāju autentifikācijas mehānisms (piemēram, sesijas vai JWT),
- `users` tabula,
- starptabulas (piemēram, lietotāju iecienītās pilsētas),
- lietotāju tiesību līmeņi vai administrācijas panelis.

### Darbs ar datiem

Šobrīd pilsētu saraksts ir kopīgs visiem lietotājiem.
Pilna mēroga projektā:
- katram lietotājam būtu savs iecienīto pilsētu saraksts,
- lielākas slodzes gadījumā būtu lietderīgi izmantot ziņojumu brokeri,
- būtu iespējams saglabāt lietotāja preferences (vienības, noklusējuma skatus u.c.),
- lietotāja pieredzi varētu uzlabot, izmantojot sīkdatnes vai sesijas.

### Kļūdu apstrāde un edge case segums

Esošā kļūdu apstrāde ir pamata līmenī.
Pieejot projektam ilgtermiņā:
- tiktu apstrādāti specifiskāki API kļūdu scenāriji,
- pievienoti lietotājam saprotami kļūdu paziņojumi dažādiem gadījumiem.

### API pieprasījumu optimizācija un throttling

Lai samazinātu API pieprasījumu skaitu un potenciālās izmaksas:
- tiktu ieviests request throttling,
- izmantota kešēšana (piemēram, Redis vai datubāzes kešs).

### Frontend arhitektūra un tehnoloģiju izvēle

Šajā uzdevumā tika izvēlēts PHP, jo:
- tas bija viens no piedāvātajiem risinājumiem, ar kuru man ir laba pieredze,
- tas ļāva fokusēties uz biznesa loģiku un backend daļu ierobežota laika apstākļos.

Lielākā vai ilgtermiņa projektā es apsvērtu:
- React (vai React Router v7 kā fullstack risinājumu),
- komponentēs balstītu frontend arhitektūru,
- atsevišķu API slāni un neatkarīgu frontend aplikāciju.

### Testēšana un kvalitāte

Šī testa uzdevuma ietvaros netika ieviesti automatizēti testi.
Pilna mēroga projektā būtu lietderīgi:
- pievienot vienību un integrācijas testus,
- izmantot CI/CD pipeline automatizētai testēšanai un izvietošanai.
