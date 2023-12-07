<?php

namespace App\Http\Controllers\Admin\Trend;

use App\Http\Controllers\Controller;
use App\Models\Trending;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    public function index()
    {
        $trendings = Trending::orderBy('position', 'DESC')->get();
        return view('admin.trending.index', compact('trendings'));
    }

    public function add()
    {
        $trending = Trending::all();
        return view('admin.trending.add', compact('trending'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'project_id' => 'required|unique:trendings,project_id',
            'position' => 'required',
        ]);

        $check = Trending::insert($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Successfully added');
        }
        return back()->with('msgError', 'Addition failed!');
    }

    public function edit(Trending $trending)
    {
        $trendings = Trending::all();
        return view('admin.trending.edit', compact('trending', 'trendings'));
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'position' => 'required',
        ]);

        $check = Trending::where('id', $id)->update($validate);
        if ($check) {
            return back()->with('msgSuccess', 'Update successful');
        }
        return back()->with('msgError', 'Update failed!');
    }

    public function delete($id)
    {
        $check = Trending::destroy($id);
        if ($check) {
            return back()->with('msgSuccess', 'Deletion successful');
        }
        return back()->with('msgError', 'Deletion failed!');
    }
}
