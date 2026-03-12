.PHONY: default build clean

PYTHON ?= python3
PORT ?= 0  # 0 = auto-select available port
BUILD_DIR ?= build

default: build

clean:
	rm -rf $(BUILD_DIR)/*

build: clean
	mkdir -p $(BUILD_DIR)
	$(PYTHON) build.py -p $(PORT) -o $(BUILD_DIR)
