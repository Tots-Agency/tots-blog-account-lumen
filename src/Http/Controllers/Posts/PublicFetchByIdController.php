<?php

namespace Tots\BlogAccount\Http\Controllers\Posts;

use Tots\Blog\Models\TotsPost;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccount;
use Tots\BlogAccount\Models\TotsPostAccount;

class PublicFetchByIdController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id, Request $request)
    {
        // Get Current Account
        $account = $request->input(TotsAccount::class);
        
        $item = TotsPostAccount::where('post_id', $id)->where('account_id', $account->id)->where('status', TotsPost::STATUS_ACTIVE)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        return $item->post;
    }
}