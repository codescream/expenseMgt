<?php
declare(strict_types=1);

namespace App\Controllers;

class Home
{
  public function index(): string
  {

    // echo "<pre>";
    // var_dump($_GET);
    // echo "</pre>";

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    return <<<FORM
      <form action='/upload' method='post' enctype='multipart/form-data'>
        <input type='file' name='receipt' />
        <button type='submit'>Upload</button>
      </form>
    FORM;
  }

  public function upload()
  {
    echo '<pre>';
    var_dump($_FILES);
    echo '</pre>';

    $filepath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

    move_uploaded_file($_FILES['receipt']['tmp_name'], $filepath);

    echo '<pre>';
    var_dump(pathinfo($filepath));
    echo '</pre>';
    // DIV;
  }
}