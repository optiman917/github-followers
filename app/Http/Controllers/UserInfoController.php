<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserInfoController extends Controller {
    public function getGitHubUserInfo(Request $request) {
        $token = env('GITHUB_TOKEN');
        $username = $request->get('username');
        $url_t = "https://api.github.com/users/{$username}";

        // Make the GET request using Laravel's HTTP client
        $response = Http::withHeaders([
            'Authorization' => "token {$token}",
            'User-Agent' => 'localhost'
        ])->get($url_t);

        // Check if the request was successful
        if($response->successful()) {
            // Parse the JSON response
            $followers = $response->json();
            // Return the followers data
            return response()->json($followers);
        } else {
            // Handle the error case
            return response()->json(['error' => 'Failed to fetch followers'], 400);
        }
    }

    public function getGitFollowers($username, $page) {
        $token = env('GITHUB_TOKEN');
        $url = "https://api.github.com/users/{$username}/followers?page={$page}";

        // Make the GET request using Laravel's HTTP client
        $response = Http::withHeaders([
            'Authorization' => "token {$token}",
            'User-Agent' => 'localhost'
        ])->get($url);

        // Check if the request was successful
        if($response->successful()) {
            // Parse the JSON response
            $followers = $response->json();
            // Return the followers data
            return response()->json($followers);
        } else {
            // Handle the error case
            return response()->json(['error' => 'Failed to fetch followers'], 400);
        }
    }
}
