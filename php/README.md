# PallyCon PHP Token Sample 

## Requirements
- PHP Version 5.6 or later.
- Install Composer to use autoloader. 

## Quick Example
tests/SampleTest.php
```php
<?php
// Require the Composer autoloader.
require 'vendor/autoload.php';

use PallyCon\Exception\PallyConTokenException;
use PallyCon\PallyConDrmTokenClient;
use PallyCon\TokenBuilder;
use PallyCon\PlaybackPolicyRequest;

$config = include "config/config.php";

try{
    // TokenClient constructor
    $pallyConTokenClient = new PallyConDrmTokenClient();
    
    /* Create playback policy rule */
    // https://pallycon.com/docs/en/multidrm/license/license-token/#playback-policy
    
    //persistent : true / duration : 600
    $playbackPolicyRequest = new PlaybackPolicyRequest(true, 600);
    
    //SecurityPolicy: SecurityPolicyRequest.php
    //$securityPolicyRequest = new SecurityPolicyRequest("ALL");
    
    //ExternalKey: ExternalkeyRequest.php
    
    /* Build rule */
    //https://pallycon.com/docs/en/multidrm/license/license-token/#token-rule-json
    $policyRequest = (new TokenBuilder)
        ->playbackPolicy($playbackPolicyRequest)
    //->securityPolicy($securityPolicyRequest)
        ->build();
    
    /* Create token */
    // siteId, accessKey, siteKey, userId, cid, policy is required.
    // https://pallycon.com/docs/en/multidrm/license/license-token/#token-json-example
    $result = $pallyConTokenClient
        ->playReady()
        ->siteId($config["siteId"])
        ->accessKey($config["accessKey"])
        ->siteKey($config["siteKey"])
        ->userId("testUser")
        ->cid("testCID")
        ->policy($policyRequest)
        ->execute();    
    
}catch (PallyConTokenException $e){
    $result = $e->toString();
}
    echo $result;
?>


ExternalKeyRequest

```

