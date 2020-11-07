<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RssFeedController extends Controller
{
  public function getFeeds(Request $request)
  {
    try {
      //Validate to check lowercase and hyphens only
      $this->validate($request, [
        'section_name' => 'required|regex:/^[a-z-]+$/u',
      ]);
      $section_name = $request->section_name;
      //Checking  On Cache
      if (Cache::has($section_name)) {
        $resultData = Cache::get($section_name);
      } else {

        //Parameters to Pass In APi
        $params = [
          'section' => $section_name,
          'order-by' => 'newest',
          'api-key' => env("GUARDIAN_API_KEY", ""),
          'show-blocks' => 'body',
          'show-tags'=>'contributor'
          

        ];
        //Getting Response From Api
        
        $response = Http::get(
          'https://content.guardianapis.com/search?',
          $params
        );
        // $response =Http::get('https://content.guardianapis.com/search?api-key=2807070f-c6c0-4872-96dc-1d6760ae4d7d');

        $resultData = $response->json();

        //Creating cache
        Cache::put($section_name, $resultData, 600); //10 Minutes

       }
      $articles = $resultData['response']['results'];
      //Logging SuccessMessage In cutom Created channel to Store in Json Format


      $logMessage = [
        'section_name' => $section_name,
      ];
      Log::channel('LogsInJson')->info('Data Retrived From Api', $logMessage);
    } catch (Exception $e) {
      $error_message = $e->getMessage();
    
      //Logging Error Message
      $logMessage = [
        'error_message' => $error_message,
      ];
      Log::channel('LogsInJson')->error('Error Ocurred White Fetching data', $logMessage);
      return redirect()->back()->with([
        'error' => $error_message,
        'status' => $e->status
      ]);
    }

    return response()->view('rss-feeds', compact('articles','section_name'))->withHeaders([
      'Content-Type' => 'text/xml'
    ]);
  }
}
