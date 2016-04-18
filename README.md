This is a very simple CDN (Origin Pull) module for Drupal 8. Works with Amazon CloudFront.

Blog post URL: [https://www.chapterthree.com/blog/origin-pull-cdn-drupal-8](https://www.chapterthree.com/blog/origin-pull-cdn-drupal-8)

I used code from here: [http://www.metaltoad.com/blog/amazon-cloudfront-with-drupal-8](http://www.metaltoad.com/blog/amazon-cloudfront-with-drupal-8) with some improvements:
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
