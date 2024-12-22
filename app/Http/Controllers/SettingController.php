<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Mail\testMail;
use App\Models\State;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('manage setting')) {
            $settings = Utility::settings();

            $company_payment_setting = Utility::getCompanyPaymentSetting(Auth::user()->id);

            return view('settings.index', compact('settings', 'company_payment_setting'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('manage setting')) {
            $user = Auth::user();
            if ($request->company_logo_dark) {
                $image_size = $request->file('company_logo_dark')->getSize();
                $result = Utility::updateStorageLimit(Auth::user()->id, $image_size);
                if ($result == 1) {
                    $request->validate(
                        [
                            'company_logo_dark' => 'image',
                        ]
                    );

                    $logoName = $user->id . '-logo-dark.png';
                    $dir = 'uploads/logo/';

                    $validation = [
                        'mimes:' . 'png',
                        'max:' . '20480',
                    ];
                    $path = Utility::upload_file($request, 'company_logo_dark', $logoName, $dir, $validation);

                    if ($path['flag'] == 1) {
                        $company_logo_dark = $path['url'];
                    } else {
                        return redirect()->back()->with('error', __($path['msg']));
                    }

                    $company_logo = !empty($request->company_logo_dark) ? $logoName : 'logo-dark.png';

                    DB::insert(
                        'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                        [
                            $logoName,
                            'company_logo_dark',
                            Auth::user()->creatorId(),
                        ]
                    );
                }
            }

            if ($request->company_logo_light) {
                $image_size = $request->file('company_logo_light')->getSize();
                $result = Utility::updateStorageLimit(Auth::user()->id, $image_size);
                if ($result == 1) {
                    $request->validate(
                        [
                            'company_logo_light' => 'image',
                        ]
                    );

                    $validation = [
                        'mimes:' . 'png',
                        'max:' . '20480',
                    ];

                    $logoName = $user->id . '-logo-light.png';
                    $dir = 'uploads/logo/';

                    $path = Utility::upload_file($request, 'company_logo_light', $logoName, $dir, $validation);
                    if ($path['flag'] == 1) {
                        $company_logo_light = $path['url'];
                    } else {
                        return redirect()->back()->with('error', __($path['msg']));
                    }

                    $company_logo = !empty($request->company_logo_light) ? $logoName : 'logo-light.png';

                    DB::insert(
                        'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                        [
                            $logoName,
                            'company_logo_light',
                            Auth::user()->creatorId(),
                        ]
                    );
                }
            }

            if ($request->company_favicon) {
                $image_size = $request->file('company_favicon')->getSize();
                $result = Utility::updateStorageLimit(Auth::user()->id, $image_size);
                if ($result == 1) {
                    $request->validate(
                        [
                            'company_favicon' => 'image',
                        ]
                    );
                    $favicon = $user->id . '_favicon.png';
                    $dir = 'uploads/logo/';
                    $validation = [
                        'mimes:' . 'png',
                        'max:' . '20480',
                    ];

                    $path = Utility::upload_file($request, 'company_favicon', $favicon, $dir, $validation);
                    $company_favicon = !empty($request->favicon) ? $favicon : 'favicon.png';

                    if ($path['flag'] == 1) {
                        $company_favicon = $path['url'];
                    } else {
                        return redirect()->back()->with('error', __($path['msg']));
                    }

                    DB::insert(
                        'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                        [
                            $favicon,
                            'company_favicon',
                            Auth::user()->creatorId(),
                        ]
                    );
                }
            }

            $user = Auth::user();
            $arrEnv = [
                'SITE_RTL' => !isset($request->SITE_RTL) ? 'off' : 'on',
            ];
            Utility::setEnvironmentValue($arrEnv);

            $settings = Utility::settings();
            if (!empty($request->title_text) || !empty($request->footer_text) || !empty($request->default_language) || isset($request->display_landing_page) || isset($request->color) || isset($request->cust_theme_bg) || isset($request->cust_darklayout)) {
                $post = $request->all();
                if (!isset($request->display_landing_page)) {
                    $post['display_landing_page'] = 'off';
                }
                if (!isset($request->color)) {
                    $color = $request->has('color') ? $request->color : 'theme-1';
                    $post['color'] = $color;
                }
                if (!isset($request->cust_theme_bg)) {
                    $cust_theme_bg = (isset($request->cust_theme_bg)) ? 'on' : 'off';
                    $post['cust_theme_bg'] = $cust_theme_bg;
                }
                if (!isset($request->cust_darklayout)) {

                    $cust_darklayout = isset($request->cust_darklayout) ? 'on' : 'off';
                    $post['cust_darklayout'] = $cust_darklayout;
                }
                if (!isset($request->SITE_RTL)) {
                    $SITE_RTL = isset($request->SITE_RTL) ? 'on' : 'off';
                    $post['SITE_RTL'] = $SITE_RTL;
                }

                unset($post['_token'], $post['company_logo_dark'], $post['company_logo_light'], $post['company_favicon']);
                foreach ($post as $key => $data) {
                    if (in_array($key, array_keys($settings))) {
                        DB::insert('insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                            $data,
                            $key,
                            Auth::user()->creatorId(),
                        ]);
                    }
                }
            }

            return redirect()->route('settings.index')->with('success', __('Brand setting successfully updated.'));
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storageSettingStore(Request $request)
    {

        if (isset($request->storage_setting) && $request->storage_setting == 'local') {

            $request->validate(
                [

                    'local_storage_validation' => 'required',
                    'local_storage_max_upload_size' => 'required',
                ]
            );

            $post['storage_setting'] = $request->storage_setting;
            $local_storage_validation = implode(',', $request->local_storage_validation);
            $post['local_storage_validation'] = $local_storage_validation;
            $post['local_storage_max_upload_size'] = $request->local_storage_max_upload_size;
        }

        if (isset($request->storage_setting) && $request->storage_setting == 's3') {
            $request->validate(
                [
                    's3_key' => 'required',
                    's3_secret' => 'required',
                    's3_region' => 'required',
                    's3_bucket' => 'required',
                    's3_url' => 'required',
                    's3_endpoint' => 'required',
                    's3_max_upload_size' => 'required',
                    's3_storage_validation' => 'required',
                ]
            );
            $post['storage_setting'] = $request->storage_setting;
            $post['s3_key'] = $request->s3_key;
            $post['s3_secret'] = $request->s3_secret;
            $post['s3_region'] = $request->s3_region;
            $post['s3_bucket'] = $request->s3_bucket;
            $post['s3_url'] = $request->s3_url;
            $post['s3_endpoint'] = $request->s3_endpoint;
            $post['s3_max_upload_size'] = $request->s3_max_upload_size;
            $s3_storage_validation = implode(',', $request->s3_storage_validation);
            $post['s3_storage_validation'] = $s3_storage_validation;
        }

        if (isset($request->storage_setting) && $request->storage_setting == 'wasabi') {
            $request->validate(
                [
                    'wasabi_key' => 'required',
                    'wasabi_secret' => 'required',
                    'wasabi_region' => 'required',
                    'wasabi_bucket' => 'required',
                    'wasabi_url' => 'required',
                    'wasabi_root' => 'required',
                    'wasabi_max_upload_size' => 'required',
                    'wasabi_storage_validation' => 'required',
                ]
            );
            $post['storage_setting'] = $request->storage_setting;
            $post['wasabi_key'] = $request->wasabi_key;
            $post['wasabi_secret'] = $request->wasabi_secret;
            $post['wasabi_region'] = $request->wasabi_region;
            $post['wasabi_bucket'] = $request->wasabi_bucket;
            $post['wasabi_url'] = $request->wasabi_url;
            $post['wasabi_root'] = $request->wasabi_root;
            $post['wasabi_max_upload_size'] = $request->wasabi_max_upload_size;
            $wasabi_storage_validation = implode(',', $request->wasabi_storage_validation);
            $post['wasabi_storage_validation'] = $wasabi_storage_validation;
        }

        foreach ($post as $key => $data) {

            $arr = [
                $data,
                $key,
                Auth::user()->id,
            ];

            DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                $arr
            );
        }

        return redirect()->back()->with('success', 'Storage setting successfully updated.');
    }

    public function CookieConsent(Request $request)
    {

        $settings = Utility::settings();

        if ($settings['enable_cookie'] == "on" && $settings['cookie_logging'] == "on") {
            $allowed_levels = ['necessary', 'analytics', 'targeting'];
            $levels = array_filter($request['cookie'], function ($level) use ($allowed_levels) {
                return in_array($level, $allowed_levels);
            });
            $whichbrowser = new \WhichBrowser\Parser($_SERVER['HTTP_USER_AGENT']);
            // Generate new CSV line
            $browser_name = $whichbrowser->browser->name ?? null;
            $os_name = $whichbrowser->os->name ?? null;
            $browser_language = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? mb_substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : null;
            $device_type = Utility::get_device_type($_SERVER['HTTP_USER_AGENT']);


            $ip = '49.36.83.154';
            $query = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));

            $date = (new \DateTime())->format('Y-m-d');
            $time = (new \DateTime())->format('H:i:s') . ' UTC';

            $new_line = implode(',', [
                $ip, $date, $time, json_encode($request['cookie']), $device_type, $browser_language, $browser_name, $os_name,
                isset($query) ? $query['country'] : '', isset($query) ? $query['region'] : '', isset($query) ? $query['regionName'] : '', isset($query) ? $query['city'] : '', isset($query) ? $query['zip'] : '', isset($query) ? $query['lat'] : '', isset($query) ? $query['lon'] : ''
            ]);

            if (!file_exists(storage_path() . '/uploads/sample/data.csv')) {

                $first_line = 'IP,Date,Time,Accepted cookies,Device type,Browser language,Browser name,OS Name,Country,Region,RegionName,City,Zipcode,Lat,Lon';
                file_put_contents(storage_path() . '/uploads/sample/data.csv', $first_line . PHP_EOL, FILE_APPEND | LOCK_EX);
            }
            file_put_contents(storage_path() . '/uploads/sample/data.csv', $new_line . PHP_EOL, FILE_APPEND | LOCK_EX);

            return response()->json('success');
        }
        return response()->json('error');
    }

    public function saveCookieSettings(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'cookie_title' => 'required',
                'cookie_description' => 'required',
                'strictly_cookie_title' => 'required',
                'strictly_cookie_description' => 'required',
                'more_information_title' => 'required',
                'contactus_url' => 'required',
            ]
        );

        $post = $request->all();

        unset($post['_token']);

        if ($request->enable_cookie) {
            $post['enable_cookie'] = 'on';
        } else {
            $post['enable_cookie'] = 'off';
        }
        if ($request->cookie_logging) {
            $post['cookie_logging'] = 'on';
        } else {

            $post['cookie_logging'] = 'off';
        }

        if ($post['enable_cookie'] == 'on') {

            $post['cookie_title'] = $request->cookie_title;
            $post['cookie_description'] = $request->cookie_description;
            $post['strictly_cookie_title'] = $request->strictly_cookie_title;
            $post['strictly_cookie_description'] = $request->strictly_cookie_description;
            $post['more_information_title'] = $request->more_information_title;
            $post['contactus_url'] = $request->contactus_url;
        }
        $settings = Utility::cookies();

        foreach ($post as $key => $data) {

            if (in_array($key, array_keys($settings))) {

                DB::insert(
                    'insert into settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                    [
                        $data,
                        $key,
                        Auth::user()->creatorId(),
                        date('Y-m-d H:i:s'),
                        date('Y-m-d H:i:s'),
                    ]
                );
            }
        }
        return redirect()->back()->with('success', 'Cookie setting successfully saved.');
    }

    public function saveEmailSettings(Request $request)
    {
        if (Auth::user()->can('manage system settings')) {
            $request->validate([
                'mail_driver' => 'required|string|max:255',
                'mail_host' => 'required|string|max:255',
                'mail_port' => 'required|string|max:255',
                'mail_username' => 'required|string|max:255',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:255',
                'mail_from_address' => 'required|string|max:255',
                'mail_from_name' => 'required|string|max:255',
            ]);

            $arrEnv = [
                'MAIL_DRIVER' => $request->mail_driver,
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_NAME' => $request->mail_from_name,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            ];
            Utility::setEnvironmentValue($arrEnv);

            Artisan::call('config:cache');
            Artisan::call('config:clear');

            return redirect()->back()->with('success', __('Setting successfully updated.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    public function saveCompanyEmailSettings(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'mail_driver' => 'required|string|max:255',
                'mail_host' => 'required|string|max:255',
                'mail_port' => 'required|string|max:255',
                'mail_username' => 'required|string|max:255',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:255',
                'mail_from_address' => 'required|string|max:255',
                'mail_from_name' => 'required|string|max:255',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        $post = $request->all();
        unset($post['_token']);
        foreach ($post as $key => $data) {
            $arr = [
                $data,
                $key,
                Auth::user()->id,
            ];

            DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                $arr
            );
        }

        return redirect()->back()->with('success', __('Setting successfully updated.'));
    }

    public function testMail(Request $request)
    {

        $user = Auth::user();

        $data = [];
        $data['mail_driver'] = $request->mail_driver;
        $data['mail_host'] = $request->mail_host;
        $data['mail_port'] = $request->mail_port;
        $data['mail_username'] = $request->mail_username;
        $data['mail_password'] = $request->mail_password;
        $data['mail_encryption'] = $request->mail_encryption;
        $data['mail_from_address'] = $request->mail_from_address;
        $data['mail_from_name'] = $request->mail_from_name;

        return view('settings.test_mail', compact('data'));
    }

    public function testSendMail(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'mail_driver' => 'required',
                'mail_host' => 'required',
                'mail_port' => 'required',
                'mail_username' => 'required',
                'mail_password' => 'required',
                'mail_from_address' => 'required',
                'mail_from_name' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        try {
            config(
                [
                    'mail.driver' => $request->mail_driver,
                    'mail.host' => $request->mail_host,
                    'mail.port' => $request->mail_port,
                    'mail.encryption' => $request->mail_encryption,
                    'mail.username' => $request->mail_username,
                    'mail.password' => $request->mail_password,
                    'mail.from.address' => $request->mail_from_address,
                    'mail.from.name' => $request->mail_from_name,
                ]
            );
            Mail::to($request->email)->send(new testMail());

            return response()->json(
                [
                    'is_success' => true,
                    'message' => __('Email send Successfully'),
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'is_success' => false,
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    public function SeoSettings(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'meta_keywords' => 'required',
                'meta_description' => 'required',
                'meta_image' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        if (!empty($request->meta_image)) {
            if ($request->meta_image) {

                $path = storage_path('uploads/metaevent/' . Utility::getSeoSetting()['meta_image']);

                if (!empty($path)) {
                    if (file_exists($path)) {
                        File::delete($path);
                    }
                }
            }

            $img_name = time() . '_' . 'meta_image.png';
            $dir = 'uploads/metaevent';
            $validation = [
                'max:' . '20480',
            ];

            $path = Utility::upload_file($request, 'meta_image', $img_name, $dir, $validation);

            if ($path['flag'] == 1) {
                $logo_dark = $path['url'];
            } else {
                return redirect()->back()->with('error', __($path['msg']));
            }

            $post['meta_image'] = $img_name;
        }

        $post['meta_keywords'] = $request->meta_keywords;
        $post['meta_description'] = $request->meta_description;

        foreach ($post as $key => $data) {
            $arr = [
                $data,
                $key,
                Auth::user()->id,
            ];

            DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                $arr
            );
        }

        return redirect()->back()->with('success', 'SEO setting successfully updated.');
    }

    public function savePaymentSettings(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'site_currency' => 'required',
                'site_currency_symbol' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $post['site_currency'] = $request->site_currency;
        $post['site_currency_symbol'] = $request->site_currency_symbol;


        if (isset($request->is_bank_enabled) && $request->is_bank_enabled == 'on') {
            $post['is_bank_enabled'] = $request->is_bank_enabled;
            $post['bank_details'] = $request->bank_details;
        } else {
            $post['is_bank_enabled'] = 'off';
        }
        foreach ($post as $key => $data) {

            $arr = [
                $data,
                $key,
                Auth::user()->id,
            ];
            DB::insert(
                'insert into payment_settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                $arr
            );
        }

        return redirect()->back()->with('success', __('Payment setting successfully updated.'));
    }

    public function recaptchaSettingStore(Request $request)
    {


        $validator = Validator::make(
            $request->all(),
            [
                'google_recaptcha_key' => 'required',
                'google_recaptcha_secret' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }
        $post['recaptcha_module']        = $request->recaptcha_module;
        $post['google_recaptcha_key']    = $request->google_recaptcha_key;
        $post['google_recaptcha_secret'] = $request->google_recaptcha_secret;
        foreach ($post as $key => $data) {
            $arr = [
                $data,
                $key,
                \Auth::user()->id,
            ];
            \DB::insert(
                'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                $arr
            );
        }

        return redirect()->back()->with('success', __('Recaptcha Settings updated successfully'));

    }

    public function adminSettings(Request $request)
    {
        if (Auth::user()->can('manage system settings')) {
            $settings = Utility::settings();
            $payment = Utility::set_payment_settings();

            $file_size = 0;

            foreach (\File::allFiles(storage_path('/framework')) as $file) {
                $file_size += $file->getSize();
            }
            $file_size = number_format($file_size / 1000000, 6);

            $countries = Country::get();

            $country_id = !empty($request->country) ? $request->country : 1;
            $states = State::where('country_id', $country_id)->get()->toArray();

            $state_id = !empty($request->state_id) ? $request->state_id : 1;
            $cities = City::where('region_id', $state_id)->get()->toArray();

            if (!empty($request->state_id) || !empty($request->country)) {
                $filter_data = 'filtered';
            } else {
                $filter_data = null;
            }

            return view('settings.admin', compact('settings', 'file_size', 'payment', 'countries', 'states', 'country_id', 'cities', 'filter_data'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function saveBusinessSettings(Request $request)
    {
        if (Auth::user()->can('manage system settings')) {
            $user = Auth::user();
            if ($request->company_logo_dark) {

                $request->validate(
                    [
                        'company_logo_dark' => 'image',
                    ]
                );

                $logoName = $user->id . '-logo-dark.png';
                $dir = 'uploads/logo/';

                $validation = [
                    'mimes:' . 'png',
                    'max:' . '20480',
                ];

                $path = Utility::upload_file($request, 'company_logo_dark', $logoName, $dir, $validation);

                if ($path['flag'] == 1) {
                    $company_logo_dark = $path['url'];
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }

                $company_logo = !empty($request->company_logo_dark) ? $logoName : 'logo-dark.png';

                DB::insert(
                    'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                    [
                        $logoName,
                        'company_logo_dark',
                        Auth::user()->creatorId(),
                    ]
                );
            }

            if ($request->company_logo_light) {

                $request->validate(
                    [
                        'company_logo_light' => 'image',
                    ]
                );

                $validation = [
                    'mimes:' . 'png',
                    'max:' . '20480',
                ];

                $logoName = $user->id . '-logo-light.png';
                $dir = 'uploads/logo/';

                $path = Utility::upload_file($request, 'company_logo_light', $logoName, $dir, $validation);
                if ($path['flag'] == 1) {
                    $company_logo_light = $path['url'];
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }

                $company_logo = !empty($request->company_logo_light) ? $logoName : 'logo-light.png';

                DB::insert(
                    'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                    [
                        $logoName,
                        'company_logo_light',
                        \Auth::user()->creatorId(),
                    ]
                );
            }

            if ($request->company_favicon) {
                $request->validate(
                    [
                        'company_favicon' => 'image',
                    ]
                );
                $favicon = $user->id . '_favicon.png';
                $dir = 'uploads/logo/';
                $validation = [
                    'mimes:' . 'png',
                    'max:' . '20480',
                ];

                $path = Utility::upload_file($request, 'company_favicon', $favicon, $dir, $validation);
                $company_favicon = !empty($request->favicon) ? $favicon : 'favicon.png';

                if ($path['flag'] == 1) {
                    $company_favicon = $path['url'];
                } else {
                    return redirect()->back()->with('error', __($path['msg']));
                }

                DB::insert(
                    'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                    [
                        $favicon,
                        'company_favicon',
                        Auth::user()->creatorId(),
                    ]
                );
            }

            $user = Auth::user();

            $settings = Utility::settings();
            if (!empty($request->title_text) || !empty($request->footer_text) || !empty($request->default_language) || isset($request->display_landing_page) || isset($request->color) || isset($request->cust_theme_bg) || isset($request->cust_darklayout) || isset($request->SITE_RTL)  || isset($request->email_verification) || isset($request->signup_button)) {

                $post = $request->all();
                if (!isset($request->display_landing_page)) {
                    $post['display_landing_page'] = 'off';
                }

                if (!isset($request->cust_theme_bg)) {
                    $cust_theme_bg = (isset($request->cust_theme_bg)) ? 'on' : 'off';
                    $post['cust_theme_bg'] = $cust_theme_bg;
                }

                if (!isset($request->SITE_RTL)) {
                    $post['SITE_RTL'] = 'off';
                }

                if (!isset($request->cust_darklayout)) {

                    $cust_darklayout = isset($request->cust_darklayout) ? 'on' : 'off';
                    $post['cust_darklayout'] = $cust_darklayout;
                }

                if (!isset($request->email_verification)) {
                    $post['email_verification'] = 'off';
                }

                if (!isset($request->signup_button)) {
                    $post['signup_button'] = 'off';
                }

                unset($post['_token'], $post['company_logo_dark'], $post['company_logo_light'], $post['company_favicon']);

                foreach ($post as $key => $data) {
                    if (in_array($key, array_keys($settings))) {
                        DB::insert('insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ', [
                            $data,
                            $key,
                            Auth::user()->creatorId(),
                        ]);
                    }
                }
            }

            return redirect()->back()->with('success', 'Brand setting successfully updated.');
        } else {
            return redirect()->back()->with('error', 'Permission denied.');
        }
    }

    public function saveAdminPaymentSettings(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make(
            $request->all(),
            [
                'currency' => 'required|string|max:255',
                'currency_symbol' => 'required|string|max:255',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        } else {

            $post['currency_symbol'] = $request->currency_symbol;
            $post['currency'] = $request->currency;
        }


        if (isset($request->is_manually_enabled) && $request->is_manually_enabled == 'on') {
            $post['is_manually_enabled'] = $request->is_manually_enabled;
        } else {
            $post['is_manually_enabled'] = 'off';
        }
        if (isset($request->is_bank_enabled) && $request->is_bank_enabled == 'on') {
            $validator = Validator::make(
                $request->all(),
                [
                    'bank_details' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $post['is_bank_enabled'] = $request->is_bank_enabled;
            $post['bank_details'] = $request->bank_details;
        } else {
            $post['is_bank_enabled'] = 'off';
        }

        foreach ($post as $key => $data) {
            $arr = [
                $data,
                $key,
                Auth::user()->id,
            ];
            $bdfuv = DB::insert(
                'insert into admin_payment_settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                $arr
            );
        }

        return redirect()->back()->with('success', __('Settings updated successfully.'));
    }

    public function savePusherSettings(Request $request)
    {
        if (\Auth::user()->type == 'super admin') {

            $validator = Validator::make(
                $request->all(),
                [
                    'pusher_app_id' => 'required',
                    'pusher_app_key' => 'required',
                    'pusher_app_secret' => 'required',
                    'pusher_app_cluster' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $post['pusher_app_id']        = $request->pusher_app_id;
            $post['pusher_app_key']    = $request->pusher_app_key;
            $post['pusher_app_secret'] = $request->pusher_app_secret;
            $post['pusher_app_cluster'] = $request->pusher_app_cluster;

            foreach ($post as $key => $data) {
                $arr = [
                    $data,
                    $key,
                    \Auth::user()->id,
                ];
                \DB::insert(
                    'insert into settings (`value`, `name`,`created_by`) values (?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                    $arr
                );
            }

            return redirect()->back()->with('success', __('Pusher Settings updated successfully'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function saveGoogleCalenderSettings(Request $request)
    {

        if (isset($request->is_enabled) && $request->is_enabled == 'on') {

            $validator = Validator::make(
                $request->all(),
                [
                    'google_clender_id' => 'required',
                    'google_calender_json_file' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $post['is_enabled'] = $request->is_enabled;
        } else {
            $post['is_enabled'] = 'off';
        }


        if ($request->google_calender_json_file) {
            $dir       = storage_path() . '/' . md5(time());
            if (!is_dir($dir)) {
                File::makeDirectory($dir, $mode = 0777, true, true);
            }
            $file_name = $request->google_calender_json_file->getClientOriginalName();
            $file_path =  md5(time()) . "/" . md5(time()) . "." . $request->google_calender_json_file->getClientOriginalExtension();

            $file = $request->file('google_calender_json_file');
            $file->move($dir, $file_path);
            $post['google_calender_json_file']            = $file_path;
        }

        if ($request->google_clender_id) {
            $post['google_clender_id']            = $request->google_clender_id;

            foreach ($post as $key => $data) {
                DB::insert(
                    'insert into settings (`value`, `name`,`created_by`,`created_at`,`updated_at`) values (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `value` = VALUES(`value`) ',
                    [
                        $data,
                        $key,
                        Auth::user()->id,
                        date('Y-m-d H:i:s'),
                        date('Y-m-d H:i:s'),
                    ]
                );
            }
        }
        return redirect()->back()->with('success', 'Google Calendar setting successfully updated.');
    }
}
