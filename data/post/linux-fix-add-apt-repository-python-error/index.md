# Linux - Fix add-apt-repository Python Error

## Note

If the command `add-apt-repository` is not found, install it by running:

```
sudo apt install software-properties-common -y
```

## Error

Trying to run `sudo add-apt-repository ppa:obsproject/obs-studio` results in:

```text
Traceback (most recent call last):
  File "/usr/bin/add-apt-repository", line 362, in <module>
    sys.exit(0 if addaptrepo.main() else 1)
                  ^^^^^^^^^^^^^^^^^
  File "/usr/bin/add-apt-repository", line 345, in main
    shortcut = handler(source, **shortcut_params)
               ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
  File "/usr/lib/python3/dist-packages/softwareproperties/shortcuts.py", line 40, in shortcut_handler
    return handler(shortcut, **kwargs)
           ^^^^^^^^^^^^^^^^^^^^^^^^^^^
  File "/usr/lib/python3/dist-packages/softwareproperties/ppa.py", line 86, in __init__
    if self.lpppa.publish_debug_symbols:
       ^^^^^^^^^^
  File "/usr/lib/python3/dist-packages/softwareproperties/ppa.py", line 126, in lpppa
    self._lpppa = self.lpteam.getPPAByName(name=self.ppaname)
                  ^^^^^^^^^^^
  File "/usr/lib/python3/dist-packages/softwareproperties/ppa.py", line 113, in lpteam
    self._lpteam = self.lp.people(self.teamname)
                   ^^^^^^^^^^^^^^
AttributeError: 'NoneType' object has no attribute 'people'
```

To solve this we must install `python3-launchpadlib` by running:

```
sudo apt install python3-launchpadlib -y
```

after which we are able to use `add-apt-repository` without issues.
