<?php

namespace MVC\Controllers;

use MVC\Models\User;
use System\Auth\UserSession;
use System\Controller;
use System\Database\Connection;

/**
 * Class Payments
 * @package MVC\Controllers
 */
class Payments extends Controller
{
    /**
     * Verify Payments Action
     */
    public function verifyAction()
    {
        $this->getView()->view('payments/verify');
    }

    /**
     * Widthdraw Payments Action
     */
    public function withdrawAction()
    {
        $this->getView()->view('payments/withdraw');
    }
    
        /**
     * Transactions Payments Action
     */
    public function transactionsAction()
    {
        $this->getView()->view('payments/transactions');
    }
    
        /**
     * Deposit Payments Action
     */
    public function depositAction()
    {
        $this->getView()->view('payments/deposit');
    }

}
