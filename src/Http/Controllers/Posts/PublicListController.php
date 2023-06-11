<?php

namespace Tots\BlogAccount\Http\Controllers\Posts;

use Tots\Blog\Models\TotsPost;
use Illuminate\Http\Request;
use Tots\Account\Models\TotsAccount;

class PublicListController extends \Laravel\Lumen\Routing\Controller
{
    public function handle(Request $request)
    {
        // Get Current Account
        $account = $request->input(TotsAccount::class);
        // Create query
        $elofilter = \Tots\EloFilter\Query::run(TotsPost::class, $request);
        // Custom filters
        $elofilter->getQueryRequest()->addJoin('tots_post_account', 'tots_post_account.post_id', 'tots_post.id');
        $elofilter->getQueryRequest()->addWhere('tots_post_account.account_id', $account->id);
        $elofilter->getQueryRequest()->addWhere('tots_post.is_archived', 0);
        $elofilter->getQueryRequest()->addWhere('tots_post.status', TotsPost::STATUS_ACTIVE);
        $elofilter->getQueryRequest()->addWhere('tots_post.visibility', TotsPost::VISIBILITY_PUBLIC);
        // Execute query
        return $elofilter->execute();
    }
}