<?php

namespace App\Helpers;

use App\Models\Admins;
use App\Models\SystemLogs;

class CustomHelper {

    /**
     * Convert uuid to id by finding record using uuid then get the id
     * @param string $uuid
     * @param Model $model
     * @return collection
     */
    public static function convertUuidToId(string $uuid,$model) {

        $collection = $model::where('uuid',$uuid)->first();

        return $collection->id;
    }

    /**
     * Create system logs
     * @param array $data
     * @return mixed
     */
    public static function createLogMessages(array $data) {
        $arrKeys = [
            'uuid',
            'trigger_uuid',
            'title',
            'description',
            'type',
        ];

        foreach ($arrKeys as $key) {
            if (!array_key_exists($key,$data)) {
                return $key;
            }
        }

        $attributes = [
            'uuid' => $data['uuid'],
            'trigger_uuid' => $data['trigger_uuid'],
            'title' => $data['title'],
            'description' => $data['description'],
            'type' => $data['type'],
        ];

        $create = SystemLogs::create($attributes);

        $create->save();

    }

    /**
     * Upload icon images
     * @param mixed $request
     * @return array
     */
    public static function uploadIconImages(mixed $request) {
        try {

            $file = $request->file('file');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $type = $file->getMimeType();

            $format = $file->extension();

            $fullpath = public_path('img/marker-icons').'/'.$fileName;

            $file->move(public_path('img/marker-icons'), $fileName);

            $data = [
                'status' => 'success',
                'filename' => $fileName,
                'type' => $type,
                'format' => $format,
                'path' => 'img/marker-icons/'.$fileName,
                'fullpath' => $fullpath
            ];

            return $data;

        } catch (\Throwable $th) {

            $data = [
                'status' => 'error',
                'message' => $th->message()
            ];

            return $data;
        }
    }
}
