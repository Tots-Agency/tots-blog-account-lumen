<?php

namespace Tots\BlogAccount\Models;

use Illuminate\Database\Eloquent\Model;
use Tots\Account\Models\TotsAccount;
use Tots\Blog\Models\TotsPost;

/**
 * Description of Model
 * @property int $id ID of item
 * @property mixed $post_id Description for variable
 * @property mixed $account_id Description for variable

 *
 * @OA\Schema()
 * @OA\Property(
 *  property="id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="post_id",
 *  type="integer",
 *  description=""
 * )
 * @OA\Property(
 *  property="account_id",
 *  type="integer",
 *  description=""
 * )

 *
 * @author matiascamiletti
 */
class TotsPostAccount extends Model
{
    protected $table = 'tots_post_account';
    
    //protected $casts = ['data' => 'array'];
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function account()
    {
        return $this->belongsTo(TotsAccount::class, 'account_id');
    }
    /**
    * 
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function post()
    {
        return $this->belongsTo(TotsPost::class, 'post_id');
    }


    
}