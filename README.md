# geofire-php
A PHP library for use with Firebase GeoFire

This package is based on the geofire-js project found at https://github.com/firebase/geofire-js

So far this is a direct port of some of the code specifically to enable PHP environments to calculate GeoHashes as used by Firebases's GeoFire.

It can be used with Kreait's firebase-php project found at https://github.com/kreait/firebase-php to add GeoFire Index data to Firebase Databases from PHP or Laravel.

It is intended to expand this library to allow all GeoFire functionality, however this initial version allows only for creating the GeoHashes needed for indexing.


USAGE:

See code in index.php for examples of how to create the index objects including geohashes, and additionally how to upload the indexes to Firebase.

For additional information, please visit the geofire-js and firebase-php projects on github linked above.