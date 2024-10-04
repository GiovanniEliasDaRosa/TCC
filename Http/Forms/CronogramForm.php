<?php

namespace Http\Forms;

use Exception;
use Core\ValidationException;

// autoload file from the library PHPSpreadsheet is already imported on the /public/index.php
// Import coordinate from the libary
use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;
// Import ability to read excel files from the libary
use \PhpOffice\PhpSpreadsheet\IOFactory;

class CronogramForm
{
  protected $errors = [];
  protected $filePath = null;
  protected $work = null;
  protected $lastRow = 0;
  protected $lastColumn = 0;

  public function __construct()
  {
    $filePath = base_path("public/uploads/");

    $target_dir = $filePath;
    $temp_name = $target_dir . basename($_FILES["upload__file"]["name"]);
    $fileType = strtolower(pathinfo($temp_name, PATHINFO_EXTENSION));
    $target_file = $target_dir . 'horario.' . $fileType;

    // Validate type of file
    if ($fileType != "xlsx") {
      $this->error("Faça upload de um arquivo EXCEL");
    }

    // Check file size
    if ($_FILES["upload__file"]["size"] > 500000) {
      $this->error("O arquivo é muito grande");
    }

    // If everything is OK, try to upload file
    if (!move_uploaded_file($_FILES["upload__file"]["tmp_name"], $target_file)) {
      $this->error("Um erro ocorreu ao tentar fazer upload do seu arquivo");
    }

    try {
      $path = $target_file;
      $spreadsheet = IOFactory::load($path);

      $reader = IOFactory::createReaderForFile($path);
      $reader->setReadDataOnly(true);

      $loadedfile = $reader->load($path);
      $this->work = $loadedfile->getSheet('1');
    } catch (Exception $e) {
      $this->invalidExcel();
    }

    $lastRow = $this->work->getHighestRow();
    $columnCount = $this->work->getHighestDataColumn();

    if ($lastRow != 98 || $columnCount != 'G') {
      $this->invalidExcel();
    }

    $this->lastRow = $lastRow;
    $this->lastColumn = Coordinate::columnIndexFromString($columnCount);
  }

  public function getWork()
  {
    return $this->work;
  }
  public function getLastRow()
  {
    return $this->lastRow;
  }
  public function getLastColumn()
  {
    return $this->lastColumn;
  }

  private function invalidExcel()
  {
    $this->error("Erro ao tentar ler arquivo EXCEL");
  }

  public function throw()
  {
    ValidationException::throw($this->errors);
  }

  public function error($message)
  {
    $this->errors['error'] = $message;
    return $this->throw();
  }
}
