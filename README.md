# Overheid.io KVK api
In deze library maken we gebruik van de Overheid.io API om verschillende gegevens over de KVT database op te halen,
Voor deze library heb ik een tutorial en framework-template gebruikt van **Darwin Biler** te vinden op http://www.darwinbiler.com/creating-composer-package-library/

De API te vinden op https://api.overheid.io heeft verschillende end points waar ik gebruik van maak in deze Library.
```
GET	./openkvk
GET	./openkvk/{id}
GET	./suggest/openkvk/{query}
```
Deze endpoints hebben ieder een Controller gekregen waarop ze te benaderen zijn.
```
KVKIDController.php       (GET	./openkvk/{id})
QueryController.php       (GET	./openkvk)v
SuggetsController.php     (GET	./suggest/openkvk/{query})
```
## QueryController
Deze contoller wordt gebruikt om een overzicht van verschillende KVK geregistreerde bedrijven op te halen, hiervoor zijn een aantal verschillende methods nodig,

`$controller->set_api_key("174146f00f414a6b83ed9e750d66203070c0b80355dc34f0235e24d44db2b22e");`
Deze method slaat de API Key op in de Class variables waardoor deze later natuurlijk weer opgehaald kan worden.

`$controller->add_query_item("plaats", "Eindhoven");` Deze method stelt een query item in, de eerste variabale is de naam van het field en de tweede de waarde, de field namen kunnen een van de onderstaande waardes zijn, deze functie kan meerdere keren per request gedaan worden maar kan geen dubbele fields bevatten.

`$result = $controller->connect();` Deze method maakt de connectie en returned een PHP oject waarvan het resultaat te vinden wordt in "fullresult.md"


### mogelijke fields
* btw
* lei
* rsin
* actief
* bestaandehandelsnaam
* dissiernummer
* handelsnaam
* huisnummer
* pand_id
* plaats
* postcoce
* straat
* subdossiernummer
* type
* vbo_id
* vestigingsnummer

## KVK ID Controller
 Deze controller is bedoeld om van een bedrijf zijn specifieke pagina op te kunnen halen, hiermee kan je meer informatie ophalen dan dat via de Query Contoller mogelijk is, maar deze informatie kan wel maar met 1 bedrijf tegelijkertijd.
 
 `$controller2->set_api_key("174146f00f414a6b83ed9e750d66203070c0b80355dc34f0235e24d44db2b22e");`
Deze method slaat de API Key op in de Class variables waardoor deze later natuurlijk weer opgehaald kan worden.

`$controller2->set_id($_GET['ID']);` Deze method stelt het bedrijf specifieke ID in. deze id's zien er al volgt uit, `hoofdvestiging-24279396-0000-pyton-communication-services-bv` 

`$controller2->connect();` Exact het zelfde als in de Query Controller class maar dan met een output zoals te vinden is in "CompanyResult.md"

## Suggest Controller
 Deze contoller resulteert in een aantal resultaten vergelijkbaar met een input string, handig voor input velden met een autocomplete.
 
`$controller3->set_api_key("174146f00f414a6b83ed9e750d66203070c0b80355dc34f0235e24d44db2b22e");` slaat de API op

`$controller3->set_query_string("Auto%20onderhoud");` Deze string wordt gebruikt om de zoekopdracht van de gebruiket aan te vullen met verschillende resultaten

`$controller3->set_query(5, "handelsnaam");` Deze functie geeft je toegang tot hoeveel resultaten je ontvant `5` en welk type resultaat `handelsnaam` het is alleen mogelijk om gebruikt te maken van 2 opties
* handelsnaam
* dossiernummer

`$controller2->connect();` Exact het zelfde als in de Query Controller class maar dan met een output zoals te vinden is in "SugestResult.md"
