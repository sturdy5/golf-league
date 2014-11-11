# Schedule

Data on the schedule of the league. All schedule information is sourced from the schedule setup as part of the Bogey Club Thursday Night Golf League (bctngl). Feel free to [open a ticket](https://github.com/jsturdevant/golf-league/issues) with any bugs or suggestions.

## Methods

All requests require a valid API key, and use the base URL:

```
http://bctngl.com/api/v1
```

### /schedule

Search and filter for scheduled dates of the league. 

By default, all requests will return dates from the __current season__.

## Fields

All fields can be used in searches using the standard rules defined [here](../index.md#parameters).

```javascript
{
  "season": {
    "id": 4,
    "startDate": 2014-06-29,
    "endDate": 2014-11-02,
    "team_structure": "TWO_PERSON"
  },
  "schedule": [{
    "id": 19,
    "date": 2014-08-21,
    "course": "Woodcreek",
    "address": {
      "line1": "301 Club Ridge Rd",
      "line2": "",
      "city": "Elgin",
      "state": "SC",
      "zip": "29045"
    },
    "side": "front",
    "details_exist": false
  }, {
    "id": 20,
    "date": 2014-08-28,
    "course": "WildeWood",
    "address": {
      "line1": "90 Mallet Hill Rd",
      "line2": "",
      "city": "Columbia",
      "state": "SC",
      "zip": 29223
    },
    "side": "back",
    "details_exist": false
  }, {
    \\ repeat
  }]
}
```


> Written with [StackEdit](https://stackedit.io/).