<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\OAuth2\Client\Provider\GenericProvider;
use App\Models\EventOutlook;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class CreateOutlookEventJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var EventOutlook
     */
    protected $event;

    /**
     * Create a new job instance.
     *
     * @param EventOutlook $event
     */
    public function __construct(EventOutlook $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $client = new GenericProvider([
            'clientId' => env('APP_ID'),
            'clientSecret' => env('APP_SECRET'),
            'redirectUri' => env('REDIRECT_URI'),
            'urlAuthorize' => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
            'urlAccessToken' => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => 'https://graph.microsoft.com/v1.0/me',
        ]);

        $accessToken = $this->getAccessToken($client);

        $graphClient = new Client([
            'base_uri' => 'https://graph.microsoft.com/v1.0/',
            'headers' => [
                'Authorization' => "Bearer {$accessToken}",
            ]
        ]);

        $eventData = [
            'subject' => $this->event->title,
            'body' => [
                'content' => $this->event->description,
            ],
            'start' => [
                'dateTime' => $this->event->start_date->toIso8601String(),
            ],
            'end' => [
                'dateTime' => $this->event->end_date->toIso8601String(),
            ],
        ];

        $response = $graphClient->post("/me/calendars/{calendarId}/events", [
            'json' => $eventData,
        ]);

        $this->handleResponse($response);
    }

    /**
     * Get access token from Microsoft Graph API.
     *
     * @param GenericProvider $client
     * @return string
     */
    private function getAccessToken(GenericProvider $client): string
    {
        // Implement OAuth2 flow to obtain access token
        // using the provided client and user's credentials

        // ...
    }

    /**
     * Handle successful or failed response from the API.
     *
     * @param Response $response
     */
    private function handleResponse(Response $response): void
    {
        if ($response->getStatusCode() === 201) {
            // Event created successfully
        } else {
            // Handle error response
            // Log the error and potentially notify the user
        }
    }
}
