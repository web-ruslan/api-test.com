<?php
// active routes
return array(
    'transaction/(([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6})/([0-9]{1,8}(\.[0-9]{2})?)' => 'transaction/index/$1/$5',
);