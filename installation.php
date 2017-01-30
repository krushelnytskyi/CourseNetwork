<?php

// Allow execute this file only from command line
// Example: > php installation.php
if (php_sapi_name() === 'cli') {
    $installer = new Install;
    $installer->run();
}

/**
 * This class running installation exploded with steps.
 * To add new installation step - create public not static method
 * and add annotation @step to this method. Remember: order is strict.
 *
 * @see https://github.com/krushelnytskyi/CourseNetwork to more information
 * about installation. This class is not secure.
 *
 * Class Install
 */
class Install
{

    /**
     * General data defines
     */
    const MIN_PHP_VERSION = 7.0;

    /**
     * @step
     * Check software requirements
     *
     * @return void
     */
    public function checkSystem()
    {
        echo 'PHP Version: ' . phpversion() . PHP_EOL;

        $this->abortIf(static::MIN_PHP_VERSION > phpversion(), 'Minimum PHP Version: ' . static::MIN_PHP_VERSION);
    }

    /**
     * @step
     */
    public function installDatabase()
    {
        $dbForConnect = include 'config/database.php';

        try {
            $dsn = 'mysql:host=' . $dbForConnect['host'] .';dbname=;charset=utf8';
            $pdo = new PDO($dsn, $dbForConnect['username'], $dbForConnect['password']);

            $file = 'config/database/version_1.sql';

            if (true === file_exists($file)) {
                $file = file_get_contents($file);
                $pattern[0] = '/(\/\*.*)/';
                $queries = preg_replace($pattern, '', $file);
                $queries = explode(';', $queries);

                foreach ($queries as $query) {
                    $query = $pdo->prepare(trim($query . ';'));
                    $query->execute();
                }
            }

        } catch (PDOException $e) {
            $this->abort($e->getMessage());
        }
    }

    /**
     * @param string|bool $message Abort message
     * @return void
     */
    private function abort($message = false)
    {
        echo 'Aborting installation. ';

        if (false === $message) {
            echo 'Message: ' . $message;
        }

        echo PHP_EOL;
        exit(0);
    }

    /**
     * @param bool        $condition Condition to control aborting
     * @param string|bool $message   Abort Message
     *
     * @return void
     */
    private function abortIf($condition, $message = false)
    {
        if (true === $condition) {
            $this->abort($message);
        }
    }

    /**
     * Run Installation
     * @return void
     */
    public function run()
    {
        $methods = (new ReflectionClass(static::class))
            ->getMethods(ReflectionMethod::IS_PUBLIC);

        echo 'Starting installing process' . PHP_EOL;

        foreach ($methods as $method) {
            if (1 === preg_match('/[\s\t]+@step[\s\t]+/', $method->getDocComment())) {
                echo 'Installing step: ' . $method->getName() . PHP_EOL;
                $this->{$method->getName()}();
            }
        }

        echo 'Installation finished successfully' . PHP_EOL;
    }

}
