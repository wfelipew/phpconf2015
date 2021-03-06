<?php
return array(
    'modules' => array(
         'Application',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            __DIR__ . '/../module',
            __DIR__ . '/../vendor',
        ),
        'config_glob_paths' => array(
            __DIR__ . '/../config/autoload/{,*.}{global,local}.php',
        ),
        'config_cache_enabled'=>false,
        'module_map_cache_enabled'=>false,
        'check_dependencies'=>true,
    ),
);
