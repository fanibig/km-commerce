<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class SettingController extends Controller
{
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function general_setting()
    {
        $pageTitle = __('General Settings');
        $roles = Role::all();
        $general = Setting::pluck('option_value', 'option_name')->toArray();
        return view('admin.settings.general', compact('general', 'pageTitle', 'roles'));
    }

    /**
     * A description of the entire PHP function.
     *
     * @param Request $request description
     * @throws Exception description of exception
     * @return mixed
     */
    public function general_setting_update(Request $request)
    {
        // Get all settings from the request
        $settings = $request->only(config('common.option_general'));

        if ($request->hasFile('site_favicon')) {
            $filename = $request->file('site_favicon');
            $originalName = $filename->getClientOriginalName();

            $path = 'storage/media';

            // Use Storage to store the image
            $storedPath = $filename->storeAs('media', $originalName, 'public');

            // Get the full path of the stored image
            $fullPath = public_path($path . '/' . $originalName);

            // Optimize the stored image
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);

            $settings['site_favicon'] = $storedPath;
        }

        if ($request->hasFile('site_logo')) {
            $filename = $request->file('site_logo');
            $originalName = $filename->getClientOriginalName();

            $path = 'storage/media';

            // Use Storage to store the image
            $storedPath = $filename->storeAs('media', $originalName, 'public');

            // Get the full path of the stored image
            $fullPath = public_path($path . '/' . $originalName);

            // Optimize the stored image
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($fullPath);

            $settings['site_logo'] = $storedPath;
        }

        try {
            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(
                    ['option_name' => $key],
                    ['option_value' => $value]
                );
            }
            Alert::toast('Updated successfully', 'success')->autoClose(2000);
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(10000);
        }

        return back();
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function getWriting()
    {
        $pageTitle = __('Writing Settings');
        $categories = Category::get(['title', 'id']);
        $writing = Setting::pluck('option_value', 'option_name')->toArray();
        return view('admin.settings.writing', compact('pageTitle', 'writing', 'categories'));
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function updateWriting(Request $request)
    {
        // Get all settings from the request
        $settings = $request->only(config('common.option_writing'));

        try {
            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(
                    ['option_name' => $key],
                    ['option_value' => $value]
                );
            }
            Alert::toast('Updated successfully', 'success')->autoClose(2000);
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(10000);
        }

        return back();
    }

    /**
     * A description of the entire PHP function.
     *
     * @param datatype $paramname description
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function getReading()
    {
        $pageTitle = __('Reading Settings');
        $pages = Page::get(['title', 'id']);
        $reading = Setting::pluck('option_value', 'option_name')->toArray();
        return view('admin.settings.reading', compact('pageTitle', 'reading', 'pages'));
    }

    public function updateReading(Request $request)
    {
        // Get all settings from the request
        $settings = $request->only(config('common.option_reading'));

        try {
            foreach ($settings as $key => $value) {
                Setting::updateOrCreate(
                    ['option_name' => $key],
                    ['option_value' => $value]
                );
            }
            Alert::toast('Updated successfully', 'success')->autoClose(2000);
        } catch (\Exception $e) {
            Alert::toast($e->getMessage(), 'error')->autoClose(10000);
        }

        return back();
    }
}