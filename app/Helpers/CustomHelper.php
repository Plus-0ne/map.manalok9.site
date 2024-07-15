<?php

namespace App\Helpers;

use App\Models\Admins;

class CustomHelper {

    public static function convertUuidToId(string $uuid,$model) {

        $collection = $model::where('uuid',$uuid)->first();

        return $collection->id;
    }

    public static function createLogMessages(string $title,string $message) {

    }
}
