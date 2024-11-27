<?php
declare(strict_types=1);

namespace App\Controllers;

use App\View;

class HomeController
{
  public function index(): View
  {

    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    return View::make("index", "layout", ["foo"=>"bar"]);
  }

  public function download() {
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment;filename="myfile.pdf"');

    readfile(STORAGE_PATH .'/FullStack Developer.pdf');
  }

  public function upload()
  {
    $filepath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

    move_uploaded_file($_FILES['receipt']['tmp_name'], $filepath);

    // echo '<pre>';
    // var_dump(pathinfo($filepath));
    // echo '</pre>';
    header('Location: /');

    exit;
  }
}