<?php include 'includes/session.php'; ?>
<?php
  $where = '';
  if(isset($_GET['category'])){
    $id_category = $_GET['category'];
    $where = 'WHERE id_category ='.$id_category;
  }

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b>PRODUCTS</b>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form class="form-inline">
                  <div class="form-group">
                    <label>Category: </label>
                    <select class="form-control input-sm" id="select_category">
                      <option value="0">ALL</option>
                      <?php
                        $conn = $pdo->open();

                        $stmt = $conn->prepare("SELECT * FROM category where type != 'Services' and deleted_date = '0000-00-00' order by category asc");
                        $stmt->execute();

                        foreach($stmt as $crow){
                          $selected = ($crow['id_category'] == $id_category) ? 'selected' : ''; 
                          echo "
                            <option value='".$crow['id_category']."' ".$selected.">".$crow['category']."</option>
                          ";
                        }

                        $pdo->close();
                      ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>PHOTO</th>
                  <th>NAME</th>
                  <th>PRICE</th>
                </thead>
                <tbody>
                  <?php
                    $conn = $pdo->open();

                    try{
                      $now = date('Y-m-d');
                      $stmt = $conn->prepare("SELECT * FROM products order by name asc");
                      $stmt->execute();
                      foreach($stmt as $row){
                        $image = (!empty($row['photo'])) ? '../images/'.$row['photo'] : '../images/noimage.jpg';
                        echo "
                          <tr>
                            <td width='50'>
                              <img src='".$image."' height='100px' width='100px'>
                            </td>
                            <td>".$row['name']."</td>
                            <td>&#8369; ".number_format($row['price'], 2)."</td>
                          </tr>
                        ";
                      }
                    }
                    catch(PDOException $e){
                      echo $e->getMessage();
                    }

                    $pdo->close();
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  	<?php include 'includes/footer.php'; ?>
    <?php include 'includes/products_modal.php'; ?>
    <?php include 'includes/products_modal2.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $(document).on('click', '.edit', function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id_products = $(this).data('id');
    getRow(id_products);
  });

  $(document).on('click', '.delete', function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id_products = $(this).data('id');
    getRow(id_products);
  });
  
  $('#select_category').change(function(){
    if ($('#select_category').find(":selected").val()=='0'){
          getRow9();
      }
    else if ($('#select_category').find(":selected").val()=='1'){
          getRow9('1');
      }
    else if ($('#select_category').find(":selected").val()=='2'){
          getRow9('2');
      }
    else if ($('#select_category').find(":selected").val()=='3'){   
            getRow9('3');
      }
    else if ($('#select_category').find(":selected").val()=='4'){             
            getRow9('4');
      }
    else if ($('#select_category').find(":selected").val()=='5'){             
          getRow9('5');
    }
    else if ($('#select_category').find(":selected").val()=='6'){             
            getRow9('6');
      }
    else if ($('#select_category').find(":selected").val()=='7'){             
            getRow9('7');
      }
    else if ($('#select_category').find(":selected").val()=='8'){             
          getRow9('8');
    }
    else if ($('#select_category').find(":selected").val()=='9'){             
            getRow9('9');
    }
    else if ($('#select_category').find(":selected").val()=='10'){             
            getRow9('10');
    }
    else if ($('#select_category').find(":selected").val()=='15'){             
            getRow9('15');
    }
  });

  $('#addproduct').click(function(e){
    e.preventDefault();
    getCategory();
  });

  $("#addnew").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

  $("#edit").on("hidden.bs.modal", function () {
      $('.append_items').remove();
  });

});

function getRow(id_products){
  $.ajax({
    type: 'POST',
    url: 'products_row.php',
    data: {id_products:id_products},
    dataType: 'json',
    success: function(response){
      $('.name').html(response.name);
      $('.id_products').val(response.id_products);
	  $('#edit_selection').val(response.selection);
      $('#edit_name').val(response.name);
	  $('#edit_id_category').val(response.id_category);
      $('#catselected').val(response.id_category).html(response.category);
      $('#edit_price').val(response.price);
	  CKEDITOR.instances["editor2"].setData(response.details);
      getCategory();
    }
  });
}
function getCategory(){
  $.ajax({
    type: 'POST',
    url: 'category_fetch.php',
    dataType: 'json',
    success:function(response){
      $('#category').append(response);
      $('#edit_category').append(response);
    }
  });
}

function getRow9(id_category=''){
$.ajax({
type: 'POST',
url: 'products_query.php',
data: {id_category:id_category},
dataType: 'html',
success: function(response){
console.log(response);	
$('#example1 tbody').empty().html(response);
}
});
}
</script>
</body>
</html>
