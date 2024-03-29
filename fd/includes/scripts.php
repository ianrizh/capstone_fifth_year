<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Moment JS -->
<script src="../bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->

<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- CK Editor -->
<script src="../bower_components/ckeditor/ckeditor.js"></script>
<!-- Number Format -->
<script src="../bower_components/jquery-number/jquery.number.min.js"></script>
<!-- Active Script -->
<script>
$(function(){
	/** add active class and stay opened when selected */
	var url = window.location;
  
	// for sidebar menu entirely but not cover treeview
	$('ul.sidebar-menu a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
	    return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

});
</script>
<!-- Data Table Initialize -->
<script>
$('#addnew').on('change','#expdate',function(){
    if($(this).val() != "")
      $('#expdate1').attr('disabled','true');
    else
      $('#expdate1').removeAttr('disabled');
  });

  $('#addnew').on('click','#addstock',function(){
    var arr_product = $('.stock_product'),
        arr_quantity = $('.stock_quantity'),
        expired_date = $('#expdate');

    var a_product = [],
        a_quantity = [];

    for(var i=0; i < arr_product.length; i++)
    { 
      if($(arr_product[i]).val() == 0)
      {
        alert("Please specify product");
        return false;
      }
      a_product.push($(arr_product[i]).val());
      
      if($(arr_quantity[i]).val() == "" || $(arr_quantity[i]).val() == 0)
      {
        alert("Please specify quantity");
        return false;
      }
      a_quantity.push($(arr_quantity[i]).val());
    }

    if(!(expired_date.prop('disabled')) && expired_date.val() == '')
    {
      alert('Please set an expiration date.');
    }
    else
    {
      $.ajax({
        url : 'expired_add.php',
        type : 'POST',
        data : {
                a_product : a_product,
                a_quantity : a_quantity,
                expired_date : expired_date.val()
              },
        success: function(response){
                $('#addnew').modal('hide');
                $('#alert_container').html("\
                    <div class='alert alert-success alert-dismissible'>\
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\
                      <h4><i class='icon fa fa-check'></i> Success!</h4>"
                      +response+
                      "</div>\
                  ");
              },
        error: function(response){
                $('#addnew').modal('hide');
                $('#alert_container').html("\
                  <div class='alert alert-danger alert-dismissible'>\
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\
                    <h4><i class='icon fa fa-warning'></i> Ooops!</h4>"
                    +response+
                  "</div>\
                ");
              }
      })
    }
  });

  $('#btn_addproduct').click(function(){
    var row = $('#tbl_stock > tbody > tr').last();
    var newrow = row.clone(row);
    var tbody = row.closest('tbody');
    tbody.append(newrow);
    $('input',newrow).val('');
  });

  // $('.btn_deleterow').click(function(){
  //   var row = $(this).closest('tr');
  //   var tbody = $('#tbl_stock > tbody');
  //   if($('tr',tbody).length > 1)
  //     row.remove();
  //   else
  //   {
  //     $('input',row).val('');
  //   }
  // });

  $(function () {

    $('#example1').DataTable({
      "order": [],
      responsive: true,

    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })

    $('.order_quantity',$('#tab_orders')).number(true,0);
    $('.order_price',$('#tab_orders')).number(true,2);
    $('.order_amount',$('#tab_orders')).number(true,2);
    $('#order_cash',$('#tab_orders')).number(true,2);
    $('#order_total',$('#tab_orders')).number(true,2);

    $('#btn_addorder').click(function(){
      var row = $('#tbl_orders > tbody > tr').last();
      var newrow = row.clone(row);
      var tbody = row.closest('tbody');
      tbody.append(newrow);
      $('input',newrow).val('');
    });

    $('.btn_deleterow').click(function(){
      var row = $(this).closest('tr');
      var tbody = $(this).closest('tbody');
      if($('tr',tbody).length > 1)
        row.remove();
      else
      {
        $('input',row).val('');
      }
    });

    $('#btn_addorder1').click(function(){
      var row = $('#tbl_orders > tbody > tr').last();
      var newrow = row.clone(row);
      var tbody = row.closest('tbody');
      tbody.append(newrow);
      $('input',newrow).val('');
    });

    $('.btn_deleterow1').click(function(){
      var row = $(this).closest('tr');
      var tbody = $('#tbl_orders > tbody');
      if($('tr',tbody).length > 1)
        row.remove();
      else
      {
        $('input',row).val('');
      }
    });

    $('.order_product').change(function(){
      var dropdown = $(this);
      var thisrow = dropdown.closest('tr');
      var value = dropdown.val();
      var price = $('option[value="'+value+'"]',dropdown).data('price');
      $('.order_price',thisrow).val(price);
      compute_amount(thisrow);
      compute_total();
      // compute_change();
    });

    $('#tbl_orders').on('keyup change','.order_quantity',function(event){
      var thisrow = $(this).closest('tr');

      compute_amount(thisrow);
      compute_total();
      // compute_change();
    });

    $('#order_cash').blur(function(){
      // compute_change();
      var cash = $(this).val();
      if(cash != "")
        $(this).val(parseFloat(cash).toFixed(2));
    });

    $('#grooming_products_toggle').click(function(){
      if(document.getElementById('grooming_products_toggle').checked)
        $('#grooming_products').attr('style','display:block');
      else
        $('#grooming_products').attr('style','display:none');
    });

    $('#btn_viewsummary').click(function(){
      var arr_product = $('.order_product'),
          arr_product_text = [],
          arr_quantity = $('.order_quantity'),
          arr_price = $('.order_price'),
          arr_amount = $('.order_amount'),
          cash = parseFloat($('#order_cash').val()) || 0,
          total = parseFloat($('#order_total').val()),
          change = (cash - total).toFixed(2);

      var a_product = [],
          a_quantity = [];

      for(var i=0; i < arr_product.length; i++)
      { 
        arr_product_text[i] = $('option:selected',arr_product[i]).text();
        
        if($(arr_product[i]).val() == 0)
        {
          alert("Please specify product");
          return false;
        }
        arr_product[i] = $(arr_product[i]).val();
        a_product.push(arr_product[i]);
        
        if($(arr_quantity[i]).val() == "" || $(arr_quantity[i]).val() == 0)
        {
          alert("Please specify quantity");
          return false;
        }
        arr_quantity[i] = $(arr_quantity[i]).val();
        a_quantity.push(arr_quantity[i]);
        
        arr_price[i] = $(arr_price[i]).val();
        arr_amount[i] = $(arr_amount[i]).val();
      }
      
      $.ajax({
        url       : 'orders_validate_qty.php',
        data      : {
          a_product : a_product,
          a_quantity : a_quantity
        },
        dataType  : 'JSON',
        method    : 'POST',
        beforeSend: function(){
          $('#btn_viewsummary').prop('disabled',true).html('Validating...');
        },
        success   : function(response){
          var list = '<ul>';
          if(response.length > 0)
          {
            $(response).each(function(idx,val){
              list += '<li>'+val+'</li>';
            });
            list += '</ul>';
            $('#insufficiientproducts_container').html("\
              <div class='alert alert-danger alert-dismissible'>\
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\
                <h4><i class='icon fa fa-warning'></i> Ooops!</h4>\
                The following products have insufficient stock:"
                +list+
                "</div>\
            ");
          }
          else
          {
            $('#insufficiientproducts_container').empty();
            if(cash == "" || cash == 0)
            {
              alert("Please specify cash");
              return false;
            }

            if(cash < total)
            {
              alert("Insufficient Cash");
              return false;
            }

            var summary_tbody = $('tbody','#order_summary');
            var summary_tr = "";
            var summary_tr1 = "";

            for(var i=0; i < arr_product.length; i++)
            {
              summary_tr += '<tr data-productid="'+arr_product[i]+'" data-quantity="'+arr_quantity[i]+'" data-price="'+arr_price[i]+'" data-amount="'+arr_amount[i]+'">\
                <td>'+arr_product_text[i]+'</td>\
                <td><input type="text" class="summaryqty" value="'+arr_quantity[i]+'" readonly /></td>\
                <td><input type="text" class="summaryprice" value="'+arr_price[i]+'" readonly /></td>\
                <td><input type="text" class="summaryprice" value="'+arr_amount[i]+'" readonly /></td>\
              </tr>';
            }

            $('#tbl_ordersummary > tbody').empty().append(summary_tr);

            var pay_summary = '\
              <table class="pull-right">\
                <tr>\
                  <td class="text-right"><strong>Total Amount</td>\
                  <td class="text-right" width="20%"><strong>&#8369;</td>\
                  <td class="text-right" id="summary_total"><input type="text" class="summaryprice" value="'+total.toFixed(2)+'" readonly /></td>\
                </tr>\
                <tr>\
                  <td class="text-right"><strong>Amount Paid</strong></td>\
                  <td class="text-right"><strong>&#8369;</td>\
                  <td class="text-right" id="summary_cash"><input type="text" class="summaryprice" value="'+cash.toFixed(2)+'" readonly /></td>\
                </tr>\
                <tr>\
                  <td class="text-right"><strong>Change</strong></td>\
                  <td class="text-right"><strong>&#8369;</td>\
                  <td class="text-right" id="summary_change"><input type="text" class="summaryprice" value="'+change+'" readonly /></td>\
                </tr>\
              </table>\
            ';

      for(var i=0; i < arr_product.length; i++)
            {
              summary_tr1 += '<tr data-productid="'+arr_product[i]+'" data-quantity="'+arr_quantity[i]+'" data-price="'+arr_price[i]+'" data-amount="'+arr_amount[i]+'">\
                <td>'+arr_product_text[i]+'</td>\
                <td><input type="text" class="summaryqty" value="'+arr_quantity[i]+'" readonly style="width:50px; border:0px" /></td>\
                <td><input type="text" class="summaryprice" value="'+arr_price[i]+'" readonly style="width:50px; border:0px" /></td>\
                <td><input type="text" class="summaryprice" value="'+arr_amount[i]+'" readonly style="width:50px; border:0px" /></td>\
              </tr>';
            }

            $('#tbl_ordersummary > tbody').empty().append(summary_tr1);

	    var pay_summary1= '\
              <table class="pull-right">\
                <tr>\
                  <td class="text-right"><strong>Total Amount</td>\
                  <td class="text-right" width="20%"><strong>&#8369;</td>\
                  <td class="text-left" id="summary_total"><input type="text" class="summaryprice" value="'+total.toFixed(2)+'" readonly style="width:100px; border:0px" /></td>\
                </tr>\
                <tr>\
                  <td class="text-right"><strong>Amount Paid</strong></td>\
                  <td class="text-right"><strong>&#8369;</td>\
                  <td class="text-left" id="summary_cash"><input type="text" class="summaryprice" value="'+cash.toFixed(2)+'" readonly style="width:100px; border:0px" /></td>\
                </tr>\
                <tr>\
                  <td class="text-right"><strong>Change</strong></td>\
                  <td class="text-right"><strong>&#8369;</td>\
                  <td class="text-left" id="summary_change"><input type="text" class="summaryprice" value="'+change+'" readonly style="width:100px; border:0px"/></td>\
                </tr>\
              </table>\
            ';

            $('#pay_summary').empty().append(pay_summary);
	    $('#pay_summary1').empty().append(pay_summary1);

            $('.summaryqty').number(true);
            $('.summaryprice').number(true,2);
            $('#order_summary input').attr('style','border:0px;width:100px;');
            
            $('#order_summary').modal('show');
          }
        },
        error   : function(){
          alert('An error has occured.');
        },
        complete: function(){
          $('#btn_viewsummary').prop('disabled','').html('<i class="fa fa-check"></i> CHECK OUT');
        }
      });
    });


    $('#btn_hidesummary').click(function(){
      $('#order_summary').modal('hide');
    });
  })

  function compute_amount(thisrow){
    var price    = $('.order_price',thisrow),
        quantity = $('.order_quantity',thisrow),
        amount   = $('.order_amount',thisrow);

    var amount_val = parseFloat(price.val() || 0) * parseFloat(quantity.val() || 0);
    amount.val(amount_val.toFixed(2));
  }

  function compute_total(){
    var arr_amount = $('.order_amount'),
        total = $('#order_total'),
        total_val = 0.00;

    arr_amount.each(function(){
      total_val += parseFloat($(this).val() || 0);
    });

    total.val(total_val.toFixed(2));
  }

  /*function compute_change(){
    var cash = $('#order_cash'),
        cash_val = cash.val();
        total = $('#order_total');

    var change = parseFloat(cash.val() || 0) - parseFloat(total.val() || 0);

    $('#order_cash').val(parseFloat(cash_val).toFixed(2));
    if($('#order_cash').val() != '')
    {
      $('#order_change').val(change.toFixed(2));
    }
  }*/
</script>
<script>
  $(function(){
    //Initialize Select2 Elements
    $('.select2').select2()
    //CK Editor
    CKEDITOR.replace('editor1')
    CKEDITOR.replace('editor2')
  });
</script>

<!-- FUNCTIONS FOR SAVING ORDERS -->
<script type="text/javascript">
  $('#order_summary').on('click','#btn_confirmorder',function(){
    var a_product = [],
        a_quantity = [],
        a_price = [],
        a_amount = [];

    var total = $('#summary_total input').val(),
        cash = $('#summary_cash input').val(),
        change = $('#summary_change input').val();

    $('tbody tr',$('#tbl_ordersummary')).each(function(){
      a_product.push($(this).data('productid'));
      a_quantity.push($(this).data('quantity'));
      a_price.push($(this).data('price'));
      a_amount.push($(this).data('amount'));
    });
    
    $.ajax({
      url       : 'orders_add.php',
      data      : {
        a_product : a_product,
        a_quantity : a_quantity,
        a_price : a_price,
        a_amount : a_amount,
        total : total,
        cash : cash,
        change : change
      },
      method    : 'POST',
      beforeSend: function(){
        $('#btn_confirmorder').prop('disabled',true).text('Saving...');
      },
      success   : function(){
        $('#or').modal('show');
        $('#order_summary').modal('hide');
      },
      error   : function(){
        alert('An error has occured.');
      },
      complete: function(){
        $('#btn_confirmorder').prop('disabled',false).text('CONFIRM');
      }
    });
  });
  $('#paybill').click(function(){
    var reservation_id = $('#reservation_id').val(),
        total = parseFloat(($('#total').val()).replace(',','')),
        amount_paid = parseFloat(($('#amount_paid').val()).replace(',',''));
        
    if(amount_paid < total)
    {
      alert('Insufficient amount.');
      return false;
    }

    $.ajax({
      url : 'billing.php',
      method : 'POST',
      data : {
        reservation_id : reservation_id,
        total : total,
        amount_paid : amount_paid
      },
      success : function(){
        window.location.href = 'bill1.php?copy='+reservation_id;
      },
      error : function(){
        alert('An error has occured.');
      }
    });
  });



  $('#edit').on('change','#dropdown_confirmation',function(){
    if($(this).val() == 'Confirm')
    {
      $('#declinecontainer').attr('style','display:none');
      $('#declinecontainer textarea').attr('disabled','true');
    }
    else
    {
      $('#declinecontainer').attr('style','display:block');
      $('#declinecontainer textarea').removeAttr('disabled');
    }
  });

  $('#grooming_modal').on('change','#status',function(){
    if($(this).val() == 'On Process')
    {
      document.getElementById('grooming_products_toggle').checked = false;
      $('#grooming_products').attr('style','display:none');
      $('#grooming_products_toggle').attr('disabled','true');
    }
    else
    {
      $('#grooming_products_toggle').removeAttr('disabled');
    }
  });

  $('.grooming_product').change(function(){
    var dropdown = $(this);
    var thisrow = dropdown.closest('tr');
    var value = dropdown.val();
    var price = $('option[value="'+value+'"]',dropdown).data('price');
    $('.grooming_price',thisrow).val(price);
  });

  $('.grooming_quantity').keyup(function(){
    var thisrow = $(this).closest('tr');
    var price = $('.grooming_price',thisrow).val();
    var qty = $('.grooming_quantity',thisrow).val();
    $('.grooming_amount',thisrow).val(parseFloat(price * qty).toFixed(2));
  });

  $('#grooming_addproduct').click(function(){
      var row = $('#grooming_table > tbody > tr').last();
      var newrow = row.clone(row);
      var tbody = row.closest('tbody');
      tbody.append(newrow);
      $('input',newrow).val('');
    });

  $('#grooming_modal').on('click','#grooming_submit',function(){
    var a_product = [],
        a_productid = [],
        a_quantity = [],
        a_price = [];

    var reservation_id = $('#reservation_id').val(),
        status = $('#status',$('#grooming_modal')).val(),
        s_price = $('#s_price').val();

    if(document.getElementById('grooming_products_toggle').checked) {
      $('tbody tr',$('#grooming_table')).each(function(){
        var productid = $('.grooming_product',$(this)).val();
        a_product.push($('option[value="'+productid+'"]',$('.grooming_product',$(this))).text());
        a_productid.push(productid);
        a_quantity.push($('.grooming_quantity',$(this)).val());
        a_price.push($('.grooming_price',$(this)).val());
      });
    }

    $.ajax({
      url       : 'orders_validate_qty.php',
      data      : {
        a_product : a_productid,
        a_quantity : a_quantity
      },
      dataType  : 'JSON',
      method    : 'POST',
      beforeSend: function(){
        $('#grooming_submit').prop('disabled',true).html('Validating...');
      },
      success   : function(response){
        console.log(a_productid);
        var list = '<ul>';
        if(response.length > 0)
        {
          $(response).each(function(idx,val){
            list += '<li>'+val+'</li>';
          });
          list += '</ul>';
          $('#insufficiientproducts_container').html("\
            <div class='alert alert-danger alert-dismissible'>\
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>\
              <h4><i class='icon fa fa-warning'></i> Error!</h4>\
              The following products have insufficient stock:"
              +list+
              "</div>\
          ");
          $('#grooming_submit').prop('disabled','').html('<i class="fa fa-check"></i> Submit');
        }
        else
        {
          $.ajax({
            url       : 'cnf.php',
            data      : {
              a_product : a_product,
              a_productid: a_productid,
              a_quantity : a_quantity,
              a_price : a_price,
              reservation_id :reservation_id,
              status : status,
              s_price : s_price
            },
            method    : 'POST',
            beforeSend: function(){
              $('#grooming_submit').prop('disabled',true).text('Saving...');
            },
            success   : function(){
              alert('Process Done.');
            },
            error   : function(){
              alert('An error has occured.');
            },
            complete: function(){
              $('#findings').modal('hide');
              $('#btn_confirmorder').prop('disabled',false).text('Submit');
              window.location = '../fd/reservations.php';
            }
          });
        }
      },
      error     : function(){
        alert('An error has occured.');
      },
      complete  : function(){
        // $('#grooming_submit').prop('disabled','').html('<i class="fa fa-check"></i> Submit');
      }
    });
  });
</script>

