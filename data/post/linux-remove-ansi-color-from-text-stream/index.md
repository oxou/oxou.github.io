# Linux - Remove ANSI Color From Text Stream

## Introduction

To remove ANSI color from a text stream, pipe the STDOUT to this command:

```bash
sed -e 's/\x1b\[[0-9;]*m//g'
```

## Example

```bash
cat ... | sed -e 's/\x1b\[[0-9;]*m//g' | more
```

Before:
![](~/0.png)

After:
![](~/1.png)

## Making life easier

Construct an alias in `.bash_aliases`:

```bash
alias stripansi="sed -e 's/\x1b\[[0-9;]*m//g'"
```

and then do this to achieve the same thing:

```bash
cat ... | stripansi
```

## Additional information about the Regular Expression

- `\x1b` (or `\x1B`) is the escape special character (GNU `sed` does not support alternatives `\e` and `\033`)
- `\[` is the second character of the escape sequence
- `[0-9;]*` is the color value(s) regex
- `m` is the last character of the escape sequence

## Credits

The original post was taken from [here](https://superuser.com/a/380778).
