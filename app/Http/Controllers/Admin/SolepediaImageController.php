<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSolepediaImage;
use App\Models\Solepedia;
use App\Models\SolepediaImage;
use Illuminate\Support\Collection;

class SolepediaImageController extends AdminController
{
    public function __construct()
    {
        $this->data['menu_group'] = 'solepedia_image';
        $this->data['active'] = 'solepedia_image';
    }
    public function index()
    {
        $this->data['solepedia_images'] = SolepediaImage::orderByDesc('id')->get();
        $this->data['link'] = route('admin.solepedia_images.create');
        $this->data['title'] = 'All ' . ucwords(str_replace('_', ' ', 'solepedia_images'));
        $this->data['button_name'] = 'Add ' . ucwords(str_replace('_', ' ', 'solepedia_images'));
        return $this->admin_view('solepediaImage.list', $this->data);
    }

    public function create()
    {
        $this->data['title'] = "Create New " . ucwords(str_replace('_', ' ', 'SolepediaImage'));
        $this->data['solepedia'] = Solepedia::all();
        return $this->admin_view('solepediaImage.create', $this->data);
    }

    public function store(StoreSolepediaImage $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated["image"] = $request->file('image')->store('solepedia/' . $request->solepedia_id);
        }

        $solepedia_image = SolepediaImage::create($validated);
        return redirect()->back()->with(['message' => 'New ' . ucwords(str_replace('_', ' ', 'solepedia_images')) . ' data stored.']);
        // return response()->json(['status' => true, 'message' => 'New solepedia_images data stored.', 'redirect' => route('admin.solepedia_images.index')], 201);
    }

    public function show(SolepediaImage $solepedia_image)
    {
        $this->data['solepedia_image'] = $solepedia_image;
        $this->data['title'] = 'Showing SolepediaImage detail';
        return $this->admin_view('solepediaImage.show', $this->data);
    }

    public function edit(SolepediaImage $solepedia_image)
    {
        $this->data['solepedia_image'] = $solepedia_image;
        $this->data['solepedia'] = Solepedia::all();
        $this->data['title'] = 'Edit ' . ucwords(str_replace('_', ' ', 'solepedia_image'));
        return $this->admin_view('solepediaImage.edit', $this->data);
    }

    public function update(StoreSolepediaImage $request, SolepediaImage $solepedia_image)
    {
        if (!$solepedia_image) {
            return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'solepedia_image')) . ' not found', 'redirect' => false], 404);
        }
        $validated = $request->validated();

        $solepedia_image->solepedia_id = $request->solepedia_id;

        if ($request->hasFile('image')) {
            $solepedia_image->image = $request->file('image')->store('solepedia/' . $request->solepedia_id);
        }

        $solepedia_image->save();
        return redirect(route('admin.sole_images', ['id' => $solepedia_image->solepedia_id]))->with(['message' => ucwords(str_replace('_', ' ', 'solepedia_image')) . ' data updated.']);
        // return response()->json(['status' => true, 'message' => 'New solepedia_image data updated.', 'redirect' => route('admin.solepedia_images.index')], 200);
    }

    public function destroy(SolepediaImage $solepedia_image)
    {
        if (!$solepedia_image) {
            return response()->json(['status' => false, 'message' => 'solepedia_image not found', 'redirect' => false], 404);
        }

        $image = storage_path('app/public/' . $solepedia_image->setting_value);
        if (file_exists($image)) {
            @unlink($image);
        }

        SolepediaImage::destroy($solepedia_image->id);
        return redirect(route('admin.solepedia_images.index'))->with(['message' => ucwords(str_replace('_', ' ', 'solepedia_image')) . ' deleted']);
    }
}
