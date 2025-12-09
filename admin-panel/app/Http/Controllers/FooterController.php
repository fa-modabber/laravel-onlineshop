<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::first();
        return view('footer.index', compact('footer'));
    }
    public function edit(Footer $footer)
    {
        return view('footer.edit', compact('footer'));
    }
    public function update(Request $request, Footer $footer)
    {
        $request->validate([
            'col_1_title' => 'required|string',
            'col_1_body_1' => 'required|string',
            'col_1_body_2' => 'nullable|string',
            'col_2_title' => 'required|string',
            'col_2_body' => 'required|string',
            'col_3_title' => 'required|string',
            'col_3_body' => 'required|string',
            'social_media_1' => 'nullable|string',
            'social_media_2' => 'nullable|string',
            'social_media_3' => 'nullable|string',
            'social_media_4' => 'nullable|string',
            'copyright' => 'required|string'
        ]);
        $footer->update([
            'col_1_title' => $request->col_1_title,
            'col_1_body_1' => $request->col_1_body_1,
            'col_1_body_2' => $request->col_1_body_2,
            'col_2_title' => $request->col_2_title,
            'col_2_body' => $request->col_2_body,
            'col_3_title' => $request->col_3_title,
            'col_3_body' => $request->col_3_body,
            'social_media_1' => $request->social_media_1,
            'social_media_2' => $request->social_media_2,
            'social_media_3' => $request->social_media_3,
            'social_media_4' => $request->social_media_4,
            'copyright' => $request->copyright
        ]);
        return redirect()->route('footer.index')->with('success', 'فوتر با موفقیت ویرایش شد');
    }
}
