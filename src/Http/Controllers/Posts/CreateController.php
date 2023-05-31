<?php

namespace Tots\BlogAccount\Http\Controllers\Posts;

use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccount;
use Illuminate\Validation\Rule;
use Tots\Blog\Http\Controllers\Posts\CreateController as PostsCreateController;
use Tots\BlogAccount\Models\TotsPostAccount;

class CreateController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Get Current Account
        $account = $request->input(TotsAccount::class);
        // Process validations
        $this->validate($request, [
            'title' => 'required|min:3',
        ]);
        // Create Post
        $controller = new PostsCreateController();
        $post = $controller->handle($request);
        // Add post in account
        $rel = new TotsPostAccount();
        $rel->post_id = $post->id;
        $rel->account_id = $account->id;
        $rel->save();
        // Return data
        return $post;
    }
}