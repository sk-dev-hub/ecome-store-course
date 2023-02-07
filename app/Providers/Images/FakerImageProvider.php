<?php

namespace App\Providers\Images;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;

class FakerImageProvider extends Base
{
    
    public function addImageFaker($folderName): string
    {

        if (!file_exists(storage_path('images/' . $folderName))){
            Storage::createDirectory('images' . $folderName);
        } 
     
        
        $fileName = new Generator;
        
        $fileName[] = $fileName->file(
                base_path('tests/Fixtures/images/products'),
                storage_path('/app/public/images/' .  $folderName),
                false
        );

        dd('/storage/images/' . $folderName . '/' . $fileName);

        return '/storage/images/' . $folderName . '/' . $fileName ;

    }

}
