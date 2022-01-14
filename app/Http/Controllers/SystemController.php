<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use YoHang88\LetterAvatar\LetterAvatar;

class SystemController extends Controller
{
    /**
     * instance of controller
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * returns the elapsed time
     * @param $time
     * @return string
     */
    public static function elapsedTime($time): string
    {
        return Carbon::parse($time)->diffForHumans();
    }

    /**
     * Write the system log files
     * @param array $data
     * @param string $channel
     * @param string $fileName
     */
    public static function log(array $data, string $channel, string $fileName)
    {
        $file = storage_path('logs/' . $fileName . '.log');

        // finally, create a formatter
        $formatter = new JsonFormatter();

        // Create the log data
        $log = [
            'ip' => request()->getClientIp(),
            'data' => $data,
        ];
        // Create a handler
        $stream = new StreamHandler($file, Logger::INFO);
        $stream->setFormatter($formatter);

        // bind it to a logger object
        $securityLogger = new Logger($channel);
        $securityLogger->pushHandler($stream);
        $securityLogger->log('info', $channel, $log);
    }

    /**
     * get greetings here
     * @return string
     */
    public static function pass_greetings_to_user(): string
    {
        if (date("H") < 12) {
            return "Good Morning";
        } elseif (date("H") >= 12 && date("H") < 16) {
            return "Good Afternoon";
        } elseif (date("H") >= 16) {
            return "Good Evening";
        }
    }

    /**
     * Calculate the results for every rating out come
     * @param float $value
     * @return array
     */
    public static function base_rating_results(float $value): array
    {
        if ($value >= 1.0 && $value <= 1.99) {
            return [
                49,
                'GBE – Greatly Below Expectations',
                'Performance was consistently below expectations in most essential areas of responsibility,
and/or reasonable progress toward critical goals was not made.'
            ];
        } elseif ($value >= 2.0 && $value <= 2.99) {
            return [
                50,
                'BE – Below Expectations',
                'Performance did not consistently meet expectations. A Professional Development Plan to improve performance must be outlined in including timelines, and monitored to measure progress.'
            ];
        } elseif ($value >= 3.0 && $value <= 3.99) {
            return [
                100,
                'ME - Meets Expectations',
                'Performance consistently met expectations in all assigned areas of responsibility and the quality of work overall was very good. The most critical goals were met timely.'
            ];
        } elseif ($value >= 4.0 && $value <= 4.99) {
            return [
                150,
                'EE - Exceeds Expectations',
                'Performance consistently exceeded expectations beyond assigned areas of responsibility, and the quality of work overall was excellent. Set goals were executed with excellence.'
            ];
        } elseif ($value >= 5.0) {
            return [
                200,
                'GEE – Greatly Exceeds Expectations',
                'Performance far exceeded expectations due to exceptionally high quality of work performed in special projects, and delivered superior results outside normal scope of assigned duties and overall results were stratospheric/diligent!'
            ];
        } else {
            return [
                0,
                'No value given',
                'No value given'
            ];
        }
    }

    /**
     * get the weightage of each kra
     * @param string $roleSlug
     * @param string $section
     * @param int $arrayCount
     * @param float $rating
     * @param bool $getAverage
     * @return float|int
     */
    public static function calculate_weightage_rating(string $roleSlug, string $section, int $arrayCount, float $rating, bool $getAverage = false)
    {
        $average = $sum = 0;

        // check its an agent
        if ($roleSlug === 'bpo-executive') {
            for ($x = 1; $x <= $arrayCount; $x++) {
                if ($section === 'technical') {
                    if ($x == 1) {
                        $sum = (50 / 100) * $rating;
                    }
                    if ($x == 2) {
                        $sum = (30 / 100) * $rating;
                    }
                    if ($x == 3) {
                        $sum = (10 / 100) * $rating;
                    }
                    if ($x == 4) {
                        $sum = (10 / 100) * $rating;
                    }
                    if ($x == 5) {
                        $sum = $rating;
                    }
                    if ($x == 6) {
                        $sum = $rating;
                    }
                    if ($x == 7) {
                        $sum = $rating;
                    }

                    if ($getAverage) {
                        $average += $sum;
                    } else {
                        return $sum;
                    }
                }

                if ($section === 'behavioral') {
                    if ($x == 1) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 2) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 3) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 4) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 5) {
                        $sum = $rating;
                    }
                    if ($x == 6) {
                        $sum = $rating;
                    }
                    if ($x == 7) {
                        $sum = $rating;
                    }

                    if ($getAverage) {
                        $average += $sum;
                    } else {
                        return $sum;
                    }
                }
            }
            return ($average / $arrayCount);
        } else {
            for ($x = 1; $x <= $arrayCount; $x++) {
                if ($section === 'technical') {
                    if ($x == 1) {
                        $sum = (40 / 100) * $rating;
                    }
                    if ($x == 2) {
                        $sum = (20 / 100) * $rating;
                    }
                    if ($x == 3) {
                        $sum = (20 / 100) * $rating;
                    }
                    if ($x == 4) {
                        $sum = (10 / 100) * $rating;
                    }
                    if ($x == 5) {
                        $sum = $rating;
                    }
                    if ($x == 6) {
                        $sum = $rating;
                    }
                    if ($x == 7) {
                        $sum = $rating;
                    }

                    if ($getAverage) {
                        $average += $sum;
                    } else {
                        return $sum;
                    }
                }

                if ($section === 'behavioral' || $section === 'leadership') {
                    if ($x == 1) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 2) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 3) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 4) {
                        $sum = (25 / 100) * $rating;
                    }
                    if ($x == 5) {
                        $sum = $rating;
                    }
                    if ($x == 6) {
                        $sum = $rating;
                    }
                    if ($x == 7) {
                        $sum = $rating;
                    }

                    if ($getAverage) {
                        $average += $sum;
                    } else {
                        return $sum;
                    }
                }
            }
            return ($average / $arrayCount);
        }
    }

    /**
     * generate avatars here
     * @param string $name
     * @param int $size
     * @return LetterAvatar
     */
    public static function generateAvatars(string $name, int $size): LetterAvatar
    {
        return new LetterAvatar($name, 'square', $size);
    }

}
