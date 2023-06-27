# Linux - 'sudo echo' Doesn't Work

I encountered this problem in the previous post, where I had to do
```bash
sudo echo something >> /file-requiring-root
```
but that failed.

---

The workaround is to pipe it through `tee` and append to the file that way.

```bash
echo something | sudo tee -a /file-requiring-root
```
