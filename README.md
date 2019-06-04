# meta
Organization meta

## Package Specification (v1)

The personnummer package should have a `valid` method that can take both a number and a string as input.

```
personnummer.valid(string)
personnummer.valid(number)
```

## Package Specification (v2)

The personnummer package should have a `valid` method that can take both a number and a string as input.

```
personnummer.valid(string)
personnummer.valid(number)
```

The package should include a `format` method that can format the input value (string or number) as a short or long personnumer.

The second argument should be a boolean and `true` should format the input value as a long personnummer.

```
personnummer.format(number, boolean)
personnummer.format(string, boolean)
```

The package should include a `getAge` method that returns the age from a personnummer. For coordination number (Samordningsnummer) we should remove `60` to get the right age.

```
personnummer.getAge(number)
personnummer.getAge(string)
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
