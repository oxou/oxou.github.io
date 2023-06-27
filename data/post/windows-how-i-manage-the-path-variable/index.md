# Windows - How I manage the PATH variable

Over the years I've struggled with managing the PATH variable in Windows, encountering various issues and limitations due to inconsistencies imposed by the operating system or the application.

In many cases these issues can be buffer overflows or the string is truncated because of the API not being future proof.

Some forums say that the environment variable has a limit of 256, 260 or even up to 32,768. But let's not steer away from the topic, now I'll show you how I manage my PATH variable and why you should also do the same.

## Setup

Create a folder which will be used to store files of standalone programs and scripts that point to a different location of the installed or extracted program. I'm gonna create the folder at the root of the C: drive and call it `env` (abbreviation for environment).

Programs that contain multiple files and folder should be kept inside `C:\env\bin` under its folder.

In order to achieve argument redirection from a script to a program, instead of using a Batch script we will use a program from [131](https://github.com/131) called [dispatcher](https://github.com/131/dispatcher) which we'll use to "dispatch" the arguments.

The reason we use this program is to avoid Command Prompt annoyances like having to press Ctrl+C multiple times to abort execution of a script or program which was initiated through the Batch script.

## Adding a program

I'll add the cross-compiled version of [GNU nano](https://www.nano-editor.org/) to `C:\env\bin\nano` where the actual path of nano is at `C:\env\bin\nano\usr\bin\nano.exe`.

This confusing path will not occur for every program, because GNU nano was/is initially written for the Unix family of operating systems so it carries over the folder structure from those systems.

Now we extract/copy `disaptcher_cmd_x64.exe` to `C:\env` and rename it to `nano.exe`.

Alongside it we create a file that reflects the name of our executable like `nano.config` with the following contents:

```xml
<?xml version="1.0" encoding="utf-8" ?>
<configuration>
  <appSettings>
    <add key="PATH" value="bin\nano\usr\bin\nano.exe"/>
  </appSettings>
</configuration>
```

## Modifying the PATH variable

We are still unable to run `nano` directly from the Command Prompt without explicitly writing out the path of the dispatcher executable `C:\env\nano.exe`, which we don't wanna do each time we'd like to use `nano`.

Run `SystemPropertiesAdvanced.exe` or `sysdm.cpl` and navigate to the `Advanced` tab and click `Environment Variables...` (Alt+N) and add the user variable `PATH` with the value `C:\env`.

Start a new instance of Command Prompt and run `nano`:

![](~/0.png)
