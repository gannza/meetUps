<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 8/18/2017
 * Time: 8:46 PM
 */

namespace Meet;
use Illuminate\Database\Eloquent\Model;

class AgendComment extends Model
{
    protected $table='agendcomment';
    protected $fillable=['agender_id','commenter','comments'];
}