<!DOCTYPE html>
<html lang="en" dir="ltr">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style media="screen">
body{
  text-align: center;
}
.table td, .table th{
  vertical-align: middle;
}

.table thead th{
  vertical-align: middle;
}
</style>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Home</title>
</head>


<body>

  <?php
  include_once 'navbar.php';
  include 'global_function.php';
  include 'function/function.php';
  ?>

  <div class="container">
    <h1 class="text-center">Report Performansi Teknisi</h1>
    <div class="row">
      <div class="container">
      <h1>Bootstrap Table</h1>

      <p>A table with third party integration  extension Filter control extension Data export</a> pour exporter</p>

      <div id="toolbar">
      		<select class="form-control">
      				<option value="">Export Basic</option>
      				<option value="all">Export All</option>
      				<option value="selected">Export Selected</option>
      		</select>
      </div>

      <table id="table"
      			 data-toggle="table"
      			 data-search="true"
      			 data-filter-control="true"
      			 data-show-export="true"
      			 data-click-to-select="true"
      			 data-toolbar="#toolbar"
             class="table-responsive">
      	<thead>
      		<tr>
      			<th data-field="state" data-checkbox="true"></th>
      			<th data-field="prenom" data-filter-control="input" data-sortable="true">First Name</th>
      			<th data-field="date" data-filter-control="select" data-sortable="true">Date</th>
      			<th data-field="examen" data-filter-control="select" data-sortable="true">Examination</th>
      			<th data-field="note" data-sortable="true">Note</th>
      		</tr>
      	</thead>
      	<tbody>
      		<tr>
      			<td class="bs-checkbox "><input data-index="0" name="btSelectItem" type="checkbox"></td>
      			<td>Jitender</td>
      			<td>01/09/2015</td>
      			<td>Français</td>
      			<td>12/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="1" name="btSelectItem" type="checkbox"></td>
      			<td>Jahid</td>
      			<td>05/09/2015</td>
      			<td>Philosophie</td>
      			<td>8/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="2" name="btSelectItem" type="checkbox"></td>
      			<td>Valentin</td>
      			<td>05/09/2015</td>
      			<td>Philosophie</td>
      			<td>4/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="3" name="btSelectItem" type="checkbox"></td>
      			<td>Milton</td>
      			<td>05/09/2015</td>
      			<td>Philosophie</td>
      			<td>10/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="4" name="btSelectItem" type="checkbox"></td>
      			<td>Gonesh</td>
      			<td>01/09/2015</td>
      			<td>Français</td>
      			<td>14/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="5" name="btSelectItem" type="checkbox"></td>
      			<td>Valérie</td>
      			<td>07/09/2015</td>
      			<td>Mathématiques</td>
      			<td>19/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="6" name="btSelectItem" type="checkbox"></td>
      			<td>Valentin</td>
      			<td>01/09/2015</td>
      			<td>Français</td>
      			<td>11/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="7" name="btSelectItem" type="checkbox"></td>
      			<td>Eric</td>
      			<td>01/10/2015</td>
      			<td>Philosophie</td>
      			<td>8/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="8" name="btSelectItem" type="checkbox"></td>
      			<td>Valentin</td>
      			<td>07/09/2015</td>
      			<td>Mathématiques</td>
      			<td>14/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="9" name="btSelectItem" type="checkbox"></td>
      			<td>Valérie</td>
      			<td>01/10/2015</td>
      			<td>Philosophie</td>
      			<td>12/20</td>
      		</tr>
      		<tr>
      			<td class="bs-checkbox "><input data-index="10" name="btSelectItem" type="checkbox"></td>
      			<td>Eric</td>
      			<td>07/09/2015</td>
      			<td>Mathématiques</td>
      			<td>14/20</td>
      		</tr>
      		<tr>
      		<td class="bs-checkbox "><input data-index="11" name="btSelectItem" type="checkbox"></td>
      			<td>Valentin</td>
      			<td>01/10/2015</td>
      			<td>Philosophie</td>
      			<td>10/20</td>
      		</tr>
      	</tbody>
      </table>
      </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
//exporte les données sélectionnées
var $table = $('#table');
  $(function () {
      $('#toolbar').find('select').change(function () {
          $table.bootstrapTable('refreshOptions', {
              exportDataType: $(this).val()
          });
      });
  })

  var trBoldBlue = $("table");

$(trBoldBlue).on("click", "tr", function (){
    $(this).toggleClass("bold-blue");
});
</script>

</body>
</html>
