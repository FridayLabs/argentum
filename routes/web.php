<?php

$app->get('admin{route:.*}', 'AdminController@layout');
