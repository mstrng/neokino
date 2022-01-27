<?php
function get_protocol() :string {
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        return "https://";
    else
        return "http://";
}

/* Pass either 'http://' or 'https://' asc parameter*/

function base_url(string $protocol = 'http://') {
    // Append the host(domain name, ip) to the URL.
    $url = $protocol . $_SERVER['HTTP_HOST'];
    return $url . '/';
}

function parent_url(string $protocol = 'http://') : string {
    // Append the host(domain name, ip) to the URL.
    $url = $protocol . $_SERVER['HTTP_HOST'];
    // Append the requested resource location to the URL
    $url .= $_SERVER['REQUEST_URI'];
    // If URL is already the base
    if (base_url($protocol) === $url)
        return $url;
    return dirname($url);
}

