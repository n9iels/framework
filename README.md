# Rest API voor Project 4
Dit is een simpele Rest API gemaakt met Slim framework. De volgende data is beschikbaar:
- Fietstrommels in Rotterdam (**Let op:** straatnamen zijn correct zonder afkorting)

## Gebruik
De api is als volg te gebruiken

### Fietstrommels
Ophalen van alle fietstrommels
```
/fietstrommels
```
Ophalen van fietstrommels in een deelgemeente
```
/fietstrommels/:deelgemeente
```
Ophalen van een specifieke fietstrommel in een deelgemeente
```
/fietstrommels/:deelgemeente/:id
```
