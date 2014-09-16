<?php

class StorageBox extends Eloquent
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'storage_boxes';


    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = [
        'size',
        'active'
    ];


    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Return a box record for the specified user
     * @param $userId
     * @return StorageBox|null
     */
    public static function findMember($userId)
    {
        return self::where('user_id', '=', $userId)->first();
    }


} 