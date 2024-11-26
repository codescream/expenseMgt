<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class InvoiceController
{
  public function index(): View
  {
    return View::make("invoices/index", "layout", params: ["foo"=>"bar"]);
  }

  public function show(): View
  {
    return View::make("invoices/show", "layout");
  }
  public function create(): View
  {
    return View::make("invoices/create", "layout");
  }
}