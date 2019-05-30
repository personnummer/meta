# meta
Organization meta

## Package Specification

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

```
YYMMDD-XXXX
```

### Long format

```
YYYYMMDDXXXX
```
