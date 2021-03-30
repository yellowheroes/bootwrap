<?php
/**
 * Created by Yellow Heroes
 * Project: Bootwrap
 * File: Config.php
 * User: Robert
 * Date: 9/6/2020
 * Time: 22:09
 */

namespace yellowheroes\bootwrap\config;

class Config
{
    const DEBUG = false; // false to turn off debug info

    // environment
    const PRODUCTION = false; // set to true in PRODUCTION
    const DOMAIN = 'www.yellowheroes.com'; // your domain
    const APPLICATION_FOLDER = 'apps/mvc'; // app folder on PRODUCTION server (ROOT == '')

    private array $paths = []; // absolute paths to resources
    private array $roots = []; // uri, project and file-system root

    public function __construct()
    {
        $this->roots = $this->getRoots();
        $this->paths = $this->getPaths();
    }

    /**
     *  Builds a uri, project and file-system root
     *
     * @return array ['uri' => $uriRoot, 'project' => $projectRoot,
     *               'filesystem' => $fileSystemRoot]
     */
    public function getRoots(): array
    {
        /*
         * ---------------------------------------
         *                uri root
         * ---------------------------------------
         */
        $environment = (self::PRODUCTION) ? 'PRODUCTION' : 'DEVELOPMENT';
        $requestScheme = ($environment === 'PRODUCTION') ? 'https' : $_SERVER['REQUEST_SCHEME'];
        $domainName = ($environment === 'PRODUCTION') ? self::DOMAIN : $_SERVER['SERVER_NAME'];
        $scriptName = explode('/', $_SERVER['SCRIPT_NAME']);
        //@formatter:off
        if (self::PRODUCTION) {
            // e.g. https://www.yellowheroes.com/
            $applicationFolder = (self::APPLICATION_FOLDER !== '') ? self::APPLICATION_FOLDER . "/" : '';
            $uriRoot = $requestScheme . "://" . $domainName . "/" . $applicationFolder;
        } else {
            // e.g. http://localhost/php/projects/development/bootwrap/
            $uriRoot = $requestScheme . "://" . $domainName . "/" .
                $scriptName[1] . "/" . $scriptName[2] . "/" .
                $scriptName[3] . "/" . $scriptName[4] . "/";
        }
        //@formatter:on

        /*
         * ---------------------------------------
         *              project root
         * ---------------------------------------
         */
        $projectRoot = dirname(__DIR__, 2) . "/";

        /*
         * ---------------------------------------
         *            file system root
         * ---------------------------------------
         */
        $fileSystemRoot = $_SERVER['DOCUMENT_ROOT'] . "/";

        $roots = ['uri'        => $uriRoot, 'project' => $projectRoot,
                  'filesystem' => $fileSystemRoot,
        ];

        return $roots;
    }

    /**
     * Constructs absolute paths to endpoints/resources
     *
     * @return array
     */
    public function getPaths(): array
    {
        // $roots = ['uri' => '...', 'project' => '...', 'filesystem' => '...']
        $roots = $this->roots;

        // @formatter:off
        $paths = [
            /*
             * ---------------------------------------
             *            uri pages (paths)
             * ---------------------------------------
             */
            'root' => $roots['uri'],
            'index' => $roots['uri'] . 'index/',
            'contact' => $roots['uri'] . 'contact/',
            '404' => $roots['uri'] . 'pagenotfound/',

            /*
             * ---------------------------------------
             *       uri files (static assets)
             * ---------------------------------------
             */
            'assets' => $roots['uri'] . 'src/assets/',
            'js' => $roots['uri'] . 'src/assets/js/',
            'html' => $roots['uri'] . 'src/assets/html/',
            'css' => $roots['uri'] . 'src/assets/css/',

            /*
             * ---------------------------------------
             *    project directory (file includes)
             * ---------------------------------------
             */
            'views' => $roots['project'] . 'src/app/views/',
        ];
        // @formatter:on

        return $paths;
    }
}