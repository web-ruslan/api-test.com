<?php

/**
 * Class Transaction
 */
class Transaction
{
    /**
     * @var string
     */
    private $user = 'user';
    /**
     * @var string
     */
    private $password = '123456';
    /**
     * @var array
     */
    private $statuses = array("rejected", "approved");

    /**
     * Transaction constructor.
     */
    function __construct()
    {
        $headers = getallheaders();
        if (isset($headers['Authorization'])) {
            $segments = explode(' ', $headers['Authorization']);
            if ($segments[0] == 'Basic') {
                $auth_segments = explode(':', base64_decode($segments[1]));
                if ($auth_segments[0] != $this->user || $auth_segments[1] != $this->password) {
                    $result = Array('status' => 'error', 'error_message' => 'Invalid Authorization');
                }
            } else {
                $result = Array('status' => 'error', 'error_message' => 'Invalid Method Authorization');
            }
        } else {
            $result = Array('status' => 'error', 'error_message' => 'Missing Authorization');
        }
        if (isset($result)) {
            echo json_encode($result);
            exit();
        }
    }

    /**
     * @param bool $email
     * @param bool $amount
     */
    public function index($email = false, $amount = false)
    {
        if ($email && $amount) {

            $active_index = array_rand($this->statuses);
            if ($this->statuses[$active_index] == "approved") {
                $result = Array('status' => $this->statuses[$active_index], 'transaction_ID' => sprintf('%09d', rand(999,999999999)));
            } else {
                $result = Array('status' => $this->statuses[$active_index], 'error_message' => 'Fraud detected!');
            }

        } else {
            $result = Array('status' => 'error', 'error_message' => 'Missing Parameters');
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
}