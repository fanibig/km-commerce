<?php

use Carbon\Carbon;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

/**
 * Formats a number as a shortened currency string with the specified decimal places, currency symbol, and separator.
 *
 * @param float $number The number to format as currency.
 * @param int $decimal The number of decimal places to include in the formatted number. Default is 2.
 * @param string $currency The currency symbol to include in the formatted number. Default is 'PKR'.
 * @param string $separator The separator to use between thousands in the formatted number. Default is ','.
 * @return string The formatted number as a shortened currency string.
 */
if (!function_exists('shortenFormattedCurrency')) {
    function shortenFormattedCurrency($number, $decimal = 2, $currency = 'PKR', $separator = ',')
    {
        $suffix = '';

        $units = ['K', 'M', 'B', 'T', 'Q'];

        foreach ($units as $unit) {
            if (abs($number) >= 1000) {
                $number /= 1000;
                $suffix = $unit;
            } else {
                break;
            }
        }

        $formattedNumber = number_format($number, $decimal, '.', $separator);

        if (!empty($currency)) {
            $formattedNumber = $currency . $formattedNumber;
        }

        return $formattedNumber . $suffix;
    }
}

/**
 * Formats a number as a currency string with the specified decimal places, currency symbol, and separator.
 *
 * @param float $number The number to format as currency.
 * @param int $decimal The number of decimal places to include in the formatted number. Default is 2.
 * @param string $currency The currency symbol to include in the formatted number. Default is 'PKR'.
 * @param string $separator The separator to use between thousands in the formatted number. Default is ','.
 * @return string The formatted number as a currency string.
 */
if (!function_exists('currencyFormatted')) {
    function currencyFormatted($number, $decimal = 2, $currency = 'PKR', $separator = ',')
    {
        $formattedNumber = number_format($number, $decimal, '.', $separator);

        if (!empty($currency)) {
            $formattedNumber = $currency . $formattedNumber;
        }

        return $formattedNumber;
    }
}

if (!function_exists('imageUpload')) {
    function imageUpload($request, $directory, $extension = 'jpg', $image = null, $mimes = ['jpg', 'png', 'jpeg', 'svg', 'webp', 'gif'])
    {
        // Initialize Image Manager with Gd driver
        $manager = new ImageManager(new Driver());

        // Validate file type
        if ($mimes) {
            $request->validate([
                'image' => 'mimes:' . implode(',', $mimes),
            ]);
        }

        // Check for image file
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = uniqid() . '.' . $extension;  // Unique name to avoid conflicts

            // Use `read` or similar method to load image from binary data, then process it
            if (in_array($extension, ['jpg', 'jpeg', 'png', 'webp'])) {
                // Read image and prepare for encoding without specifying format
                $image = $manager->read(file_get_contents($imageFile->getRealPath()));

                // Use quality for optimization (75 in this example) and stream the image data
                $imageStream = $image->toJpeg(80)->save($directory . '/' . $imageName);

                // Store the image file
                Storage::disk('public')->put("{$directory}/{$imageName}", $imageStream);
            } else {
                // For unsupported types, store directly
                $imageFile->storeAs($directory, $imageName, 'public');
            }

            return $imageName;
        }

        return null;  // Handle case where no image was uploaded
    }
}

if (!function_exists('getEnumValues')) {
    function getEnumValues($table, $column): array
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);

        $enum_values = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum_values = Arr::add($enum_values, $v, $v);
        }

        asort($enum_values);

        return $enum_values;
    }
}

if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
if (!function_exists('generateRandomNumber')) {
    function generateRandomNumber($length = 5)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        if (empty($date)) {
            return null;
        } else {
            $dateFormat = Setting::where('option_name', 'date_format')->value('option_value');

            // Set a default date format if no value is found.
            $dateFormat = $dateFormat ?? 'Y-m-d';

            // Parse the date and format it.
            try {
                return Carbon::parse($date)->format($dateFormat);
            } catch (\Exception $e) {
                // Handle parsing errors (e.g., invalid date input).
                return null;
            }
        }
    }
}