# meta
Organization meta.Find all implementations on [personnummer.dev](https://personnummer.dev).

## Package meta

Every package should have `.meta.yaml` file containing information about the name, maintainer, specification version and which workflow file to show the build badge from. The values of the meta file will be used for the implementations table on [personnummer.dev](https://personnummer.dev)

Example of `.meta.yaml`

```yaml
name: "JavaScript"
maintainer: "@frozzare"
spec: 3.1
workflow: "nodejs.yml"
```

## License Specification

We use the [MIT license](https://opensource.org/licenses/MIT) for all packages and the copyright row should look like this:

```
Copyright (c) Personnummer and Contributors
```

## Package Specification (v1)

The personnummer package should have a `valid` method that can take both a number and a string as input.

```js
personnummer.valid(string)
personnummer.valid(number)
```

## Package Specification (v2)

The personnummer package should have a `valid` method that can take both a number and a string as input.

The second argument should be a optional boolean that exclude coordination number (Samordningsnummer) from validation.

```js
personnummer.valid(string, [bool includeCoordinationNumber = true])
personnummer.valid(number, [bool includeCoordinationNumber = true])
```

The package should include a `format` method that can format the input value (string or number) as a short or long personnumer.

The second argument should be a optional boolean and `true` should format the input value as a long personnummer.

```js
personnummer.format(number, [bool longFormat = false])
personnummer.format(string, [bool longFormat = false])
```

The package should include a `getAge` method that returns the age from a personnummer. For coordination number (Samordningsnummer) we should remove `60` to get the right age.

The second argument should be a optional boolean that exclude coordination number (Samordningsnummer) from validation.

```js
personnummer.getAge(number, [bool includeCoordinationNumber = true])
personnummer.getAge(string, [bool includeCoordinationNumber = true])
```

### Input value format

Dash or plus should be optional.

```
YYMMDD-XXXX
YYMMDD+XXXX
YYMMDDXXXX

YYYYMMDD-XXXX
YYYYMMDD+XXXX
YYYYMMDDXXXX
```

Coordination number (Samordningsnummer) should also be a valid personnummer.

### Short format

Output for `format` method

```
YYMMDD-XXXX
```

### Long format

Output for `format` method

```
YYYYMMDDXXXX
```

## Package Specification (v2.1)

This specification adds new features and includes all parts from 2.0.

The package should include `isMale` and `isFemale` methods that can check if the personnummer or coordination number is a female or male.

```js
personnummer.isMale(number|string, [bool includeCoordinationNumber = true])
personnummer.isFemale(number|string, [bool includeCoordinationNumber = true])
```

This methods should throw errors when input value is not a valid personnummer or coordination number.

## Package Specification (v3)

Version 3 will contain breaking changes and will not be compatible with version 1 or 2.

### Breaking changes

These functions will be moved into the class:

* `format`
* `getAge`
* `isFemale`
* `isMale`

### Valid

The `valid` function can be a function or a static method on the class depending on language. The valid version that supports number arguments will be removed.

### Class

The package should include a class that which should be the return value of `parse`

```js
class Personnummer {
    public function __construct(string, array|object|languageSpecific)
}
```

### Parse

The package should include a `parse` method that creates a new instance of the new class.

The `parse` and the class constructor should contain a second argument with options for the feature.

```js
personnummer.parse(string, array|object|languageSpecific = []) => new class instance
```

The class should contain a static `parse` method that returns the class instance.

```js
const pnr = Personnummer::parse(string, array|object|languageSpecific = [])
```

### Coordination numbers

The coordination number option will be removed for all methods and be replaced with `isCoordinationNumber` method or property instead.

```js
const pnr = personnummer.parse(string)

if (pnr.isCoordinationNumber()) {
    return
}
```

### Error handling

All methods except for `valid` should throw an exception or return an error as a second return value. Error handling may be different depending on language. The exception/error class should be prefixed with `Personnummer`

### Options

Options may be different depending on language.

### Pseudo-interface

```js
interface Personnummer {
    string century;
    string fullYear;
    string year;
    string month;
    string day;
    string sep;
    string num;
    string check;

    public function __construct(string ssn, array|object|languageSpecific options = []);

    public static function parse(string ssn);

    public function format(boolean longFormat) : string;
    public function getAge() : int;
    public function isFemale() : boolean;
    public function isMale() : boolean;
    public function isCoordinationNumber() : boolean;
}

function valid(string ssn) {
    try {
       parse(ssn)
       return true
    } catch (PersonnummerParseException) {
        return false
    }
}

function parse(string ssn, array|object|languageSpecific options = []) {
    return new Personnummer(ssn, options)
}
```

## Package Specification (v3.1)

This specification adds new features and includes all parts from 3.0.

## Get date

The package should include `getDate` function to expose the underlying date value. For coordination numbers the day should be removed with 60 days to get the correct day for a real date.

## Interim-Number

_Also called T-Number_

The package should support Interim-numbers `YYMMDD-Xnnn` (where X is a letter rather than number) and include `isInterimNumber` function in the same way as `isCoordinationNumber`

The `format` function should respect Interim-number and format the number both in the long and short way with the letter at the first of the four in the 4-digit number.

Read more about interim-number at [KTH](https://www.kth.se/en/student/studier/living-in-sweden/swedish-personal-identification-number/swedish-personal-identification-number-1.443883) and at [sunet](https://wiki.sunet.se/display/SWAMID/Svenska+personnummer%3A+norEduPersonNIN%2C+personalIdentityNumber+och+schacDateOfBirth).

To make the package future-proof, we support all 11 interim letters: `T, R, S, U, W, X, J, K, L, M, N` where all are replaced with a `1` in the luhn calculation.

To not break the package for users whom do not want to make use of the interim-number implementation, the `options` object for the parse function and constructor have been re-added and should have two values:

```json
{
  "allowCoordinationNumber": true,
  "allowInterimNumber": false
}
```

As seen, the coordination-number should be true by default (as it's true by default in the v3.0 api) while the interim-number is false by default (as it does not exist yet and is used a lot more rarely).


### Updated pseudo-interface

```js
interface Personnummer {
    public function getDate() : Date;
    public function isInterimNumber() : boolean;
}
```
