<?php

function garth_load_projects()
{
    static $projects = null;
    if ($projects === null) {
        $file = realpath(dirname(__FILE__) . '/../projects/projects.json');
        $projects = json_decode(file_get_contents($file), true);
    }
    return $projects;
}

function garth_slugify($name)
{
    $slug = str_replace('/', '', $name);
    $slug = strtolower($slug);
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    return trim($slug, '-');
}

function garth_find_by_slug($items, $slug)
{
    foreach ($items as $i => $item) {
        $key = isset($item['name']) ? $item['name'] : $item['title'];
        if (garth_slugify($key) === $slug) {
            return $i;
        }
    }
    return null;
}
