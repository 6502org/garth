# Garth Wilson's Project Pages

The HTML and image files for Garth's projects are stored as files this repository.  The index and the links between them are stored in the SQLite3 database file `database.sqlite3`.

You can run the website locally on a Unix-like machine (e.g. Linux, macOS) with PHP 5.4 through 8.4.  The `pdo_sqlite` extension must also be installed.

On Ubuntu Desktop 24.04 LTS, these commands will install the requirements:

```
$ sudo add-apt-repository ppa:ondrej/php

$ sudo apt update

$ sudo apt install git php8.4-cli php8.4-sqlite3
```

Start PHP's built-in webserver from the base of this repository:

```text
$ git clone https://github.com/6502org/users/garth
Cloning into 'garth'...
remote: Enumerating objects: 112, done.
remote: Counting objects: 100% (112/112), done.
remote: Compressing objects: 100% (102/102), done.
remote: Total 112 (delta 11), reused 109 (delta 8), pack-reused 0
Receiving objects: 100% (112/112), 2.88 MiB | 5.86 MiB/s, done.
Resolving deltas: 100% (11/11), done.

$ cd garth/

$ php8.4 -S localhost:8000
[Wed Mar 11 22:51:20 2026] PHP 8.4.11 Development Server (http://localhost:8000) started
```

Open a browser to http://localhost:8000 to view the site.
