<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Illuminate\Support\Facades\Auth;
use Revolution\Google\Sheets\SheetsClient;

class GoogleSheetService
{
    public static function appendRowToUserSpreadsheet(array $data): void
    {
        $authData = json_decode(Auth::user()->google_auth_data, true);
        $client = new Client();
        $client->setScopes([Sheets::DRIVE, Sheets::SPREADSHEETS]);
        $client->setAuthConfig($authData['auth_config']);
        $sheets = new SheetsClient();
        $sheets->setService(new Sheets($client));
        $sheets->spreadsheet($authData['sheet_id'])->sheet($authData['sheet_name'])->append([array_values($data)]);
    }
}
