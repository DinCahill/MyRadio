<?php

namespace MyRadio\Iface;

/**
 * A standard interface for all ServiceAPI Classes. Implements the following
 * base functionality:
 * - Initialises a database connection on instantiation
 * - Initialises a cache connection on instantiation
 * - Restores the database and cache connections on restore
 * - A static factory to create an instance of the ServiceAPI Object.
 */
interface IServiceAPI
{
    /**
     * Reestablishes the database connection after being Cached.
     */
    public function __wakeup();

    public function toDataSource($full = false);

    /**
     * Static Factory method to setup an instance of a ServiceAPI Object.
     */
    public static function getInstance($serviceObjectId);
}
