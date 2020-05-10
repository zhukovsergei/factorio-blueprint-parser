![Factorio](https://factorio.com/static/img/factorio-logo.png)
# Factorio Bblueprint Parser
A simple parser for [Factorio](https://factorio.com/) blueprints.

### Requirements
* PHP 7.4

### Installation
```
composer require zhukovsergei/factorio-blueprint-parser
```

### Features
* Prase Blueprints
* Parse Books
* Convert to JSON
* Convert to an array

### Example
###### Create parser

```php
$blueprint = '0eNqllNuOgjAQht9lrqmxLejKq2zMhsNomkDbtMVoDO++LbjoKhvAvaIH5vv/mbZzhbxqUBshHaRXEIWSFtLPK1hxlFkV1txFI6QgHNYQgczqMMsx879CG4GQJZ4hpW00GWRUrrQy7iGMtfsIUDrhBPbC3eTyJZs6R+O5QzRWWDgjCnJojMwK9FytrA/0Pryih5E4gkv4BL5XtmFdG1U2hRMnTyW1H1dIeBAOhp/E2BIx+k8x/lqXFxG2SnoVvkrGGPHAOGTWESEtGuc3/iwN825LYXxy3V48wkxmM+ls5uZe2LM2aC1xJpM2JE1yrEYyJ7fE6W84G4Fvn2/lK4x3MPp4VFYjllNn9LHcdzzb9245nM+G0/VkVdZvFoXS5cbZfONsOZ3+0Md4fLIQ794Oen9+uTiSoWdoVY01DH57zHF4y/teLIQODTiCExrbRWz5mu42jPLtpm2/ARxU4FE=';
$bpp = new \App\BlueprintParser($blueprint);
```
###### Check if valid

```php
\App\BlueprintParser::isValid($blueprint); // bool(true)
```

###### Check if book

```php
$bpp->getIsBook(); // bool(false)
```

###### Get the content as an array
```php
$parsed = $bpp->summary()->asArray();
```

```
...array(8) {
  ["electric-furnace"]=>
  int(2)
  ["roboport"]=>
  int(1)
  ["fast-inserter"]=>
  int(2)
  ["express-transport-belt"]=>
  int(5)
  ["beacon"]=>
  int(3)
  ["big-electric-pole"]=>
  int(1)
  ["productivity-module-3"]=>
  int(4)
  ["speed-module-3"]=>
  int(6)
}
```

###### or as JSON

```php
$parsed = $bpp->summary()->asJson();
```

```php
{"electric-furnace":2,"roboport":1,"fast-inserter":2,"express-transport-belt":5,"beacon":3,"big-electric-pole":1,"productivity-module-3":4,"speed-module-3":6}
```

###### Get extra info
Get an array with label and icons.
On single blueprint user can pick the icons, or it will pick automatically.
This is extra icons basically represent the whole recipe.

![Icons and label](https://sun6-13.userapi.com/B1oRZgOu88Djf2n4d3BJNM-RAG3vIJStUTTlLQ/uVp36T0mzco.jpg)

```php
$parsed = $bpp->getBlueprintExtra();
```

```
...array(2) {
  ["icons"]=>
  string(21) "["beacon","roboport"]"
  ["label"]=>
  string(15) "Some label here"
}
```