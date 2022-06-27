<?php

function getLanguageName(string $code): array
{
    $link = $code??'en';
    switch ($link){
        case $link ==='en':
            $classes = 'flag-icon flag-icon-us';
            $slot = 'English';
            break;
        case $link ==='fr':
            $classes = 'flag-icon flag-icon-fr';
            $slot = 'French';
            break;
        case $link ==='it':
            $classes = 'flag-icon flag-icon-it';
            $slot = 'Italian';
            break;
        case $link ==='es':
            $classes = 'flag-icon flag-icon-es';
            $slot = 'Spanish';
            break;
        case $link ==='de':
            $classes = 'flag-icon flag-icon-de';
            $slot = 'German';
            break;
        case $link ==='pt':
            $classes = 'flag-icon flag-icon-pt';
            $slot = 'Portuguese';
            break;
        case $link ==='zh':
            $classes = 'flag-icon flag-icon-zh';
            $slot = 'Chinese';
            break;
        case $link ==='hi':
            $classes = 'flag-icon flag-icon-hi';
            $slot = 'Hindi';
            break;
        default:
            $classes = 'flag-icon flag-icon-en';
            $slot = 'English';
            break;
    }
    $data["classe"] = $classes;
    $data["name"] = $slot;
    return $data;
}

$data = getLanguageName(\Illuminate\Support\Facades\App::getLocale());

?>
<div>
    <i class="{{$data['classe']}}"></i> {{$data['name']}}
</div>

