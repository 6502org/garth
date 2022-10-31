# Garth Wilson's Project Pages

The HTML and image files for Garth's projects are stored as files this repository.  The index and the links between them are stored in the SQLite3 database file `database.sqlite3`.

You can run the website locally on a Unix-like machine (e.g. Linux, macOS) with PHP 5.4 or later.  The `pdo_sqlite` extension must also be installed.

On Ubuntu 18.04 LTS, this will install the requirements:

```
$ sudo apt-install -y php7.2-cli php7.2-sqlite3
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

$ php -S localhost:8000
[Sun Oct 30 19:42:27 2022] PHP 7.4.32 Development Server (http://localhost:8000) started
PHP 7.3.29 Development Server started at Sun Oct 30 21:54:44 2022
Listening on http://127.0.0.1:8000
```

Open a browser to http://localhost:8000 to view the site.
