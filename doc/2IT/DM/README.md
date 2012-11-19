Database model
==============

Finální databázový model je v souborech relational.svg a .pdf (obsah je identický).

Několik poznámek k modelu:
--------------------------

 * Nad databází bude napsán trigger, který po změně obsahu tabulky `thirst` zajistí aktualizaci obsahu tabulky `thirst_match`
 * Více uživatelů může mít stejný filtr -- po vytvoření bude uživatel mít nastaven jako výchozí filtr filtr základní, který se zkopíruje jako nový při vytváření nové žízně
 * Hospoda má přiřazeného uživatele, z toho vyplývá, že pokud dva uživatelé budou mít stejnou oblíbenou hospodu, bude v databázi více záznamů s hospodou. Umožní to každému uživateli kdykoli změnit název hospody, nebo její pozici, aniž by poškodil ostatní uživatele.

Vysvětlení jednotlivých sloupců [zde v tabulce](https://docs.google.com/spreadsheet/ccc?key=0AnwQpjM-HUxcdEFhd1Y0Mk1NcVpLVHR0UUVMMElNTnc) pro finální PDF.
