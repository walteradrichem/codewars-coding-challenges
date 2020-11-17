# Markdown parser

Write a function that takes in Markdown strings and coverts it to HTML code.
Note: For this exercise only heading tags have to be converted

## Example


```
#### Lorem ipsum dolor sit amet, consectetur adipiscing elit"
```

Should give back

```
<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h4>
```

Invalid code like this, must return the original markdown string.

```
######## Lorem ipsum dolor sit amet, consectetur adipiscing elit"
```

Should give back

```
######## Lorem ipsum dolor sit amet, consectetur adipiscing elit"
```
