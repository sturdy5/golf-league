# Players

Data on the players of the league. All player information is sourced from the list of active and inactive players setup as part of the Bogey Club Thursday Night Golf League (bctngl). Feel free to [open a ticket](https://github.com/jsturdevant/golf-league/issues) with any bugs or suggestions.

## Methods

All requests require a valid API key, and use the base URL:

```
http://bctngl.com/api/v1
```

### /players

Search and filter for players of the league. 

By default, all requests will return __active players__, but you can override this by supplying `all_players=true`.

## Fields

All fields can be used in searches using the standard rules defined [here](../index.md#parameters).

```javascript
{
  "players" [{
    "id": 37,
    "first_name": "Player",
    "last_name": "Testing",
    "full_time": true,
    "active": true,
    "handicap": 15,
    "team_id": 4
  }]
}
```

__id__

The unique identifier for the player.

__first_name__

The first name of the player.

__last_name__

The last name of the player.

__full_time__

Whether the player is currently setup as a full-time member of the league.


> Written with [StackEdit](https://stackedit.io/).