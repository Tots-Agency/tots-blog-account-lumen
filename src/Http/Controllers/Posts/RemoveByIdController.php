<?php

namespace Tots\BlogAccount\Http\Controllers\Posts;

use Tots\Blog\Models\TotsPost;
use Illuminate\Http\Request;

class RemoveByIdController extends \Laravel\Lumen\Routing\Controller
{
    public function handle($id)
    {
        $item = TotsPost::where('id', $id)->first();
        if($item === null) {
            throw new \Exception('Item not exist');
        }
        $item->delete();
        return ['deletes' => $id];
    }
}