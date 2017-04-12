# automated-tests-sample

Prerequisites:  
PHP 7(can be lower) and composer installed  
PHP extensions: php_curl and php_mbstring enabled in php.ini  
Firefox in version 46.0 (compatible with this selenium version)

Setup:  
Clone the above repository  
Run composer update  
In one tab start selenium server provided in the repostitory: "java -jar filename.jar"  
Make sure you have firefox installed (if you get error that selenium cannot find firefox you can start selenium server with this option "java -jar "filename.jar" -Dwebdriver.firefox.bin="path_to\firefox.exe""

Run:  
In order to run the tests simply do (in repository root): 
    "vendor/bin/behat -v -c src/config/behat.yml -s core"