<?php

use App\Geohash;

/* uncomment the following lines to use firebase-php library to upload the keys to Firebase Realtime Database */

/*
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
*/

class GeohashExample {

    public function AddToGeoFireIndex(){

        $locations = null;

        /* uncomment one of the following modes: */

        /* example use with a single location: */
        /*
        $keyOrLocations = 'keyToUseAsIndex';
        $location =  [51.1234567, -1.1234567];
        */

        // example use with array of locations
        /*
        $keyOrLocations = [
            "key1" => [51.1234567, -1.1234567],
            "key2" => [51.7654321, -1.7654321]
        ];
        */

        if (gettype($keyOrLocations) === 'string' && strlen($keyOrLocations) !== 0) {
            // If this is a set for a single location, convert it into a object
            $locations = [];
            $locations[$keyOrLocations] = $location;
        } else if (gettype($keyOrLocations) === 'object') {
            if (!isset($location)) {
                throw new \Error('The location argument should not be used if you pass an object to set().');
            }
            $locations = $keyOrLocations;
        } else {
            throw new \Error('keyOrLocations must be a string or a mapping of key - location pairs.');
        }

        $newData = [];
        foreach($locations as $key=>$location) {
            $geohasher = new Geohash();
            $geohasher->validateKey($key);
            if ($location === null) {
                // Setting location to null is valid since it will remove the key
                $newData[$key] = null;
            } else {
                $geohasher->validateLocation($location);
                $geohash = $geohasher->encodeGeohash($location);
                $newData[$key] = $geohasher->encodeGeoFireObject($location, $geohash);
            }
        }

        /* we now have an array of valid geofire index data */
        /* you can just return them with by uncommenting the following */

        /*
        return $newData;
        */

        /* or you can uncomment the following lines to use firebase-php library to upload the keys to Firebase Realtime Database */
        /* you will need so set some values for your own firebase instance */

        /*
        $serviceAccount = ServiceAccount::fromJsonFile('replace_with_path_to_prodServiceAccount.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('replace_with_uri_of firebase database_such as_https://example.firebaseio.com')
            ->create();
        $database = $firebase->getDatabase();

        $ref = $database->getReference('/replace_with_reference_for_database_location_of_geofire_index_such_as_/ExampleGeofireIndex');

        $ref->update($newData);

        echo('added to firebase.');

        */
    }
}