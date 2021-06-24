<?php defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Google Calendar - Internal Configuration
|--------------------------------------------------------------------------
|
| Declare some of the global config values of the Google Calendar
| synchronization feature.
|
*/

 $config['google_sync_feature'] = getenv('GOOGLE_SYNC_FEATURE') ?? false;
 $config['google_product_name'] = getenv('GOOGLE_PRODUCT_NAME');
 $config['google_client_id'] = getenv('GOOGLE_CLIENT_ID');
 $config['google_client_secret'] = getenv('GOOGLE_CLIENT_SECRET');
 $config['google_api_key'] = getenv('GOOGLE_API_KEY');
