#!/usr/bin/env python3
"""Build a static version of the site by mirroring the PHP dev server.

Usage:
    python3 build.py [-p PORT] [-o OUTPUT_DIR]

Options:
    -p, --port PORT       PHP server port (default: auto)
    -o, --output DIR      Output directory (default: build)

The output directory must already exist and be empty.
"""

import argparse
import os
import signal
import socket
import subprocess
import sys
import time


def parse_args():
    parser = argparse.ArgumentParser(
        description=__doc__,
        formatter_class=argparse.RawDescriptionHelpFormatter,
    )
    parser.add_argument("-p", "--port", type=int, default=0, help="PHP server port (default: auto)")
    parser.add_argument("-o", "--output", default="build", help="Output directory (default: build)")
    return parser.parse_args()


def validate_output_dir(path):
    if not os.path.isdir(path):
        sys.exit(f"Error: output directory '{path}' does not exist.")
    if os.listdir(path):
        sys.exit(f"Error: output directory '{path}' is not empty.")


def find_available_port():
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.bind(("localhost", 0))
        return s.getsockname()[1]


def start_php_server(port):
    server = subprocess.Popen(
        ["php", "-S", f"localhost:{port}", "local.php"],
        stdout=subprocess.DEVNULL,
        stderr=subprocess.DEVNULL,
    )
    for _ in range(300):
        try:
            with socket.create_connection(("localhost", port), timeout=0.1):
                return server
        except OSError:
            time.sleep(0.1)
    sys.exit("Error: PHP server failed to start.")


def mirror_site(port, output_dir):
    result = subprocess.run(
        [
            "wget", "--mirror",
            "--convert-links",
            "--adjust-extension",
            "--page-requisites",
            "--no-host-directories",
            "-e", "robots=off",
            "--directory-prefix", output_dir,
            f"http://localhost:{port}/",
        ],
    )
    # Exit code 8 is expected: wget reports it for external links it cannot mirror
    if result.returncode not in (0, 8):
        sys.exit(f"Error: wget failed with exit code {result.returncode}.")


def verify_build(output_dir):
    index = os.path.join(output_dir, "index.html")
    if not os.path.isfile(index) or "project-grid" not in open(index).read():
        sys.exit("Error: build failed, index.html is missing or incomplete.")


def main():
    args = parse_args()
    validate_output_dir(args.output)

    port = args.port or find_available_port()
    server = start_php_server(port)
    try:
        mirror_site(port, args.output)
    finally:
        server.send_signal(signal.SIGTERM)
        server.wait()

    verify_build(args.output)
    print(f"Static site built in {args.output}/")


if __name__ == "__main__":
    main()
