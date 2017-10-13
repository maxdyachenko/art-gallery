<?php

return array(
    'verify-email\?username=([a-z0-9_-]{2,17})&code=([a-z0-9_-]+)' => 'frontPage/register',
    'edit-profile' => 'editPage/edit',
    'upload-image' => 'mainPage/imageUpload',
    'main/([0-9]+)' => 'mainPage/content/$1',
    'main' => 'mainPage/content',
    'delete' => 'mainPage/delete',
    'exit' => 'exit/exit',
    'activate-email' => 'activatePage/activateEmail',
    'auth' => 'frontPage/auth',
    'register' => 'frontPage/registerPrimary',
    '' => 'frontPage/index' // actionIndex в FrontPageController
);