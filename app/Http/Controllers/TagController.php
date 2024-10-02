<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function tags()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.tags', [
            'tags' => $tags,
        ]);
    }
    function insert_tag(Request $request)
    {
        $request->validate([
            'tag_name.*' => 'required|distinct|unique:tags,tag_name',
        ], [
            'tag_name.*.required' => "This field is required",
            'tag_name.*.distinct' => "Duplicate tags are not allowed in the input",
            'tag_name.*.unique' => "The tag name is already in use",
        ]);


        $tags = $request->tag_name;
        foreach ($tags as $tag) {
            Tag::insert([
                'tag_name' => $tag,
                'created_at' => Carbon::now(),
            ]);
        };
        return back()->with('success', 'tag addedd successfully!');
    }
    function tag_delete($id)
    {
        Tag::find($id)->delete();
        return back();
    }
}
