# Linux - Install locate

Homepage: https://savannah.gnu.org/projects/findutils/

Description: maintain and query an index of a directory tree updatedb generates an index of files and directories. GNU locate can be used to quickly query this index.

## Installation

```
sudo apt install locate -y
```

## Configuring

```
sudo updatedb
```

## Usage example

```
$ locate puma.rb
/home/user/gdk/gitlab/config/initializers/validate_puma.rb
/home/user/gdk/gitlab/config/puma.rb
/home/user/gdk/gitlab/config/puma.rb.example
/home/user/gdk/support/templates/gitlab/config/puma.rb.erb
/home/user/gems/gems/excon-0.99.0/lib/excon/test/plugin/server/puma.rb
/home/user/gems/gems/letter_opener_web-2.0.0/spec/dummy/config/puma.rb
/home/user/gems/gems/puma-6.3.0/lib/puma.rb
/home/user/gems/gems/puma-6.3.0/lib/rack/handler/puma.rb
/home/user/gems/gems/railties-7.0.6/lib/rails/generators/rails/app/templates/config/puma.rb.tt
```
