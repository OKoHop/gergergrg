<?php

return[
  'main' =>['route' => '/', 'middlewares' =>['keywordsMw', 'mainPageMw'],],
  'post' =>['route' => '/p/{keyword}', 'middlewares' =>['keywordsMw', 'mainPageMw'],],
];
