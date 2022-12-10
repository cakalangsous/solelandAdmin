<?php
    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\AdminController;
    use Illuminate\Http\Request;
    use App\Http\Requests\StoreSiteSettings;
    use App\Models\SiteSettings;
    use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

    class SiteSettingsController extends AdminController
    {
        public function __construct()
        {
            $this->data['menu_group'] = 'site_settings';
            $this->data['active'] = 'site_settings';
        }
        public function index()
        {
            // $this->data['site_settings'] = SiteSettings::orderByDesc('id')->get();
            // $this->data['link'] = route('admin.site_settings.create');
            // $this->data['button_name'] = 'Add '.ucwords(str_replace('_', ' ', 'site_settings'));
            $this->data['title'] = ucwords(str_replace('_', ' ', 'site_settings'));
            return $this->admin_view('siteSettings.list', $this->data);
        }
        
        public function store(StoreSiteSettings $request)
        {
            $site_setting = SiteSettings::create($request->all());
            return redirect(route('admin.site_settings.index'))->with(['message' => 'New '.ucwords(str_replace('_', ' ', 'site_settings')).' data stored.']);
            return response()->json(['status' => true, 'message' => 'New site_settings data stored.', 'redirect' => route('admin.site_settings.index')], 201);
        }

        public function update(StoreSiteSettings $request, SiteSettings $site_setting)
        {
            if (!$site_setting) {
                return response()->json(['status' => false, 'message' => ucwords(str_replace('_', ' ', 'site_setting')).' not found', 'redirect' => false], 404);
            }

            $site_setting->setting_name = $request->setting_name;
			$site_setting->setting_value = $request->setting_value;
			
            
            $site_setting->save();
            return redirect(route('admin.site_settings.index'))->with(['message' => ucwords(str_replace('_', ' ', 'site_setting')).' data updated.']);
            return response()->json(['status' => true, 'message' => 'New site_setting data updated.', 'redirect' => route('admin.site_settings.index')], 200);
        }
        
        public function destroy(SiteSettings $site_setting)
        {
            if (!$site_setting) {
                return response()->json(['status' => false, 'message' => 'site_setting not found', 'redirect' => false], 404);
            }
            
            SiteSettings::destroy($site_setting->id);
            return redirect(route('admin.site_settings.index'))->with(['message' => ucwords(str_replace('_', ' ', 'site_setting')).' deleted']);
            return response()->json(['status' => true, 'message' => ucwords(str_replace('_', ' ', 'site_setting')).' deleted', 'redirect' => route('admin.site_settings.index')]);
        }

        public function save(Request $request)
        {
            $validated = $request->validate([
                'site_name' => 'required',
                'favicon' => 'sometimes|image|mimes:jpg,jpeg,png',
                'logo_small' => 'sometimes|image|mimes:jpg,jpeg,png',
                'logo_big' => 'sometimes|image|mimes:jpg,jpeg,png',
                'login_bg' => 'sometimes|image|mimes:jpg,jpeg,png',
                'theme_color' => 'required',
                'add_btn_bg' => 'required',
                'add_btn_color' => 'required'
            ]);

            if ($request->hasFile('favicon')) {
                $favicon = SiteSettings::where('setting_name', 'favicon')->first();
                $favicon_image = storage_path('app/public/'.$favicon->setting_value);
                if (file_exists($favicon_image)) {
                    @unlink($favicon_image);
                }
                $validated['favicon'] = $request->file('favicon')->store('site_settings');
            }

            if ($request->hasFile('logo_small')) {
                $logo_small = SiteSettings::where('setting_name', 'logo_small')->first();
                $logo_small_image = storage_path('app/public/'.$logo_small->setting_value);
                if (file_exists($logo_small_image)) {
                    @unlink($logo_small_image);
                }
                $validated['logo_small'] = $request->file('logo_small')->store('site_settings');
            }

            if ($request->hasFile('logo_big')) {
                $logo_big = SiteSettings::where('setting_name', 'logo_big')->first();
                $logo_big_image = storage_path('app/public/'.$logo_big->setting_value);
                if (file_exists($logo_big_image)) {
                    @unlink($logo_big_image);
                }
                $validated['logo_big'] = $request->file('logo_big')->store('site_settings');
            }

            if ($request->hasFile('login_bg')) {
                $login_bg = SiteSettings::where('setting_name', 'login_bg')->first();
                $login_bg_image = storage_path('app/public/'.$login_bg->setting_value);
                if (file_exists($login_bg_image)) {
                    @unlink($login_bg_image);
                }
                $validated['login_bg'] = $request->file('login_bg')->store('site_settings');
            }

            foreach ($validated as $data => $key) {
                if ($setting = SiteSettings::where('setting_name', $data)->first()) {
                    $setting->setting_value = $key;
                    $setting->save();
                }
            }

            return redirect(route('admin.site_settings.index'))->with('message', 'Settings updated');
        }
    }
