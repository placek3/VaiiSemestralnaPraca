# Spisovateľské prostredie

Samuel Plaček

Študijná skupina

# Spisovateľské prostredie (All-in-One IDE pre autorov)

## Stručný opis projektu
Pripravovaná webová aplikácia rieši problém neprehľadnosti a roztrieštenosti podkladov, s ktorým sa stretávajú študenti, hobbysti a začínajúci spisovatelia pri tvorbe kníh. V súčasnosti musia autori používať množstvo otvorených okien v prehliadači na rešerš a samostatné súbory pre časové línie, osnovy, opis postáv či jednotlivé kapitoly. Tento chaotický prístup vedie k strate času, neefektivite a hlavne k demotivácii.

Aplikácia zjednocuje celý proces tvorby príbehu do jedného prehľadného webového prostredia. Ponúka integrovaný textový editor, databázu sveta (postavy, lokality, artefakty), časovú os, osnovu. Hlavným účelom je poskytnúť bezplatný, dostupný a intuitívny nástroj, ktorý autorom umožní mať všetky podklady na jednom mieste bez nutnosti otvárať mnoho externých stránok a dokumentov.

## Role v projekte
* **Návštevník (Neregistrovaný používateľ):** Môže si prezerať úvodnú stránku, funkcie aplikácie, cenník/informácie o projekte a registrovať sa alebo prihlásiť.
* **Registrovaný autor (Bežný používateľ):** Má plný prístup ku svojmu osobnému účtu. Môže vytvárať, upravovať a spravovať svoje knižné projekty, kapitoly, postavy, časové línie a rešeršné poznámky.
* **Správca (Administrator):** Zodpovedá za chod a údržbu aplikácie, spravuje používateľské účty, monitoruje systém a spravuje globálne nastavenia aplikácie.

## Prípady použitia podľa rolí

### Návštevník
* Návštevník si prezerá informácie o webovej aplikácii a jej funkciách.
* Návštevník si vytvorí nový používateľský účet (registrácia).
* Návštevník sa prihlási do existujúceho účtu.

### Registrovaný autor
* Autor si vytvorí nový knižný projekt (napr. román, poviedku).
* Autor si organizuje kapitoly a scény v strome projektu (vytváranie, premenovanie, presúvanie).
* Autor píše a upravuje text kapitoly v čisto koncipovanom textovom editore.
* Autor si vytvorí kartu postavy/predmetu/lokality s vlastnosťami a obrázkami.
* Autor označí postavu alebo predmet priamo v texte kapitoly (mentions/tagovanie).
* Autor si priradí udalosti na interaktívnu časovú os príbehu.
* Autor si uloží rešeršný odkaz, výstrižok alebo poznámku do záložky výskumu.
* Autor vyprázdni/vyhľadá kľúčové slovo naprieč celým projektom (texty, postavy, poznámky).
* Autor si exportuje dielo alebo jeho časť do formátu PDF, DOCX alebo Markdown.

### Správca
* Správca si zobrazí zoznam registrovaných používateľov a štatistiky systému.
* Správca zablokuje alebo vymaže používateľský účet v prípade porušenia podmienok.
* Správca spravuje predvolené šablóny pre postavy a svet (worldbuilding templates).

## Plánované entity

* **User (Používateľ):** Reprezentuje registrovaného autora alebo správcu.
  * *Atribúty:* `id`, `username`, `email`, `password_hash`, `role`, `created_at`
  * *Vzťahy:* 1:N k entite `Project`.

* **Project (Knižný projekt):** Reprezentuje samotnú knihu alebo príbeh.
  * *Atribúty:* `id`, `user_id`, `title`, `genre`, `description`, `created_at`, `updated_at`
  * *Vzťahy:* Patrí Používateľovi (N:1), obsahuje kapitoly (`Chapter`), entity sveta (`WorldEntity`), udalosti (`TimelineEvent`) a rešerše (`ResearchItem`).

* **Chapter (Kapitola / Scéna):** Jednotlivé časti textu rukopisu.
  * *Atribúty:* `id`, `project_id`, `title`, `content`, `order_index`, `status` (návrh, dokončené atď.)
  * *Vzťahy:* Patrí Projektu (N:1).

* **WorldEntity (Entity sveta):** Databáza postáv, lokalít, zbraní, artefaktov a pojmov.
  * *Atribúty:* `id`, `project_id`, `type` (postava, lokalita, predmet), `name`, `description`, `attributes_json`, `image_url`
  * *Vzťahy:* Patrí Projektu (N:1), M:N väzba s `Chapter` (mentions v texte).

* **TimelineEvent (Udalosť časovej osi):** Bod alebo úsek na časovej osi príbehu.
  * *Atribúty:* `id`, `project_id`, `title`, `description`, `event_date`, `order_index`
  * *Vzťahy:* Patrí Projektu (N:1), voliteľná vazba N:1 na `Chapter`.

* **ResearchItem (Rešeršná položka):** Uložený odkaz, obrázok alebo poznámka k výskumu.
  * *Atribúty:* `id`, `project_id`, `title`, `source_url`, `note`, `category`
  * *Vzťahy:* Patrí Projektu (N:1).

## Vzťahy medzi entitami
* **User 1 : N Project:** Jeden používateľ môže mať vytvorených viacero knižných projektov.
* **Project 1 : N Chapter:** Jeden projekt obsahuje viacero kapitol/scén usporiadaných podľa poradia.
* **Project 1 : N WorldEntity:** Jeden projekt má vlastnú databázu postáv, predmetov a lokalít.
* **Project 1 : N TimelineEvent:** Jeden projekt obsahuje viacero udalostí na časovej osi.
* **Project 1 : N ResearchItem:** Jeden projekt má priradených viacero výskumných poznámok a zdrojov.
* **Chapter M : N WorldEntity:** V jednej kapitole môže byť spomenutých viacero entít (postáv/zbraní) a jedna entita sa môže vyskytovať v mnohých kapitolách.

## Hlavné stránky aplikácie
1. **Prehľad projektov:** Úvodná obrazovka po prihlásení zobrazujúca zoznam autorových kníh, posledné rozpracované projekty a rýchle štatistiky (počet slov, rozpracovanosť).
2. **Textový editor:** Hlavná obrazovka na písanie textu so stromovou štruktúrou kapitol vľavo, hlavným textovým editorom a bočným panelom s rýchlym náhľadom podkladov.
3. **Katalóg sveta:** Obrazovka s prehľadom a správa postáv, lokalít a predmetov (napr. typy mečov ako katana, šabľa, rapír) vo forme prehľadných kariet.
4. **Časová os a Osnova:** Vizuálna obrazovka s časovou osou a kanban kartičkami pre plánovanie dejových línií a sekvencií kapitol.
5. **Rešeršné centrum:** Záložka pre správu uložených odkazov, webových výstrižkov, obrázkov a študijných poznámok priradených k projektu.

## Rozdelenie funkcionality

### Základné funkcie (MVP - Minimum Viable Product)
* Registrácia a prihlasovanie používateľov.
* Vytváranie, úprava a mazanie knižných projektov.
* Textový editor pre kapitoly s prehľadným stromom dokumentov (Drag & Drop zmena poradia).
* Základný spravovateľ kariet postáv, lokalít a predmetov.
* Integrovaný vyhľadávací panel naprieč projektom.
* Export rukopisu do TXT / DOCX / Markdown.

### Rozširujúce funkcie
* Interaktívna časová os príbehu s viacerými dejovými líniami.
* Automatické tagovanie/mentions postáv v texte s pop-up náhľadom karty.
* Integrovaný mini-prehliadač/ukladač webových výstrižkov do rešeršného centra.
* Štatistiky písania (denný cieľ slov, grafy produktivity).
* Tmavý režim (Dark Mode) a Focus Mode pre nerušené písanie.