<?php

/**
 * Represents a connection to a set of memcached servers.
 *
 * @link http://php.net/class.memcached.php
 * @link https://github.com/php-memcached-dev/php-memcached/blob/master/memcached-api.php
 */
class Memcached  {


  // ------------------------------------------------------------------------------------------------------------------- Constants


  const COMPRESSION_FASTLZ = 0;
  const COMPRESSION_ZLIB = 0;
  const DISTRIBUTION_CONSISTENT = 0;
  const DISTRIBUTION_MODULA = 0;
  const DISTRIBUTION_VIRTUAL_BUCKET = 0;
  const GET_ERROR_RETURN_VALUE = false;
  const GET_PRESERVE_ORDER = 0;
  const HASH_CRC = 0;
  const HASH_DEFAULT = 0;
  const HASH_FNV1A_32 = 0;
  const HASH_FNV1A_64 = 0;
  const HASH_FNV1_32 = 0;
  const HASH_FNV1_64 = 0;
  const HASH_HSIEH = 0;
  const HASH_MD5 = 0;
  const HASH_MURMUR = 0;
  const HAVE_IGBINARY = 0;
  const HAVE_JSON = 0;
  const HAVE_SASL = 0;
  const HAVE_SESSION = 0;
  const OPT_AUTO_EJECT_HOSTS = 0;
  const OPT_BINARY_PROTOCOL = 0;
  const OPT_BUFFER_WRITES = 0;
  const OPT_CACHE_LOOKUPS = 0;
  const OPT_COMPRESSION = 0;
  const OPT_COMPRESSION_TYPE = 0;
  const OPT_CONNECT_TIMEOUT = 0;
  const OPT_DISTRIBUTION = 0;
  const OPT_HASH = 0;
  const OPT_HASH_WITH_PREFIX_KEY = 0;
  const OPT_LIBKETAMA_COMPATIBLE = 0;
  const OPT_LIBKETAMA_HASH = 0;
  const OPT_NOREPLY = 0;
  const OPT_NO_BLOCK = 0;
  const OPT_NUMBER_OF_REPLICAS = 0;
  const OPT_POLL_TIMEOUT = 0;
  const OPT_PREFIX_KEY = 0;
  const OPT_RANDOMIZE_REPLICA_READ = 0;
  const OPT_RECV_TIMEOUT = 0;
  const OPT_REMOVE_FAILED_SERVERS = 0;
  const OPT_RETRY_TIMEOUT = 0;
  const OPT_SEND_TIMEOUT = 0;
  const OPT_SERIALIZER = 0;
  const OPT_SERVER_FAILURE_LIMIT = 0;
  const OPT_SOCKET_RECV_SIZE = 0;
  const OPT_SOCKET_SEND_SIZE = 0;
  const OPT_SORT_HOSTS = 0;
  const OPT_TCP_KEEPALIVE = 0;
  const OPT_TCP_NODELAY = 0;
  const OPT_USE_UDP = 0;
  const OPT_VERIFY_KEY = 0;
  const RES_BAD_KEY_PROVIDED = 0;
  const RES_BUFFERED = 0;
  const RES_CLIENT_ERROR = 0;
  const RES_CONNECTION_SOCKET_CREATE_FAILURE = 0;
  const RES_DATA_EXISTS = 0;
  const RES_DELETED = 0;
  const RES_END = 0;
  const RES_ERRNO = 0;
  const RES_FAILURE = 0;
  const RES_FETCH_NOTFINISHED = 0;
  const RES_HOST_LOOKUP_FAILURE = 0;
  const RES_INVALID_HOST_PROTOCOL = 0;
  const RES_ITEM = 0;
  const RES_MEMORY_ALLOCATION_FAILURE = 0;
  const RES_NOTFOUND = 0;
  const RES_NOTSTORED = 0;
  const RES_NOT_SUPPORTED = 0;
  const RES_NO_SERVERS = 0;
  const RES_PARTIAL_READ = 0;
  const RES_PAYLOAD_FAILURE = 0;
  const RES_PROTOCOL_ERROR = 0;
  const RES_SERVER_ERROR = 0;
  const RES_SERVER_MARKED_DEAD = 0;
  const RES_SOME_ERRORS = 0;
  const RES_STAT = 0;
  const RES_STORED = 0;
  const RES_SUCCESS = 0;
  const RES_TIMEOUT = 0;
  const RES_UNKNOWN_READ_FAILURE = 0;
  const RES_UNKNOWN_STAT_KEY = 0;
  const RES_WRITE_FAILURE = 0;
  const SERIALIZER_IGBINARY = 0;
  const SERIALIZER_JSON = 0;
  const SERIALIZER_JSON_ARRAY = 0;
  const SERIALIZER_PHP = 0;


  // ------------------------------------------------------------------------------------------------------------------- Magic Methods


  /**
   * Instantiate new Memcached connection.
   *
   * @link http://php.net/memcached.construct.php
   * @param string $persistent_id [optional]
   *   By default the Memcached instances are destroyed at the end of the request. To create an instance that persists
   *   between requests, use <var>$persistent_id</var> to specify a unique ID for the instance. All instances created
   *   with the same <var>$persistent_id</var> will share the same connection.
   * @param mixed $callback [optional]
   *   This parameter is currently undocumented.
   * @since 0.1.0
   */
  public function __construct($persistent_id = "", callable $on_new_object_cb = null) {}


  // ------------------------------------------------------------------------------------------------------------------- Methods


  /**
   * Add new server to the pool
   *
   * Add the specified server to the pool. No connection is established to the server at this time, but if you are using
   * consistent key distribution option (via {@see \Memcached::DISTRIBUTION_CONSISTENT} or
   * {@see \Memcached::OPT_LIBKETAMA_COMPATIBLE}), some of the internal data structures will have to be udpated. Thus,
   * if you need to add multiple servers, it is better to use {@see \Memcached::addServers()} as the update then happens
   * only once.
   *
   * The same server may appear multiple times in the server pool, because no duplication checks are made. This is not
   * advisable; instead, use the <var>$weight</var> option to increase the selection weighting of this server.
   *
   * @link http://php.net/memcached.addserver.php
   * @param string $host
   *   The hostname of the memcache server. If the hostname is invalid, data-related operations will set
   *   {@see \Memcached::RES_HOST_LOOKUP_FAILURE} result code. You can specify the absolute path to a Unix socket here
   *   as well, the <var>$port</var> is then ignored (set it to <code>0</code>).
   * @param integer $port
   *   The port on which memcache is running. Usually, this is <code>11211</code>.
   * @param integer $weight [optional]
   *   The weight of the server relative to the total weight of all the servers in the pool. This controls the
   *   probability of the server being selected for operations. This is used only with consistent distribution option
   *   and usually corresponds to the amount of memory available to memcache on that server.
   * @return boolean
   *   Returns <code>TRUE</code> on success or <code>FALSE</code> on failure.
   * @since 0.1.0
   */
  public function addServer($host, $port, $weight = 0) {}

  /**
   * Add multipled servers to the pool
   *
   * @link http://php.net/memcached.addservers.php
   * @param array $servers
   *   Numeric array where each offsets value is another numeric array consisting of host, port and weight. Example:
   *   <code>array(0 => array("host", 1234, 1234))</code>.
   * @return boolean
   *   <code>TRUE</code> on success or <code>FALSE</code> on failure.
   * @since 0.1.0
   */
  public function addServers(array $servers) {}

  /**
   * Increment numeric item's value.
   *
   * @link http://php.net/memcached.increment.php
   * @param mixed $key
   *   They key of the item to increment.
   * @param integer $incrementBy [optional]
   *   The amount by which to increment the item's value.
   * @param integer $initialValue [optional]
   *   The value to set the item to if it doesn't currently exist. Please note that you have to use the binary protocol
   *   to use this parameter (<code>Memcached::setOption(Memcached::OPT_BINARY_PROTOCOL, true)</code>).
   * @param integer $expires [optional]
   *   The expiry time to set on the item. Please note htat you have to use the binary protocol to use this parameter
   *   (<code>Memcached::setOption(Memcached::OPT_BINARY_PROTOCOL, true)</code>).
   * @return integer
   *   The new item's value on success or <code>FALSE</code> on failure.
   * @since 0.1.0
   */
  public function increment($key, $incrementBy = 1, $initialValue = 0, $expires = 0) {}


  // ------------------------------------------------------------------------------------------------------------------- Original NetBeans Stubs


  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Increment numeric item's value
   * @link http://php.net/memcached.increment.php
   * @param string $key <p>
   * The key of the item to increment.
   * </p>
   * @param int $offset [optional] <p>
   * The amount by which to increment the item's value.
   * </p>
   * @param int $initial_value [optional] <p>
   * The value to set the item to if it doesn't currently exist.
   * </p>
   * @param int $expiry [optional] <p>
   * The expiry time to set on the item.
   * </p>
   * @return int new item's value on success or <b>FALSE</b> on failure.
   */
//  public function increment ($key, $offset = 1, $initial_value = 0, $expiry = 0) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Add a server to the server pool
   * @link http://php.net/memcached.addserver.php
   * @param string $host <p>
   * The hostname of the memcache server. If the hostname is invalid, data-related
   * operations will set
   * <b>Memcached::RES_HOST_LOOKUP_FAILURE</b> result code.
   * </p>
   * @param int $port <p>
   * The port on which memcache is running. Usually, this is
   * 11211.
   * </p>
   * @param int $weight [optional] <p>
   * The weight of the server relative to the total weight of all the
   * servers in the pool. This controls the probability of the server being
   * selected for operations. This is used only with consistent distribution
   * option and usually corresponds to the amount of memory available to
   * memcache on that server.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   */
//  public function addServer ($host, $port, $weight = 0) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Return the result code of the last operation
   * @link http://php.net/memcached.getresultcode.php
   * @return int Result code of the last Memcached operation.
   */
  public function getResultCode () {}

  /**
   * (PECL memcached &gt;= 1.0.0)<br/>
   * Return the message describing the result of the last operation
   * @link http://php.net/memcached.getresultmessage.php
   * @return string Message describing the result of the last Memcached operation.
   */
  public function getResultMessage () {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Retrieve an item
   * @link http://php.net/memcached.get.php
   * @param string $key <p>
   * The key of the item to retrieve.
   * </p>
   * @param callable $cache_cb [optional] <p>
   * Read-through caching callback or <b>NULL</b>.
   * </p>
   * @param float $cas_token [optional] <p>
   * The variable to store the CAS token in.
   * </p>
   * @return mixed the value stored in the cache or <b>FALSE</b> otherwise.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTFOUND</b> if the key does not exist.
   */
  public function get ($key, callable $cache_cb = null, &$cas_token = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Retrieve an item from a specific server
   * @link http://php.net/memcached.getbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key of the item to fetch.
   * </p>
   * @param callable $cache_cb [optional] <p>
   * Read-through caching callback or <b>NULL</b>
   * </p>
   * @param float $cas_token [optional] <p>
   * The variable to store the CAS token in.
   * </p>
   * @return mixed the value stored in the cache or <b>FALSE</b> otherwise.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTFOUND</b> if the key does not exist.
   */
  public function getByKey ($server_key, $key, callable $cache_cb = null, &$cas_token = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Retrieve multiple items
   * @link http://php.net/memcached.getmulti.php
   * @param array $keys <p>
   * Array of keys to retrieve.
   * </p>
   * @param array $cas_tokens [optional] <p>
   * The variable to store the CAS tokens for the found items.
   * </p>
   * @param int $flags [optional] <p>
   * The flags for the get operation.
   * </p>
   * @return mixed the array of found items or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function getMulti (array $keys, array &$cas_tokens = null, $flags = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Retrieve multiple items from a specific server
   * @link http://php.net/memcached.getmultibykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param array $keys <p>
   * Array of keys to retrieve.
   * </p>
   * @param string $cas_tokens [optional] <p>
   * The variable to store the CAS tokens for the found items.
   * </p>
   * @param int $flags [optional] <p>
   * The flags for the get operation.
   * </p>
   * @return array the array of found items or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function getMultiByKey ($server_key, array $keys, &$cas_tokens = null, $flags = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Request multiple items
   * @link http://php.net/memcached.getdelayed.php
   * @param array $keys <p>
   * Array of keys to request.
   * </p>
   * @param bool $with_cas [optional] <p>
   * Whether to request CAS token values also.
   * </p>
   * @param callable $value_cb [optional] <p>
   * The result callback or <b>NULL</b>.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function getDelayed (array $keys, $with_cas = null, callable $value_cb = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Request multiple items from a specific server
   * @link http://php.net/memcached.getdelayedbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param array $keys <p>
   * Array of keys to request.
   * </p>
   * @param bool $with_cas [optional] <p>
   * Whether to request CAS token values also.
   * </p>
   * @param callable $value_cb [optional] <p>
   * The result callback or <b>NULL</b>.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function getDelayedByKey ($server_key, array $keys, $with_cas = null, callable $value_cb = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Fetch the next result
   * @link http://php.net/memcached.fetch.php
   * @return array the next result or <b>FALSE</b> otherwise.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_END</b> if result set is exhausted.
   */
  public function fetch () {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Fetch all the remaining results
   * @link http://php.net/memcached.fetchall.php
   * @return array the results or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function fetchAll () {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Store an item
   * @link http://php.net/memcached.set.php
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function set ($key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Store an item on a specific server
   * @link http://php.net/memcached.setbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function setByKey ($server_key, $key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Set a new expiration on an item
   * @link http://php.net/memcached.touch.php
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param int $expiration <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function touch ($key, $expiration) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Set a new expiration on an item on a specific server
   * @link http://php.net/memcached.touchbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param int $expiration <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function touchByKey ($server_key, $key, $expiration) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Store multiple items
   * @link http://php.net/memcached.setmulti.php
   * @param array $items <p>
   * An array of key/value pairs to store on the server.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function setMulti (array $items, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Store multiple items on a specific server
   * @link http://php.net/memcached.setmultibykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param array $items <p>
   * An array of key/value pairs to store on the server.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function setMultiByKey ($server_key, array $items, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Compare and swap an item
   * @link http://php.net/memcached.cas.php
   * @param float $cas_token <p>
   * Unique value associated with the existing item. Generated by memcache.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_DATA_EXISTS</b> if the item you are trying
   * to store has been modified since you last fetched it.
   */
  public function cas ($cas_token, $key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Compare and swap an item on a specific server
   * @link http://php.net/memcached.casbykey.php
   * @param float $cas_token <p>
   * Unique value associated with the existing item. Generated by memcache.
   * </p>
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_DATA_EXISTS</b> if the item you are trying
   * to store has been modified since you last fetched it.
   */
  public function casByKey ($cas_token, $server_key, $key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Add an item under a new key
   * @link http://php.net/memcached.add.php
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key already exists.
   */
  public function add ($key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Add an item under a new key on a specific server
   * @link http://php.net/memcached.addbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key already exists.
   */
  public function addByKey ($server_key, $key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Append data to an existing item
   * @link http://php.net/memcached.append.php
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param string $value <p>
   * The string to append.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key does not exist.
   */
  public function append ($key, $value) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Append data to an existing item on a specific server
   * @link http://php.net/memcached.appendbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param string $value <p>
   * The string to append.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key does not exist.
   */
  public function appendByKey ($server_key, $key, $value) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Prepend data to an existing item
   * @link http://php.net/memcached.prepend.php
   * @param string $key <p>
   * The key of the item to prepend the data to.
   * </p>
   * @param string $value <p>
   * The string to prepend.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key does not exist.
   */
  public function prepend ($key, $value) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Prepend data to an existing item on a specific server
   * @link http://php.net/memcached.prependbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key of the item to prepend the data to.
   * </p>
   * @param string $value <p>
   * The string to prepend.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key does not exist.
   */
  public function prependByKey ($server_key, $key, $value) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Replace the item under an existing key
   * @link http://php.net/memcached.replace.php
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key does not exist.
   */
  public function replace ($key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Replace the item under an existing key on a specific server
   * @link http://php.net/memcached.replacebykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key under which to store the value.
   * </p>
   * @param mixed $value <p>
   * The value to store.
   * </p>
   * @param int $expiration [optional] <p>
   * The expiration time, defaults to 0. See Expiration Times for more info.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTSTORED</b> if the key does not exist.
   */
  public function replaceByKey ($server_key, $key, $value, $expiration = null) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Delete an item
   * @link http://php.net/memcached.delete.php
   * @param string $key <p>
   * The key to be deleted.
   * </p>
   * @param int $time [optional] <p>
   * The amount of time the server will wait to delete the item.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTFOUND</b> if the key does not exist.
   */
  public function delete ($key, $time = 0) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Delete multiple items
   * @link http://php.net/memcached.deletemulti.php
   * @param array $keys <p>
   * The keys to be deleted.
   * </p>
   * @param int $time [optional] <p>
   * The amount of time the server will wait to delete the items.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTFOUND</b> if the key does not exist.
   */
  public function deleteMulti (array $keys, $time = 0) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Delete an item from a specific server
   * @link http://php.net/memcached.deletebykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key to be deleted.
   * </p>
   * @param int $time [optional] <p>
   * The amount of time the server will wait to delete the item.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTFOUND</b> if the key does not exist.
   */
  public function deleteByKey ($server_key, $key, $time = 0) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Delete multiple items from a specific server
   * @link http://php.net/memcached.deletemultibykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param array $keys <p>
   * The keys to be deleted.
   * </p>
   * @param int $time [optional] <p>
   * The amount of time the server will wait to delete the items.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * The <b>Memcached::getResultCode</b> will return
   * <b>Memcached::RES_NOTFOUND</b> if the key does not exist.
   */
  public function deleteMultiByKey ($server_key, array $keys, $time = 0) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Decrement numeric item's value
   * @link http://php.net/memcached.decrement.php
   * @param string $key <p>
   * The key of the item to decrement.
   * </p>
   * @param int $offset [optional] <p>
   * The amount by which to decrement the item's value.
   * </p>
   * @param int $initial_value [optional] <p>
   * The value to set the item to if it doesn't currently exist.
   * </p>
   * @param int $expiry [optional] <p>
   * The expiry time to set on the item.
   * </p>
   * @return int item's new value on success or <b>FALSE</b> on failure.
   */
  public function decrement ($key, $offset = 1, $initial_value = 0, $expiry = 0) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Increment numeric item's value, stored on a specific server
   * @link http://php.net/memcached.incrementbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key of the item to increment.
   * </p>
   * @param int $offset [optional] <p>
   * The amount by which to increment the item's value.
   * </p>
   * @param int $initial_value [optional] <p>
   * The value to set the item to if it doesn't currently exist.
   * </p>
   * @param int $expiry [optional] <p>
   * The expiry time to set on the item.
   * </p>
   * @return int new item's value on success or <b>FALSE</b> on failure.
   */
  public function incrementByKey ($server_key, $key, $offset = 1, $initial_value = 0, $expiry = 0) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Decrement numeric item's value, stored on a specific server
   * @link http://php.net/memcached.decrementbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @param string $key <p>
   * The key of the item to decrement.
   * </p>
   * @param int $offset [optional] <p>
   * The amount by which to decrement the item's value.
   * </p>
   * @param int $initial_value [optional] <p>
   * The value to set the item to if it doesn't currently exist.
   * </p>
   * @param int $expiry [optional] <p>
   * The expiry time to set on the item.
   * </p>
   * @return int item's new value on success or <b>FALSE</b> on failure.
   */
  public function decrementByKey ($server_key, $key, $offset = 1, $initial_value = 0, $expiry = 0) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Get the list of the servers in the pool
   * @link http://php.net/memcached.getserverlist.php
   * @return array The list of all servers in the server pool.
   */
  public function getServerList () {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Map a key to a server
   * @link http://php.net/memcached.getserverbykey.php
   * @param string $server_key <p>
   * The key identifying the server to store the value on or retrieve it from. Instead of hashing on the actual key for the item, we hash on the server key when deciding which memcached server to talk to. This allows related items to be grouped together on a single server for efficiency with multi operations.
   * </p>
   * @return array an array containing three keys of host,
   * port, and weight on success or <b>FALSE</b>
   * on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function getServerByKey ($server_key) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Clears all servers from the server list
   * @link http://php.net/memcached.resetserverlist.php
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   */
  public function resetServerList () {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Close any open connections
   * @link http://php.net/memcached.quit.php
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   */
  public function quit () {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Get server pool statistics
   * @link http://php.net/memcached.getstats.php
   * @return array Array of server statistics, one entry per server.
   */
  public function getStats () {}

  /**
   * (PECL memcached &gt;= 0.1.5)<br/>
   * Get server pool version info
   * @link http://php.net/memcached.getversion.php
   * @return array Array of server versions, one entry per server.
   */
  public function getVersion () {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Gets the keys stored on all the servers
   * @link http://php.net/memcached.getallkeys.php
   * @return array the keys stored on all the servers on success or <b>FALSE</b> on failure.
   */
  public function getAllKeys () {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Invalidate all items in the cache
   * @link http://php.net/memcached.flush.php
   * @param int $delay [optional] <p>
   * Numer of seconds to wait before invalidating the items.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   * Use <b>Memcached::getResultCode</b> if necessary.
   */
  public function flush ($delay = 0) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Retrieve a Memcached option value
   * @link http://php.net/memcached.getoption.php
   * @param int $option <p>
   * One of the Memcached::OPT_* constants.
   * </p>
   * @return mixed the value of the requested option, or <b>FALSE</b> on
   * error.
   */
  public function getOption ($option) {}

  /**
   * (PECL memcached &gt;= 0.1.0)<br/>
   * Set a Memcached option
   * @link http://php.net/memcached.setoption.php
   * @param int $option
   * @param mixed $value
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   */
  public function setOption ($option, $value) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Set Memcached options
   * @link http://php.net/memcached.setoptions.php
   * @param array $options <p>
   * An associative array of options where the key is the option to set and
   * the value is the new value for the option.
   * </p>
   * @return bool <b>TRUE</b> on success or <b>FALSE</b> on failure.
   */
  public function setOptions (array $options) {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Check if a persitent connection to memcache is being used
   * @link http://php.net/memcached.ispersistent.php
   * @return bool true if Memcache instance uses a persistent connection, false otherwise.
   */
  public function isPersistent () {}

  /**
   * (PECL memcached &gt;= 2.0.0)<br/>
   * Check if the instance was recently created
   * @link http://php.net/memcached.ispristine.php
   * @return bool the true if instance is recently created, false otherwise.
   */
  public function isPristine () {}

}

/**
 * @link http://php.net/class.memcachedexception.php
 */
class MemcachedException extends RuntimeException  {
  protected $message;
  protected $code;
  protected $file;
  protected $line;


  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Clone the exception
   * @link http://php.net/exception.clone.php
   * @return void No value is returned.
   */
  final private function __clone () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Construct the exception
   * @link http://php.net/exception.construct.php
   * @param $message [optional]
   * @param $code [optional]
   * @param $previous [optional]
   */
  public function __construct ($message, $code, $previous) {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Gets the Exception message
   * @link http://php.net/exception.getmessage.php
   * @return string the Exception message as a string.
   */
  final public function getMessage () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Gets the Exception code
   * @link http://php.net/exception.getcode.php
   * @return mixed the exception code as integer in
   * <b>Exception</b> but possibly as other type in
   * <b>Exception</b> descendants (for example as
   * string in <b>PDOException</b>).
   */
  final public function getCode () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Gets the file in which the exception occurred
   * @link http://php.net/exception.getfile.php
   * @return string the filename in which the exception was created.
   */
  final public function getFile () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Gets the line in which the exception occurred
   * @link http://php.net/exception.getline.php
   * @return int the line number where the exception was created.
   */
  final public function getLine () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Gets the stack trace
   * @link http://php.net/exception.gettrace.php
   * @return array the Exception stack trace as an array.
   */
  final public function getTrace () {}

  /**
   * (PHP 5 &gt;= 5.3.0)<br/>
   * Returns previous Exception
   * @link http://php.net/exception.getprevious.php
   * @return Exception the previous <b>Exception</b> if available
   * or <b>NULL</b> otherwise.
   */
  final public function getPrevious () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * Gets the stack trace as a string
   * @link http://php.net/exception.gettraceasstring.php
   * @return string the Exception stack trace as a string.
   */
  final public function getTraceAsString () {}

  /**
   * (PHP 5 &gt;= 5.1.0)<br/>
   * String representation of the exception
   * @link http://php.net/exception.tostring.php
   * @return string the string representation of the exception.
   */
  public function __toString () {}

}
// End of memcached v.2.1.0
?>
