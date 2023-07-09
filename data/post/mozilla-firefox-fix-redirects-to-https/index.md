# Mozilla Firefox - Fix Redirects To HTTPS

I encountered an odd bug on Firefox where trying to access a HTTP url will
automatically redirect to HTTPS, this is without any extensions.

The issue is easy to fix, you must go to [`about:preferences#privacy`](about:preferences#privacy)
and navigate to the **History** group box.

Locate the `Clear History...` button, a popup will appear and make the selections as shown below:

![](~/0.png)

Upon clearing everything, open a new tab to the URL and try accessing the HTTP version again by explicing writing the prefix `http://` which should now work.
