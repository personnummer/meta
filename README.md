# meta
Organization meta

## Implementations

| Package | Pkg Version | Spec Version | Status | Maintainer |
|---|---|---|---|---|
| [C#](https://github.com/personnummer/csharp) | 1.0.2 | 1.0 | [![Build status](https://ci.appveyor.com/api/projects/status/ajkcx0gg8rke8hx2?svg=true)](https://ci.appveyor.com/project/frozzare/csharp/branch/master) | [@Johannestegner](https://github.com/johannestegner)
| [Dart](https://github.com/personnummer/dart) | 2.0.0 | 2.0 | [![Build Status](https://travis-ci.org/personnummer/dart.svg?branch=master)](https://travis-ci.org/personnummer/dart) | [@frozzare](https://github.com/frozzare)
| [Go](https://github.com/personnummer/go) | 1.1.0 | 1.0 | [![Build Status](https://travis-ci.org/personnummer/go.svg?branch=master)](https://travis-ci.org/personnummer/go) | [@frozzare](https://github.com/frozzare)
| [Java](https://github.com/personnummer/java) | 1.0.0 | 1.0  | [![Build Status](https://travis-ci.org/personnummer/java.svg?branch=master)](https://travis-ci.org/personnummer/java) | [@Johannestegner](https://github.com/johannestegner)
| [JavaScript](https://github.com/personnummer/js) | 2.1.1 | 2.1.0  | [![Build Status](https://travis-ci.org/personnummer/js.svg?branch=master)](https://travis-ci.org/personnummer/js) | [@frozzare](https://github.com/frozzare)
| [Kotlin](https://github.com/personnummer/kotlin) | 1.0.0 | 1.0  | [![Build Status](https://travis-ci.org/personnummer/kotlin.svg?branch=master)](https://travis-ci.org/personnummer/kotlin) | [@Johannestegner](https://github.com/johannestegner)
| [PHP](https://github.com/personnummer/php) | 2.1.0 | 2.1.0 | [![Build Status](https://travis-ci.org/personnummer/php.svg?branch=master)](https://travis-ci.org/personnummer/php) | [@rasmusbe](https://github.com/rasmusbe)
| [Python](https://github.com/personnummer/python) | 1.1.0 |  2.0 | [![Build Status](https://travis-ci.org/personnummer/python.svg?branch=master)](https://travis-ci.org/personnummer/python) | [@frozzare](https://github.com/frozzare)/You?
| [Ruby](https://github.com/personnummer/ruby) | 1.0.0 | 1.0  | [![Build Status](https://travis-ci.org/personnummer/ruby.svg?branch=master)](https://travis-ci.org/personnummer/ruby) | [@frozzare](https://github.com/frozzare)/You?
| [Swift](https://github.com/personnummer/swift) | 1.0.0 | 1.0  | [![Build Status](https://travis-ci.org/personnummer/swift.svg?branch=master)](https://travis-ci.org/personnummer/swift) | [@GoranLilja](https://github.com/GoranLilja)

## License Specification

We use the [MIT license](https://opensource.org/licenses/MIT) for all packages and the copyright row should look like this:

```
Copyright (c) START-END - Personnummer and Contributors
```

or when single year:

```
Copyright (c) START - Personnummer and Contributors
```

## Package Specification (v1)

The personnummer package should have a `valid` method that can take both a number and a string as input.

```
personnummer.valid(string)
personnummer.valid(number)
```

## Package Specification (v2)

The personnummer package should have a `valid` method that can take both a number and a string as input.

The second argument should be a optional boolean that exclude coordination number (Samordningsnummer) from validation.

```
personnummer.valid(string, [bool includeCoordinationNumber = true])
personnummer.valid(number, [bool includeCoordinationNumber = true])
```

The package should include a `format` method that can format the input value (string or number) as a short or long personnumer.

The second argument should be a optional boolean and `true` should format the input value as a long personnummer.

```
personnummer.format(number, [bool longFormat = false])
personnummer.format(string, [bool longFormat = false])
```

The package should include a `getAge` method that returns the age from a personnummer. For coordination number (Samordningsnummer) we should remove `60` to get the right age.

The second argument should be a optional boolean that exclude coordination number (Samordningsnummer) from validation.

```
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

```
personnummer.isMale(number|string, [bool includeCoordinationNumber = true])
personnummer.isFemale(number|string, [bool includeCoordinationNumber = true])
```

This methods should throw errors when input value is not a valid personnummer or coordination number.
