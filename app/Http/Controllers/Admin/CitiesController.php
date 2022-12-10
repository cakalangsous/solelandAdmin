<?php
    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\AdminController;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreCities;
    use App\Models\Cities;
    use Illuminate\Support\Collection;

    class CitiesController extends AdminController
    {
        public function __construct()
        {
            $this->data['menu_group'] = 'cities';
            $this->data['active'] = 'cities';
        }
        public function index()
        {
            $this->data['cities'] = Cities::orderByDesc('id')->get();
            $this->data['link'] = route('admin.cities.create');
            $this->data['title'] = 'All '.ucwords(str_replace('_', ' ', 'cities'));
            $this->data['button_name'] = 'Add '.ucwords(str_replace('_', ' ', 'cities'));
            return $this->admin_view('cities.list', $this->data);
        }
        
        public function create()
        {
            $this->data['title'] = "Create New ".ucwords(str_replace('_', ' ', 'Cities'));
            return $this->admin_view('cities.create', $this->data);
        }
        
        public function store(StoreCities $request)
        {
            $city = Cities::create($request->all());
            return redirect(route('admin.cities.index'))->with(['message' => 'New '.ucwords(str_replace('_', ' ', 'cities')).' data stored.']);
            return response()->json(['status' => true, 'message' => 'New cities data stored.', 'redirect' => route('admin.cities.index')], 201);
        }
        
        public function show(Cities $city)
        {
            $this->data['city'] = $city;
            $this->data['title'] = 'Showing Cities detail';
            return $this->admin_view('cities.show', $this->data);
        }
        
        public function edit(Cities $city)
        {
            $this->data['city'] = $city;
            $this->data['title'] = 'Edit '.ucwords(str_replace('_', ' ', 'city'));
            return $this->admin_view('cities.edit', $this->data);
        }
        
        public function update(StoreCities $request, Cities $city)
        {
            if (!$city) {
                return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'city')).' not found', 'redirect' => false], 404);
            }

            $city->name = $request->name;
			
            
            $city->save();
            return redirect(route('admin.cities.index'))->with(['message' => ucwords(str_replace('_', ' ', 'city')).' data updated.']);
            return response()->json(['status' => true, 'message' => 'New city data updated.', 'redirect' => route('admin.cities.index')], 200);
        }
        
        public function destroy(Cities $city)
        {
            if (!$city) {
                return response()->json(['status' => false, 'message' => 'city not found', 'redirect' => false], 404);
            }
            
            Cities::destroy($city->id);
            return redirect(route('admin.cities.index'))->with(['message' => ucwords(str_replace('_', ' ', 'city')).' deleted']);
            return response()->json(['status' => true, 'message' => ucwords(str_replace('_', ' ', 'city')).' deleted', 'redirect' => route('admin.cities.index')]);
        }
    }
