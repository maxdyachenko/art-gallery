<?php

return array(
    'verify-email\?username=([a-z0-9_-]{2,17})&code=([a-z0-9_-]+)' => 'frontPage/register',
    'edit-profile' => 'editPage/edit',
    'upload-image' => 'mainPage/imageUpload',
    'main/([0-9]+)' => 'mainPage/content/$1',
    'main' => 'mainPage/content',
    'delete' => 'mainPage/delete',
    'exit' => 'exit/exit',
    'gallery/[A-Za-z0-9_.-]*/([0-9]+)' => 'galleryPage/index/$1/$2',
    'gallery/[A-Za-z0-9_.-]*' => 'galleryPage/index/$1',
    'create-gallery-form' => 'createGalleryPage/createGallery',
    'create-gallery' => 'createGalleryPage/index',
    'gallery-list' => 'galleryListPage/index',
    'activate-email' => 'activatePage/activateEmail',
    'auth' => 'frontPage/auth',
    'register' => 'frontPage/registerPrimary',
    '' => 'frontPage/index' // actionIndex в FrontPageController
);