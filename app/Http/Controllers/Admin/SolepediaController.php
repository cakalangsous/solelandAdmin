<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSolepedia;
use App\Models\Cities;
use App\Models\Solepedia;
use App\Models\SolepediaImage;
use Illuminate\Support\Collection;

class SolepediaController extends AdminController
{
    public function __construct()
    {
        $this->data['menu_group'] = 'solepedia';
        $this->data['active'] = 'solepedia';
    }
    public function index()
    {
        $this->data['solepedias'] = Solepedia::with("city")->orderByDesc('id')->get();
        $this->data['link'] = route('admin.solepedia.create');
        $this->data['title'] = 'All ' . ucwords(str_replace('_', ' ', 'solepedia'));
        $this->data['button_name'] = 'Add ' . ucwords(str_replace('_', ' ', 'solepedia'));
        return $this->admin_view('solepedia.list', $this->data);
    }

    public function images($id)
    {
        $solepedia = Solepedia::whereId($id)->firstOrFail();
        $this->data['title'] = "Images for " . $solepedia->title;
        $this->data['link'] = route('admin.solepedias_image', ["id" => $id]);
        $this->data['button_name'] = 'Add image ' . $solepedia->title;

        $this->data['solepedia'] = $solepedia;
        $this->data['solepedia_images'] = SolepediaImage::where("solepedia_id", $id)->orderByDesc('id')->get();
        return $this->admin_view('solepedia.image-list', $this->data);
    }

    public function images_add($id)
    {
        $solepedia = Solepedia::whereId($id)->firstOrFail();
        $this->data['title'] = "Add content for " . $solepedia->title;
        $this->data['solepedia'] = $solepedia;
        return $this->admin_view('solepedia.images', $this->data);
    }

    public function create()
    {
        $this->data['title'] = "Create New " . ucwords(str_replace('_', ' ', 'Solepedia'));
        $this->data["cities"] = Cities::all();
        return $this->admin_view('solepedia.create', $this->data);
    }

    public function store(StoreSolepedia $request)
    {
        $solepedium = Solepedia::create($request->all());
        return redirect(route('admin.solepedia.index'))->with(['message' => 'New ' . ucwords(str_replace('_', ' ', 'solepedias')) . ' data stored.']);
        return response()->json(['status' => true, 'message' => 'New solepedia data stored.', 'redirect' => route('admin.solepedia.index')], 201);
    }

    public function show(Solepedia $solepedium)
    {
        $this->data['solepedium'] = $solepedium;
        $this->data['title'] = 'Showing Solepedia detail';
        return $this->admin_view('solepedia.show', $this->data);
    }

    public function edit(Solepedia $solepedium)
    {
        $this->data['solepedium'] = $solepedium;
        $this->data['title'] = 'Edit ' . ucwords(str_replace('_', ' ', 'solepedia'));
        $this->data["cities"] = Cities::all();
        return $this->admin_view('solepedia.edit', $this->data);
    }

    public function update(StoreSolepedia $request, Solepedia $solepedium)
    {
        if (!$solepedium) {
            return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'solepedium')) . ' not found', 'redirect' => false], 404);
        }

        $solepedium->city_id = $request->city_id;
        $solepedium->title = $request->title;


        $solepedium->save();
        return redirect(route('admin.solepedia.index'))->with(['message' => ucwords(str_replace('_', ' ', 'solepedia')) . ' data updated.']);
    }

    public function destroy(Solepedia $solepedium)
    {
        if (!$solepedium) {
            return response()->json(['status' => false, 'message' => 'solepedium not found', 'redirect' => false], 404);
        }

        Solepedia::destroy($solepedium->id);
        return redirect(route('admin.solepedia.index'))->with(['message' => ucwords(str_replace('_', ' ', 'solepedium')) . ' deleted']);
    }
}
