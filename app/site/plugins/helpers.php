<? class Help {
  public static function body_classes ($extra = []) {
    if (isset($page)) {
      $pageClasses = [
        "document--uid-{$page->uid()}",
        "document--template-{$page->template()}"
      ];
    } else {
      $pageClasses = [];
    }

    $defaultClasses = [
      'document'
    ];

    $classes = array_merge($defaultClasses, $pageClasses, $extra);

    return implode(' ', array_unique($classes));
  }

  # Asset Fetcher
  public static function asset_url ($type, $filename) {
    return site()->url() . '/assets/' . $type . '/' . $filename;
  }

  # Asset Fetcher
  public static function asset_file ($type, $filename) {
    return new Media(kirby()->roots->assets() . DS . $type . DS . $filename);
  }

  # Asset Inliner
  public static function inline_asset ($type, $filename) {
    return static::asset_file($type, $filename)->content();
  }

  # Content Inliner
  public static function inline_content ($file) {
    return f::read($file);
  }

  # Versioned Asset URLs
  public static function versioned_asset_url ($type, $filename) {
    $file = static::asset_file($type, $filename);

    # url::build takes a hash of URL options, and a base URL:
    return url::build(['query' => ['mtime' => $file->modified()]], static::asset_url($type, $filename));
  }
}
