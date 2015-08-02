<?php namespace OmegaGate\Http\Controllers;

use OmegaGate\Http\Requests;
use OmegaGate\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ApiController  extends Controller {

    protected $statusCode = 200;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Respond with a standard formatted 400 error
     *
     * @param string $message
     * @return mixed
     */
    public function respondBadRequest($message = 'Bad request.') {
        return $this->setStatusCode(400)->respondWithError($message);
    }

    /**
     * Respond with a standard formatted 401 error
     *
     * @param string $message
     * @return mixed
     */
    public function respondUnauthorised($message = 'Unauthorised') {
        return $this->setStatusCode(401)->respondWithError($message);
    }

    /**
     * Respond with a standard formatted 403 error
     *
     * @param string $message
     * @return mixed
     */
    public function respondForbidden($message = 'Forbidden') {
        return $this->setStatusCode(403)->respondWithError($message);
    }

    /**
     * Respond with a standard formatted 404 error
     *
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not found.') {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * Respond with a standard formatted error
     *
     * @param $message
     * @return mixed
     */
    public function respondWithError($message) {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * Respond with JSON
     *
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = []) {
        return \Response::json($data, $this->getStatusCode(), $headers);
    }


}