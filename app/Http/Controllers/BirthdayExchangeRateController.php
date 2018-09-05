<?php

namespace App\Http\Controllers;

use App\BirthdayExchangeRate;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class BirthdayExchangeRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthdays = BirthdayExchangeRate::all()->sortByDesc('birthday');
        return view('index', compact('birthdays'));
    }

    /**
     * Searches for the exchange rate and creates the record if a successful result is found.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($birthday = -1)
    {
        if ($birthday == -1) {
            return \Response::json(array("success" => false, "error" => array("info" => "Invalid birthday date entered")));
        }

        // Check date is valid
        $date_validation = explode('-', $birthday);
        if (count($date_validation) < 3 || !checkdate($date_validation[1], $date_validation[2], $date_validation[0])) {
            return \Response::json(array("success" => false, "error" => array("info" => "Invalid birthday date entered")));
        }

        // Check date is within last year
        if (strtotime($birthday) < strtotime("-1 year")) {
            return \Response::json(array("success" => false, "error" => array("info" => "Selected birthday was older than 1 year ago")));
        }

        // Check date is not in the future
        if (strtotime($birthday) > strtotime("+1 day")) {
            return \Response::json(array("success" => false, "error" => array("info" => "Selected birthday is in the future!")));
        }

        // Connect to Fixer API using Guzzle and get the exchange rate
        $client = new Client();
        try {
            $res = $client->request('POST', 'http://data.fixer.io/api/' . $birthday, [
                'query' => [
                    'access_key' => config("app.fixer_api_key", "None Specified"),
                    'symbols' => config("app.exchange_currency", "SEK"),
                ],
            ]);
            $json_data = json_decode($res->getBody(), true);

            if (!$json_data["success"]) {
                if (array_key_exists("error", $json_data)) {
                    return \Response::json(array("success" => false, "error" => array("info" => $json_data["error"]["info"])));
                } else {
                    return \Response::json(array("success" => false, "error" => array("info" => "Failed to connect to exchange rate API endpoint")));
                }
            }

            // Save data to database
            if (BirthdayExchangeRate::where('birthday', $birthday)->exists()) {
                BirthdayExchangeRate::where('birthday', $birthday)->increment('search_count');
            }
            $birthday_data = BirthdayExchangeRate::updateOrCreate(['birthday' => $birthday], ['exchange_rate' => $json_data["rates"]["SEK"]]);
            if (is_null($birthday_data->search_count)) {
                $birthday_data->search_count = 1;
            }

            // Return data to front end so it can be updated without reloading the entire page
            return \Response::json(array("success" => true, "exchange_rate" => $birthday_data->exchange_rate, "search_count" => $birthday_data->search_count));
        } catch (RequestException $e) {
            return \Response::json(array("success" => false, "error" => array("info" => "Failed to retrive exchange rate data")));
        }
    }
}
