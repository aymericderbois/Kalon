<?php

Router::connect(
    '/blog/:id-:slug',
    '/app/blogs/view',
    array(
        'pass' => array('id', 'slug'),
        'id' => '[0-9]+'
    )
);