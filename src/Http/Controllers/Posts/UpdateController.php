<?php

namespace Tots\BlogAccount\Http\Controllers\Posts;

use Tots\Blog\Models\TotsPost;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccount;
use Tots\Blog\Http\Controllers\Posts\UpdateController as PostsUpdateController;
use Tots\BlogAccount\Models\TotsPostAccount;

class UpdateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id, Request $request)
    {
        // Get Current Account
        $account = $request->input(TotsAccount::class);

        $itemRel = TotsPostAccount::where('post_id', $id)->where('account_id', $account->id)->first();
        if($itemRel === null) {
            throw new \Exception('Item not exist');
        }
        // Process validations
        $this->validate($request, [
            'title' => 'required|min:3',
        ]);
        // Execute update controller
        $controller = new PostsUpdateController();
        return $controller->handle($id, $request);
    }
}