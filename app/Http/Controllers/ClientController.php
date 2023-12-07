<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Models\Trending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function home()
    {
        $trendings = Trending::orderBy('position', "ASC")->get();
        return view('client.index', compact('trendings'));
    }
    public function project(Request $request)
    {
        $result = Project::query();

        if ($request->has('keywords') && $request->keywords != null) {
            $result->where('name', 'like', '%' . $request->keywords . '%');
        }

        if ($request->has('category') && $request->category != null) {
            $category_id = Category::where('slug', $request->category)->first();
            if ($category_id) {
                $result->where('category_id', '=',  $category_id->id);
            } else {
                abort(404);
            }
        }

        $projects = $result->orderBy('created_at', 'desc')->paginate(10);
        return view('client.project', compact('projects'));
    }
    public function submit()
    {
        return view("client.submit");
    }

    public function postSubmit(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|unique:projects,slug,max:255',
            'category_id' => 'required|integer',
            'email' => 'required|email',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
            'docs' => 'nullable|url',
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'telegram' => 'nullable|url',
            'github' => 'nullable|url',
            'discord' => 'nullable|url',
            'medium' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Set file name
            $filename = $file->hashName();

            // Store file in the directory storage/app/public/photos/1/projects
            $path = $file->storePubliclyAs('public/photos/1/projects', $filename);

            // Create public URL from storage path
            $url = Storage::url($path);

            // Save URL to the variable $validate['image'] or do something else
            $validate['image'] = $url;
        }
        $validate['slug'] = Str::of($request->name)->slug('-');
        $validate['deleted_at'] = date("Y-m-d H:i:s");
        $check = Project::insert($validate);
        if ($check) {
            return redirect()->route('client.submit-success');
        }
        return redirect()->route('client.submit-failed');
    }
    public function submitSuccess()
    {
        return view("client.submit-success");
    }
    public function submitFailed()
    {
        return view("client.submit-failed");
    }
    public function detail($slug)
    {
        $project = Project::where('slug', "=", $slug)->first();
        if ($project) {
            return view('client.detail', compact('project'));
        } else {
            abort(404);
        }
    }
}
