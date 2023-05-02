# Unsafe Code in PHP

Indefinite list of unsafe methods in PHP, some may not be related to Core PHP.  
  
More clarifications may be added in future regarding some of these methods.

## Sources

First and foremost I want to thank all the people that contributed to the following sources, without them this page and the knowledge it provides would not exist.

- [(gist.github.com) - Dangerous PHP Functions](https://gist.github.com/mccabe615/b0907514d34b2de088c4996933ea1720)
- [(stackoverflow.com) - Exploitable PHP functions](https://stackoverflow.com/questions/3115559/exploitable-php-functions)
- [(seclists.org) - A Study In Scarlet](https://seclists.org/bugtraq/2001/Jul/att-26/studyinscarlet.txt)
- [(codementor.io) - PHP Functions Makes Your Site Vulnerable](https://www.codementor.io/@hayeskier/172bxpju01)
- [(owasp.org) - XML External Entity (XXE) Processing](https://owasp.org/www-community/vulnerabilities/XML_External_Entity_%28XXE%29_Processing)

## Command Execution

- [exec](https://www.php.net/manual/en/function.exec.php)
- [passthru](https://www.php.net/manual/en/function.passthru.php)
- [system](https://www.php.net/manual/en/function.system.php)
- [shell&#95;exec](https://www.php.net/manual/en/function.shell-exec.php)
- [backtick operator `&#96;`](https://www.php.net/manual/en/language.operators.execution.php)
- [popen](https://www.php.net/manual/en/function.popen.php)
- [proc&#95;open](https://www.php.net/manual/en/function.proc-open.php)
- [pcntl&#95;exec](https://www.php.net/manual/en/function.pcntl-exec.php)

## PHP Code Execution

- [eval](https://www.php.net/manual/en/function.eval.php)
- [assert](https://www.php.net/manual/en/function.assert.php)
- [preg&#95;replace (with `/e` modifier)](https://www.php.net/manual/en/function.preg-replace.php)
- [create&#95;function](https://www.php.net/manual/en/function.create-function.php)
- [include](https://www.php.net/manual/en/function.include.php)
- [include&#95;once](https://www.php.net/manual/en/function.include-once.php)
- [require](https://www.php.net/manual/en/function.require.php)
- [require&#95;once](https://www.php.net/manual/en/function.require-once.php)
- `$&#95;GET&#91;'func&#95;name'&#93;&#40;$&#95;GET&#91;'argument'&#93;&#41;;`
- [ReflectionFunction](https://www.php.net/manual/en/class.reflectionfunction.php)

## List of functions which accept callbacks

These functions accept a string parameter which could be used to call a function of the attacker's choice. Depending on the function the attacker may or may not have the ability to pass a parameter. In that case an Information Disclosure function like phpinfo() could be used.

- [ob&#95;start](https://www.php.net/manual/en/function.ob-start.php)
- [array&#95;diff&#95;uassoc](https://www.php.net/manual/en/function.array-diff-uassoc.php)
- [array&#95;diff&#95;ukey](https://www.php.net/manual/en/function.array-diff-ukey.php)
- [array&#95;filter](https://www.php.net/manual/en/function.array-filter.php)
- [array&#95;intersect&#95;uassoc](https://www.php.net/manual/en/function.array-intersect-uassoc.php)
- [array&#95;intersect&#95;ukey](https://www.php.net/manual/en/function.array-intersect-ukey.php)
- [array&#95;map](https://www.php.net/manual/en/function.array-map.php)
- [array&#95;reduce](https://www.php.net/manual/en/function.array-reduce.php)
- [array&#95;udiff&#95;assoc](https://www.php.net/manual/en/function.array-udiff-assoc.php)
- [array&#95;udiff&#95;uassoc](https://www.php.net/manual/en/function.array-diff-uassoc.php)
- [array&#95;udiff](https://www.php.net/manual/en/function.array-udiff.php)
- [array&#95;uintersect&#95;assoc](https://www.php.net/manual/en/function.array-uintersect-assoc.php)
- [array&#95;uintersect&#95;uassoc](https://www.php.net/manual/en/function.array-unitersect-uassoc.php)
- [array&#95;uintersect](https://www.php.net/manual/en/function.array-uintersect.php)
- [array&#95;walk&#95;recursive](https://www.php.net/manual/en/function.array-walk-recursive.php)
- [array&#95;walk](https://www.php.net/manual/en/function.array-walk.php)
- [assert&#95;options](https://www.php.net/manual/en/function.assert-options.php)
- [uasort](https://www.php.net/manual/en/function.uasort.php)
- [uksort](https://www.php.net/manual/en/function.uksort.php)
- [usort](https://www.php.net/manual/en/function.usort.php)
- [preg&#95;replace&#95;callback](https://www.php.net/manual/en/function.preg-replace-callback.php)
- [spl&#95;autoload&#95;register](https://www.php.net/manual/en/function.spl-autoload-register.php)
- [iterator&#95;apply](https://www.php.net/manual/en/function.iterator-apply.php)
- [call&#95;user&#95;func](https://www.php.net/manual/en/function.call-user-func.php)
- [call&#95;user&#95;func&#95;array](https://www.php.net/manual/en/function.call-user-func-array.php)
- [register&#95;shutdown&#95;function](https://www.php.net/manual/en/function.register-shutdown-function.php)
- [register&#95;tick&#95;function](https://www.php.net/manual/en/function.register-tick-function.php)
- [set&#95;error&#95;handler](https://www.php.net/manual/en/function.set-error-handler.php)
- [set&#95;exception&#95;handler](https://www.php.net/manual/en/function.set-exception-handler.php)
- [session&#95;set&#95;save&#95;handler](https://www.php.net/manual/en/function.session-set-save-handler.php)
- [sqlite&#95;create&#95;aggregate](https://www.php.net/manual/en/function.sqlite-create-aggregate.php)
- [sqlite&#95;create&#95;function](https://www.php.net/manual/en/function.sqlite-create-function.php)


## WordPress related

- [maybe&#95;unserialize](https://developer.wordpress.org/reference/functions/maybe_unserialize/)
- [esc&#95;sql](https://developer.wordpress.org/reference/functions/esc_sql/)
- [is&#95;admin](https://developer.wordpress.org/reference/functions/is_admin/)
- [wpdb::query](https://developer.wordpress.org/reference/classes/wpdb/query/)
