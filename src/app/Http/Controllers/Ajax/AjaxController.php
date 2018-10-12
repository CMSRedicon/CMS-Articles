<?php

namespace Redicon\CMS_Articles\App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Redicon\CMS_Articles\App\Models\Articles;

class AjaxController extends Controller
{

    public function saveArticlesVisibility(Request $request)
    {

        $data = $request->all();

        if (!isset($data['article_id']) || !isset($data['value'])) {
            return response()->json(['message' => 'error'], 500);
        }

        $article = Articles::where('id', $data['article_id'])->get()->first();

        if (empty($article)) {
            return response()->json(['message' => 'error'], 500);
        }

        try {

            DB::beginTransaction();
            $article->is_public = $data['value'];
            $article->save();

        } catch (\PDOException $e) {
            DB::rollback();
            return response()->json(['message' => 'error'], 500);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'error'], 500);
        }

        DB::commit();

        return response()->json(['message' => 'success'], 200);

    }

}
