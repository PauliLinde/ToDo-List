<?php
if (php_sapi_name() === 'cli-server') {
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . '/public' . $url['path'];
    if (is_file($file)) {
        return false; // Serve the requested resource as-is.
    }
}

use App\Kernel;

require_once __DIR__.'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

// cd PHP\ToDo-List
//symfony server:start
