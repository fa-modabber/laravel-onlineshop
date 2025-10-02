<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('about-us.index', compact('about'));
    }

    public function edit(AboutUs $about)
    {
        return view('about-us.edit', compact('about'));
    }

    public function update(Request $request, AboutUs $about)
    {
        $request->validate([
            'title' => 'required|string',
            'link' => 'required|string',
            'body' => 'required|string'
        ]);

        $about->update([
            'title' => $request->title,
            'link' => $request->link,
            'body' => $request->body,

        ]);
        return redirect()->route('about-us.index')->with('success', 'درباره ما با موفقیت ویرایش شد');
    }
}
