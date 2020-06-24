<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<head>
  <title>Bulk Upload RE</title>
</head>
<body>

  <?php
  include_once '../navbar.php';
  include '../function/function.php';
  include_once '../function/preventaccess.php';
  ?>
  <div class="container">
    <h1 class="text-center"> Bulk Upload RE</h1>
    <form id="upload_csv" method="post" enctype="multipart/form-data">
      <div class="row">
        <div class="col-4">
          <label>Pilih File CSV</label>
          <input type="file" name="csv_file" id="csv_file" accept=".csv"/>
        </div>
        <div class="col offset-3">
          <input type="submit" name="upload" id="upload" value="Upload" style="margin-top:10px;" class="btn btn-info" />
          <input type="button" name="import" id="import_data" value="Import" style="margin-top:10px;" class="btn btn-success" />
        </div>
        <div class="col-3">

          <a class="btn-block btn btn-dark" role="button" href="template.csv" download="template.csv" style="margin-top:10px;"> Download Template</a>

        </div>
      </div>

      <div style="clear:both"></div>
    </form>
    <br />
    <br />
    <div id="csv_file_data"></div>

  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="process.js">    </script>
</body>
</html>
