# Introduction

A JSON API is available for use to work with the data within the Bogey Club Thursday Night Golf League (bctngl) web site - http://bctngl.com

In order to work with the API, you must have authorization to do so. The authorization is granted when you request a developer account. With your account, an API key will be generated that can be used in the calls. The process to get a developer account is currently manual.

Report bugs and request features on [GitHub Issues](https://github.com/jsturdevant/golf-league/issues).

# Using the API

URL:
```
http://bctngl.com/api/v1/[method]
```

Encryption (`https://`) is not used by default but will be added later. All information that gets sent to the API and returned can be seen on the network. Encryption may be added at a later time. At which point, all API keys will be revoked and new keys will be issued.

## Methods

Path | Description
---- | -----------
[`/players`](./methods/players.md) | Current players names and IDs
`/schedule` | Scheduled game dates

## Parameters

### API Key

All requests to the bctngl API require a developers API key. API keys can be provided with a request through the query string:

```
/players?apiKey=[your_api_key]
```

Or, by setting the key as the value of an `X-APIKEY` HTTP request header.

### Filtering

You can filter on many fields with a simple key/value pair:

```
/players?last_name=Smith
```

```
/schedule?date=2014-07-15
```

The API will automatically treat numbers as numbers, and "true" and "false" as booleans. Dates should be in the format `yyyy-mm-dd`.

To force the API to treat a value as a string, use quotes:

```
/players?player_id="432"
```

See the documentation for the specific methods to see what fields can be filtered on.

### Operators

The API supports 8 operators that can be combined with filters

* __gt__ - the field is greater than this value
* __gte__ - the field is greater than or equal to this value
* __lt__ - the field is less than this value
* __lte__ - the field is less than or equal to this value
* __not__ - the field is not this value
* __all__ - the field is an array that contains all of these values (separated by `|`)
* __in__ - the field is a string that is one of these values (separated by `|`)
* __nin__ - the field is a string that is _not_ one of these values (separated by `|`)
* __exists__ - the field is both present and non-null (supploy `true` or `false`)

All operators are applied by adding two underscores (`__`) after the field name. They cannot be combined.

__All games scheduled after 2014-01-01__

```
/schedule?date__gt=2014-01-01
```

### Pagination

All results in the bctngl API are paginated. Set `per_page` and `page` to control the page size and offset. The maximum `per_page` is 50.

```
/players?per_page=50&page=3
```

At the top-level of every response are __count__ and __page__ fields, with pagination information.

```json
"count": 163,
"page": {
  "per_page": 50,
  "page": 3,
  "count": 50
}
```

__count__
The total number of results that match the query.

__page.per_page__
The `per_page` value used to find the response. Defaults to 20.

__page.page__
The `page` value used to find the response. Defaults to 1.

__page.count__
The number of actual results in the response. Can be less than the given `per_page` if there are too few results.

> Written with [StackEdit](https://stackedit.io/).