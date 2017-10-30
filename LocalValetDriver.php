<? class LocalValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return void
     */
    public function serves($sitePath, $siteName, $uri)
    {
      return true;
    }

    /**
     * Determine if the incoming request is for a static file.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string|false
     */
    public function isStaticFile($sitePath, $siteName, $uri)
    {
      if ($this->isActualFile($staticFilePath = $sitePath . '/app' . $uri)) {
        return $staticFilePath;
      }

      return false;
    }

    /**
     * Determine the name of the directory where the front controller lives.
     *
     * @param  string  $sitePath
     * @return string
     */
    public function frontControllerDirectory($sitePath)
    {
      return '/app';
    }

    /**
     * Get the fully resolved path to the application's front controller.
     *
     * @param  string  $sitePath
     * @param  string  $siteName
     * @param  string  $uri
     * @return string
     */
    public function frontControllerPath($sitePath, $siteName, $uri)
    {
      // Force Kirby to use the HTTP host to generate its URLs, not whatever Caddy reports...
      $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];

      if (preg_match('/^\/panel/', $uri))
      {
        $_SERVER['SCRIPT_NAME'] = '/panel/index.php';
        return $sitePath . '/app/panel/index.php';
      }

      if (file_exists($indexPath = $sitePath . '/app/index.php'))
      {
        $_SERVER['SCRIPT_NAME'] = '/index.php';
        return $indexPath;
      }
    }
}
