# Garth Wilson's Project Pages

The HTML and image files for Garth's projects are stored as files in this repository.  The index and the links between them are stored in the `projects.json` file.

## Requirements

- PHP (5.4 through 8.4)
- Python 3
- Wget

On Ubuntu Desktop 24.04 LTS:

```
$ sudo add-apt-repository ppa:ondrej/php
$ sudo apt update
$ sudo apt install git php8.4-cli wget
```

## Development

Clone the repository:

```text
$ git clone https://github.com/6502org/garth.git
Cloning into 'garth'...
remote: Enumerating objects: 123, done.
remote: Counting objects: 100% (123/123), done.
remote: Compressing objects: 100% (111/111), done.
remote: Total 123 (delta 17), reused 116 (delta 10), pack-reused 0 (from 0)
Receiving objects: 100% (123/123), 2.89 MiB | 11.69 MiB/s, done.
Resolving deltas: 100% (17/17), done.
```

Change to that directory and start PHP's built-in webserver:

```
$ cd garth

$ php8.4 -S localhost:8000 local.php
```

Open a browser to http://localhost:8000 to view the site.  PHP is used to build the site navigation (header, footer, and sidebar).  Make changes to a file,
save it, and then reload the page in your browser.  The changes will be reflected immediately.

## Building the Static Site

PHP is only used for development.  It is not intended to be used on the server that hosts the website.  When you have finished development, build a static version of the site and upload those files to the webserver.

To build the static version of the site:

```
$ make
```

The static site will be built into the `build/` directory.  Copy the files from `build/` to the webserver.

