<?php

return array(
    'verify-email\?username=([a-z0-9_-]{2,17})&code=([a-z0-9_-]+)' => 'frontPage/register',
    'edit-profile' => 'editPage/edit',
    'main' => 'mainPage/content',
    '' => 'frontPage/index' // actionIndex в FrontPageController
);