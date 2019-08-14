<?php


namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use TCG\Voyager\Events\BreadDataAdded;
use \TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Facades\Voyager;


class MentionController  extends VoyagerBaseController {

    public function store(Request $request)
    {
        $request->merge(['by' => auth()->id()]);
//        dd($request->by);
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        $this->authorize('add', app($dataType->model_name));
        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows);
        if ($val->fails()) {
            return response()->json(['errors' => $val->messages()]);
        }
        if (!$request->has('_validate')) {
            $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());
            event(new BreadDataAdded($dataType, $data));
            if ($request->ajax()) {
                return response()->json(['success' => true, 'data' => $data]);
            }
            return redirect()
                ->route("voyager.{$dataType->slug}.index")
                ->with([
                    'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                    'alert-type' => 'success',
                ]);
        }
    }
}
