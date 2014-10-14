ROMAINE: A social tool for selecting courses.

Uses Northwestern University's course API. Produced during the Knight Lab student fellowship by Suyeon Son, Nicole Zhu and Ashley Wu.

getdata.js pulls in `var params` from a separate file that contains private API keys. The separate file should be formatted as follows:

```
var params = {
  key: YOUR_KEY_here
};
```