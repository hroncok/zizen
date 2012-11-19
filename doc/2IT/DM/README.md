Database model
==============

Finální databázový model je v souborech relational.svg a .pdf (obsah je identický).

Několik poznámek k modelu:
--------------------------

 * Nad databází bude napsán trigger, který po změně obsahu tabulky `thirst` zajistí aktualizaci obsahu tabulky `thirst_match`
 * Více uživatelů může mít stejný filtr -- po vytvoření bude uživatel mít nastaven jako výchozí filtr filtr základní, který se zkopíruje jako nový při vytváření nové žízně
