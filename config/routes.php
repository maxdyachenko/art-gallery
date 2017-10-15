<?php

return array(
    'verify-email\?username=([a-z0-9_-]{2,17})&code=([a-z0-9_-]+)' => 'frontPage/register',

    'edit-profile' => 'editPage/edit',

//    'upload-image' => 'mainPage/imageUpload',
//    'main/([0-9]+)' => 'mainPage/content/$1',
//    'main' => 'mainPage/content',

//    'delete' => 'mainPage/delete',

    'exit' => 'exit/exit',

    'gallery/([a-zA-Z0-9]+)/([0-9]+)' => 'galleryPage/index/$1/$2',
    'gallery/([a-zA-Z0-9]+)' => 'galleryPage/index/$1',
    'upload-image/([a-zA-Z0-9]+)' => 'galleryPage/imageUpload/$1',
    'delete' => 'galleryPage/delete',
    'remove-all-images/([a-zA-Z0-9]+)' => 'galleryPage/deleteAll/$1',

    'create-gallery-form' => 'createGalleryPage/createGallery',
    'create-gallery' => 'createGalleryPage/index',
    'gallery-list' => 'galleryListPage/index',

    'activate-email' => 'activatePage/activateEmail',

    'auth' => 'frontPage/auth',

    'register' => 'frontPage/registerPrimary',

    '' => 'frontPage/index'
);