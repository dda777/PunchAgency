<?php

namespace App\Services;

use App\Models\User;
use Google\Client;
use Google\Exception;
use Google\Service\Sheets;
use Revolution\Google\Sheets\SheetsClient;

class GoogleSheetService
{
    /**
     * @throws Exception
     */
    public static function appendRowToUserSpreadsheet(array $data, User $user): void
    {
        if ($googleAuthData = $user->google_auth_data) {
            $authData = json_decode($googleAuthData, true);

            $client = new Client();
            $client->setScopes([Sheets::DRIVE, Sheets::SPREADSHEETS]);
            $client->setAuthConfig($authData['auth_config']);

            (new SheetsClient())
                ->setService(new Sheets($client))
                ->spreadsheet($authData['sheet_id'])
                ->sheet($authData['sheet_name'])
                ->append([array_values($data)]);

        }

    }
}
