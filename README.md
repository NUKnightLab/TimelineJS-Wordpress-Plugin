ROMAINE: A social tool for selecting courses.

Uses Northwestern University's course API. Produced during Knight Lab student fellowship by Suyeon Son, Nicole Zhu and Ashley Wu.

getdata.js pulls in `var param` from a separate file that contains private API keys. The separate file should be formatted as follows:

```
var params = {
  key: YOUR_KEY_here
};
```