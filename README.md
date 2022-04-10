# PHP Helper lib for [luka-dev/headless-task-server](https://github.com/luka-dev/headless-task-server-php)

This lib help to prepare request with your scraper script and parse response.

# Install
```bash
composer require luka-dev/headless-task-server-php
```

# Usage
- Connect to server
```php
use LuKa\HeadlessTaskServerPhp\Server;

//Let's created connection to specific server 
$server = new Server(
        'http://127.0.0.1:8080/', //Addres to your task-server
        'MySecretAuthKeyIfNeeded' //AUTH_KEY from server
    ); 
    
//This test will return true, if server work correct
$server->isAlive()
```
- Create Task
```php
//From var
$task = new Task('here you can past your js');

//OR

//From file
$task = Task::fromFile('./path/to/file.js');
```
- Set additional Options
```php
$options = new Options();

//Set locale for our browser
$options->setLocale('en-US');

//Set proxy for our browser (http or socks5)
$options->setUpstreamProxyUrl('http://username:password@proxy.com:80');
```
- Run Task and get Response
```php
$response = $server->runTask($task, $options);

//Get session
$session = $response->getSession();

//Check if Task DONE in correct way
$isDONE = $response->getStatus() === \LuKa\HeadlessTaskServerPhp\Enum\ResponseStatuses::DONE;

//Get Timings (How much time take to process this Task)
$timings = $response->getTimings()
//You can use this:
//$timings->getCreatedAt() 
//$timings->getBeginAt() 
//$timings->getEndAt()

//Here will be provided all output from `agent.output`
$output = $response->getOutput();
```