</div>
<br><br>
<div class="col-md-12 text-center">&copy; Copyright 2019-2020 Crosspoint Paper Inc.</div>


<script>

  function selectcustomer(){
      jQuery('#modal_errors').html("");
      var error = '';
      var data = jQuery('#add_product_form').serialize();
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/new_do.php',
          method : 'post',
          data : data,
          success : function(){
            location.reload();
          },
          error : function(){alert("Something went wrong");}
        });
    }



  function change_customer1(){
      jQuery('#modal_errors').html("");
      var data = jQuery('#add_product_form1').serialize();
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/change_customer.php',
          method : 'post',
          data : data,
          success : function(){
            location.reload();
          },
          error : function(){alert("Something went wrong");}
        });
  }

  function item_modal(id,mode,txn_id){
      var data = {"id" : id, "mode" : mode, "txn_id" : txn_id};
      jQuery.ajax({
        url : '/crosspointpaper/admin_area/item_modal.php',
        method : "post",
        data : data,
        success: function(data){
          jQuery('body').append(data);
          jQuery('#details-modal').modal('toggle');
        },
        error: function(){
          alert("Something went wrong!");
        }
      });
    }

    function c_modal(id,mode,txn_id){
        var data = {"id" : id, "mode" : mode, "txn_id" : txn_id};
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/choose_customer.php',
          method : "post",
          data : data,
          success : function(data){
            jQuery('body').append(data);
          },
          error : function(){alert("Something went wrong.");},
        });
      }

      function select_order(id,mode){
          var data = {"id" : id, "mode" : mode};
          jQuery.ajax({
            url : '/crosspointpaper/admin_area/select_order.php',
            method : "post",
            data : data,
            success : function(data){
              jQuery('body').append(data);
            },
            error : function(){alert("Something went wrong.");},
          });
        }

        function select_si(id,mode){
            var data = {"id" : id, "mode" : mode};
            jQuery.ajax({
              url : '/crosspointpaper/admin_area/select_order.php',
              method : "post",
              data : data,
              success : function(data){
                jQuery('body').append(data);
              },
              error : function(){alert("Something went wrong.");},
            });
          }


    function item_modal2(id){
        var data = {"id" : id};
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/item_modal2.php',
          method : "post",
          data : data,
          success: function(data){
            jQuery('body').append(data);
            jQuery('#details-modal').modal('toggle');
          },
          error: function(){
            alert("Something went wrong!");
          }
        });
      }

    function customer_modal(id){
        var data = {"id" : id};
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/customer_modal.php',
          method : "post",
          data : data,
          success: function(data){
            jQuery('body').append(data);
            jQuery('#details-modal').modal('toggle');
          },
          error: function(){
            alert("Something went wrong!");
          }
        });
      }

function update_cart1(mode,edit_id){
    var data = {"mode" : mode, "edit_id" : edit_id};
    jQuery.ajax({
      url : '/crosspointpaper/admin_area/update_cart.php',
      method : "post",
      data : data,
      success : function(){location.reload();},
      error : function(){alert("Something went wrong.");},
    });
  }


  function update_cart2(mode,edit_id){
      var data = {"mode" : mode, "edit_id" : edit_id};
      jQuery.ajax({
        url : '/crosspointpaper/admin_area/update_cart1.php',
        method : "post",
        data : data,
        success : function(){open('index.php?view_orders','_self');},
        error : function(){alert("Something went wrong.");},
      });
    }

    function update_cart222(mode,edit_id){
        var data = {"mode" : mode, "edit_id" : edit_id};
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/update_cart1.php',
          method : "post",
          data : data,
          success : function(){open('index.php?view_CrSr','_self');},
          error : function(){alert("Something went wrong.");},
        });
      }

    function update_cartt3(mode,edit_id){
        var data = {"mode" : mode, "edit_id" : edit_id};
        jQuery.ajax({
          url : '/crosspointpaper/admin_area/update_cart1.php',
          method : "post",
          data : data,
          success : function(){open('index.php?view_purchase_orders','_self');},
          error : function(){alert("Something went wrong.");},
        });
      }

      function update_cart22(mode,edit_id){
          var data = {"mode" : mode, "edit_id" : edit_id};
          jQuery.ajax({
            url : '/crosspointpaper/admin_area/update_cart1.php',
            method : "post",
            data : data,
            success : function(){open('index.php?view_job_order','_self');},
            error : function(){alert("Something went wrong.");},
          });
        }

  function updateSizes(){
    var sizeString = '';
    for(var i=1; i<=12; i++){
      if(jQuery('#size'+i).val() != ''){
        sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
        // ':'+jQuery('#threshold'+i).val()+
      }
    }
    jQuery('#sizes').val(sizeString);
  }

  function get_child_options(selected){
    if(typeof selected === 'undefined'){
      var selected = '';
    }
    var parentID = jQuery('#parent').val();
    jQuery.ajax({
      url: '/crosspointpaper/admin_area/child_categories.php',
      type: 'POST',
      data: {parentID : parentID, selected: selected},
      success: function(data){
        jQuery('#child').html(data);
      },
      error: function(){alert("Something went wrong with the child options.")},
    });
  }
  jQuery('select[name="parent"]').change(function(){
    get_child_options();
  });
</script>

</body>
</html>
