<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class FileUploadController extends Controller {

  public function upload(Request $request, $model_name, $id, $type) {
    $validator = Validator::make($data = $request->all(), ['file' => 'mimes:doc,docx,xls,xlsx,rtf,odf,osf,ppt,gif,jpg,jpeg,png,pdf']);

    if ($validator->fails()) {
      return response()->json('File type not permitted', 403);
    }

    $model = '\App\Models\\' . $model_name;
    $row = $model::find($id);

    if ($request->hasFile('file')) {
      $file = $row->saveMedia($request->file('file'), $type, 'multiple');
      return response()->json($file);
    }
  }

  public function delete($model_name, $model_id, $id) {
    $model = '\App\Models\\' . $model_name;
    $row = $model::find($model_id);

    $row->deleteMediaById($id);

    return response()->json('OK', 200);
  }

}
