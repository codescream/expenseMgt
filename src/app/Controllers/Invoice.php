<?php

declare(strict_types=1);

namespace App\Controllers;

class Invoice
{
  public function index(): string
  {
    return "Invoice";
  }

  public function show(): string
  {
    return "<form action='/invoices/create' method='post'><label>Amount</label><input type='text' name='amount'></input><button type='submit'>Submit</button></form>";
  }
  public function create(): string
  {
    return 'creating';
  }
}