<?php
use Ratchet\ConnectionInterface;

/**
 * @package    phpi-websocket
 * @author     Michael Calcinai <michael@calcin.ai>
 *
 *
 * This class only exists to make the example easy to use.  It needs a lot more thought if/before it's actually used for a project.
 * I'd strongly recommend just using apache or nginx to serve the static content.
 *
 * You could alternatively use php's built in webserver if you're using a late enough version.
 *
 */
class ForExampleOnlyHTTPServer implements \Ratchet\Http\HttpServerInterface {

    private $path;

    public function __construct($path) {
        $this->path = $path;
    }


    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param  ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn) {
        // TODO: Implement onClose() method.
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param  ConnectionInterface $conn
     * @param  \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e) {
        // TODO: Implement onError() method.
    }

    /**
     * Triggered when a client sends data through the socket
     * @param  \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param  string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg) {
        // TODO: Implement onMessage() method.
    }

    /**
     * @param \Ratchet\ConnectionInterface $conn
     * @param \Guzzle\Http\Message\RequestInterface $request null is default because PHP won't let me overload; don't pass null!!!
     * @throws \UnexpectedValueException if a RequestInterface is not passed
     */
    public function onOpen(ConnectionInterface $conn, \Guzzle\Http\Message\RequestInterface $request = null) {
        $response = new \Guzzle\Http\Message\Response(200);
        $response->setBody(file_get_contents($this->path));
        $conn->send($response);
        $conn->close();
    }
}
