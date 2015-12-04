# Installation
```bash
composer dump-autoload --optimize
```

# Usage

```php
$client = new MinhD\DataCite_Client($username, $password);
$xml = "<some sample XML here>";
$doi = "10.000/00/123456";
$url = "http://example.com";
$client->mint($doi, $url, $xml);
```
