<?php

return [

    //Iprofile Points per register user
    'points-per-register-user-checkbox' => [
        'description'  => 'iredeems::common.settings.points-per-register-user-checkbox',
        'view'         => 'checkbox',
        'translatable' => false,
        'default'=>false
    ],
    'points-per-register-user' => [
        'description'  => 'iredeems::common.settings.points-per-register-user',
        'view'         => 'number',
        'translatable' => false,
        'default'=>0
    ],

    //Iquiz Points per finished a Poll
    'points-per-finished-poll-checkbox' => [
        'description'  => 'iredeems::common.settings.points-per-finished-poll-checkbox',
        'view'         => 'checkbox',
        'translatable' => false,
        'default'=>false
    ],
    'points-per-finished-poll' => [
        'description'  => 'iredeems::common.settings.points-per-finished-poll',
        'view'         => 'number',
        'translatable' => false,
        'default'=>0
    ],
    
    //Itrivia Points per finished a Trivia
    'points-per-finished-trivia-checkbox' => [
        'description'  => 'iredeems::common.settings.points-per-finished-trivia-checkbox',
        'view'         => 'checkbox',
        'translatable' => false,
        'default'=>false
    ],
    'points-per-finished-trivia' => [
        'description'  => 'iredeems::common.settings.points-per-finished-trivia',
        'view'         => 'number',
        'translatable' => false,
        'default'=>0
    ],



];
