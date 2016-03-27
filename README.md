This is a very simple CDN (pull origin only) module for Drupal 8. Works with Amazon CloudFront.

I used code from here: [http://www.metaltoad.com/blog/amazon-cloudfront-with-drupal-8 with](http://www.metaltoad.com/blog/amazon-cloudfront-with-drupal-8 with) some improvements:
- Fixed deprecated function calls.
- Added UI
- Configurable via settings.php

Configuration via settings.php

```
$config['cdn_pull_origin.settings'] = [
  // CDN could be conditionally disabled here.
  'enabled' => TRUE,
  'domain'  => 'https://d111111abcdef8.cloudfront.net',
];
```
