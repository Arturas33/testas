<?php
/**
 * Created by PhpStorm.
 * User: Arturas
 * Date: 9/28/2017
 * Time: 11:51 AM
 */

namespace App\Models;


use App\User;

class TPosts extends CoreModel
{
    protected $table = 't_posts';

    protected $fillable = ['id', 'user_id', 'title', 'text', 'path', 'link'];


    //function User(){


    //}
    public $incrementing = false;

    public function User(){
        $this->belongsTo(User::class, 'id');
    }

}