<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller {

    /**
     * Update the meta data (alt/title) of an image in multiUpload
     *
     * @param request
     * @param model_name
     * @param model_id
     * @param id
     *
     * @return
     */
    public function postDropzoneUpdateMeta(Request $request, $model_name, $model_id, $id) {
        $model = '\App\Models\\' . $model_name;
        $row = $model::find($model_id);

        $options = [
          $request->type => $request->text,
        ];

        $row->updateMediaById($request->id, $options);

        return response()->json('OK', 200);
    }

}
