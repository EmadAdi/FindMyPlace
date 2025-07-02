<?php

namespace App\Enums\Enums\Media;

enum PropertyMediaEnum : string
{
    case  MAIN_IMAGE = 'main-image' ;

    case GALLERY = 'gallery';

    public function disk(){
        return match ($this){
            self::MAIN_IMAGE  => 'main_image' ,
            self::GALLERY => 'gallery'
        };
    }
}
