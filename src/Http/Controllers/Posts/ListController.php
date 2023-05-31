<?php

namespace Tots\BlogAccount\Http\Controllers\Posts;

use Tots\Blog\Models\TotsPost;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccount;

class ListController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Get Current Account
        $account = $request->input(TotsAccount::class);
        // Create query
        $elofilter = \Tots\EloFilter\Query::run(TotsPost::class, $request);
        // Custom filters
        $elofilter->getQueryRequest()->addJoin('post_account', 'post_account.post_id', 'tots_post.id');
        $elofilter->getQueryRequest()->addWhere('post_account.account_id', $account->id);
        // Execute query
        return $elofilter->execute();
    }
}