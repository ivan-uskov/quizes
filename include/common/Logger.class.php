<?

class Logger
{
    const FAST_LOG_FILE_NAME = 'FAST.log';

    public static function fastLog($message)
    {
        self::log(self::FAST_LOG_FILE_NAME, $message);
    }

    public static function fastExport($message)
    {
        self::fastLog(var_export($message, true));
    }

    public static function log($path, $message)
    {
        $path = Config::SITE_ROOT . Config::LOGS_DIR . $path;
        $str = '[' . date(DateTime::RFC1036) . ']' . ": " . $message . Config::NEW_LINE_CHAR;
        file_put_contents($path, $str, FILE_APPEND);
    }

    public static function logException($path, Exception $e)
    {
        $str = $e->getMessage() . Config::NEW_LINE_CHAR . $e->getTraceAsString() . Config::NEW_LINE_CHAR;
        self::log($path, $str);
    }
}