# php-config
## Simple PHP Config Manager by Environment

I couldn't find a simple option similar to the config module for npm, so I built this quick no dependency class that does the trick.

**Require It**
```
require_once('src/Config.php');
```

**Use It**
```
$config = (new Config())->getConfig();
```

By default it will look for a folder called `config` in the same directory it's required in, but you can override it with an option.

**Override configs path**
```
$config = (new Config(array('config_dir' => '/some/path/config')))->getConfig();
```

## How does one create config files?
This class uses php ini files, so create the following in your `config` directory...

**default.ini** - This file should always exist and will be the default configs for your app
```
[section]
my=vars
go=here

[some_other_section]
more=vars
foo=bar
```

**{{PHP_ENV}}.ini** - The name of this file should match the environment variable called `PHP_ENV`
(*ex: `PHP_ENV=staging` - `staging.ini` should be the filename*)
```
[section]
my=override
go=there

[staging_only_section]
non_default=value
```
*By default this library will look for the PHP_ENV environment variable, however, if you'd like to set the environment another way you can do the following:*
```
$config = (new Config(array('environment' => 'staging')))->getConfig();
```

Currently this library is very minimal and only works with 2 config files per environment. The default file and the environment specific overrides. Each of those files will be parsed and merged together and environment configs will take priority over default values.

Check out the examples folder in this repo for example files.
