<?php
namespace App\Customs;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\InteractsWithTime;
use Illuminate\Session\DatabaseSessionHandler;
class CustomSessionHandler extends DatabaseSessionHandler {
    protected $container;

    public function __construct(
        ConnectionInterface $connection,
        string $table,
        int $minutes,
        ?Container $container = null
    ) {
        parent::__construct($connection, $table, $minutes, $container);
        $this->container = $container;
    }
    
    /**
     * Add the user information to the session payload.
     *
     * @param  array  $payload
     * @return $this
     */
    protected function addUserInformation(&$payload)
    {
        if ($this->container->bound(Guard::class)) {
            $payload['id_user'] = $this->userId();
        }

        return $this;
    }
}