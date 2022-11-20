<?php

namespace App\Http\Controllers;

use App\Models\FlowChart;
use App\Repositories\FlowChartRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FlowChartController extends Controller
{
    protected FlowChartRepository $flowChartRepository;

    public function __construct()
    {
        $this->flowChartRepository = new FlowChartRepository;
    }

    public function index(Request $request) :View
    {
        $user = $request->user();

        //TODO: Implement Permissions
        //$user->can('view charts') ?? abort(404);

        return view('flowchart.index', [
            'charts' => $this->flowChartRepository->query()->orderByDesc('id')->paginate(10),
        ]);
    }

    public function addEdit(Request $request, ?string $flowChart = null): RedirectResponse
    {
        $user = $request->user();

        if (empty($flowChart)) {

            //TODO: Implement Permissions
            //$user->can('create charts') ?? abort(404);

            $flowChart = new FlowChart();
            $create = true;
        } else {

            //TODO: Implement Permissions
            //$user->can('edit charts') ?? abort(404);

            $flowChart = $this->flowChartRepository->query()->uuid($flowChart)->first() ?? abort(404);
            $create = false;
        }

        $validation = [
            'description' => ['nullable', 'string', 'max:255'],
        ];

        $create ?
            $validation['name'] = ['required', 'string','max:255', 'name', 'unique:charts'] :
            $validation['name'] = [
                'required',
                'string',
                'max:255',
                'name',
                'unique:charts,name,' . $flowChart->id
            ];

        $request->validate($validation);

        $flowChart->name = $request->name;
        $flowChart->description = $request->description;

        $flowChart->save();

        return redirect()->back();
    }

    public function view(Request $request, $flowChartUuid): View
    {
        $user = $request->user();

        //TODO: Implement Permissions
        //$user->can('view charts') ?? abort(404);

        return view('flowchart.view', [
            'chart' => $this->flowChartRepository->query()->uuid($flowChartUuid)->first() ?? abort(404),
        ]);
    }

    public function update(Request $request, $flowChartUuid): JsonResponse
    {
        $user = $request->user();

        //TODO: Implement Permissions
        //$user->can('update charts') ?? abort(404);

        $chart = $this->flowChartRepository->query()
                ->uuid($flowChartUuid)
                ->first() ?? abort(404);

        $chart->save();
        return response()->json(['chart' => $chart]);
    }

    public function delete(Request $request, $flowChartUuid): RedirectResponse
    {
        $user = $request->user();

        //TODO: Implement Permissions
        //$user->can('delete charts') ?? abort(404);

        $chart = $this->flowChartRepository
                ->query()
                ->uuid($flowChartUuid)
                ->first() ?? abort(404);

        $chart->delete();

        return redirect()->back();
    }
}
