<?php

namespace crocodicstudio\crudbooster\Modules\ApiGeneratorModule;

use Illuminate\Support\Facades\DB;

class Repository
{
    public static function incrementHit($serverSecret)
    {
        return self::table()->where('secretkey', $serverSecret)->increment('hit');
    }

    public static function getSecretKeys()
    {
        return self::table()->where('status', 'active')->pluck('Secretkey');
    }

    public static function get()
    {
        return self::table()->get();
    }

    public static function deleteById($id)
    {
        return self::table()->where('id', $id)->delete();
    }

    public static function updateById($status, $id)
    {
        return self::table()->where('id', $id)->update(['status' => $status]);
    }

    public static function insertGetId($token)
    {
        return self::table()->insertGetId([
            'secretkey' => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => 'active',
            'hit' => 0,
        ]);
    }

    private static function table()
    {
        return DB::table('cms_apikey');
    }
}