<?php

return [

    'default' => [
        /*
        |--------------------------------------------------------------------------
        | Playcoind JSON-RPC Scheme
        |--------------------------------------------------------------------------
        | URI scheme of Playcoin Core's JSON-RPC server.
        |
        | Use 'https' scheme for SSL connection.
        | Note that you'll need to setup secure tunnel or reverse proxy
        | in order to access Playcoin Core via SSL.
        | See: https://playcoin.org/en/release/v0.12.0#rpc-ssl-support-dropped
        |
        */

        'scheme' => env('PLAYCOIND_SCHEME', 'http'),

        /*
        |--------------------------------------------------------------------------
        | Playcoind JSON-RPC Host
        |--------------------------------------------------------------------------
        | Tells service provider which hostname or IP address
        | Playcoin Core is running at.
        |
        | If Playcoin Core is running on the same PC as
        | laravel project use localhost or 127.0.0.1.
        |
        | If you're running Playcoin Core on the different PC,
        | you may also need to add rpcallowip=<server-ip-here> to your playcoin.conf
        | file to allow connections from your laravel client.
        |
        */

        'host' => env('PLAYCOIND_HOST', 'localhost'),

        /*
        |--------------------------------------------------------------------------
        | Playcoind JSON-RPC Port
        |--------------------------------------------------------------------------
        | The port at which Playcoin Core is listening for JSON-RPC connections.
        | Default is 8332 for mainnet and 18332 for testnet.
        | You can also directly specify port by adding rpcport=<port>
        | to playcoin.conf file.
        |
        */

        'port' => env('PLAYCOIND_PORT', 8335),

        /*
        |--------------------------------------------------------------------------
        | Playcoind JSON-RPC User
        |--------------------------------------------------------------------------
        | Username needs to be set exactly as in playcoin.conf file
        | rpcuser=<username>.
        |
        */

        'user' => env('PLAYCOIND_USER', ''),

        /*
        |--------------------------------------------------------------------------
        | Playcoind JSON-RPC Password
        |--------------------------------------------------------------------------
        | Password needs to be set exactly as in playcoin.conf file
        | rpcpassword=<password>.
        |
        */

        'password' => env('PLAYCOIND_PASSWORD', ''),

        /*
        |--------------------------------------------------------------------------
        | Playcoind JSON-RPC Server CA
        |--------------------------------------------------------------------------
        | If you're using SSL (https) to connect to your Playcoin Core
        | you can specify custom ca package to verify against.
        | Note that you'll need to setup secure tunnel or reverse proxy
        | in order to access Playcoin Core via SSL.
        | See: https://playcoin.org/en/release/v0.12.0#rpc-ssl-support-dropped
        |
        */

        'ca' => null,

        /*
        |--------------------------------------------------------------------------
        | Preserve method name case
        |--------------------------------------------------------------------------
        | Keeps method name case as defined in code when making a request,
        | instead of lowercasing them.
        | When this option is set to true, playcoind()->getBlock()
        | request will be sent to server as 'getBlock', when set to false
        | method name will be lowercased to 'getblock'.
        | For Playcoin Core leave as default(false), for ethereum
        | JSON-RPC API this must be set to true.
        |
        */
        'preserve_case' => false,

        /*
        |--------------------------------------------------------------------------
        | Playcoind ZeroMQ options
        |--------------------------------------------------------------------------
        | Used to subscribe to zeromq topics pushed by daemon.
        | In order to use this you mush install "denpaw\laravel-zeromq" package,
        | have Playcoin Core with zeromq support included and have zmqpubhashtx,
        | zmqpubhashblock, zmqpubrawblock and zmqpubrawtx options defined
        | in playcoind.conf.
        | For more information
        | visit https://laravel-playcoinrpc.denpaw.pro/docs/zeromq/
        |
        */

        /*
        |--------------------------------------------------------------------------
        | Playcoind timeout
        |--------------------------------------------------------------------------
        |
        | Times-out connection or request after this amount of seconds.
        | Set to false or 0 to wait indefinitely.
        |
        */
        'timeout' => false,

        'zeromq' => [
            'host' => 'localhost',
            'port' => 28338,
        ],
    ],

    'litecoin' => [
        'scheme'        => 'http',
        'host'          => 'localhost',
        'port'          => 9332,
        'user'          => '',
        'password'      => '',
        'ca'            => null,
        'preserve_case' => false,
        'timeout'       => false,
        'zeromq'        => null,
    ],
];
