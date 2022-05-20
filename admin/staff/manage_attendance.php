<?php 
   $page_title="Manage Attendance";
   $page_icon='<i class="mdi mdi-human-male-female menu-icon"></i>&nbsp;&nbsp';
   require '../admin_header.php';
?>
  <div class="content-wrapper">
      <div class="grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title"><?php echo $page_icon.$page_title;?></h4>
            <div class="row">
              <div class="col-4">
                <input type="text" name="" id="myInput" placeholder="Search" class="form-control">
              </div>  
              <div class="col-4">
               <div class="form-group">
	               <input type="date" name="date" id="date" class="form-control">
             	</div>
              </div>       
            </div> 
            <div class="ot">            
            
            </div>
            </div>
          </div>
        </div>
      </div>
      <script>
      	function load_att(date)
			{
				$.ajax({
				    url:'get_att.php',
				    type:'POST',
				    data:{
				      date:date
				    },success:function(res)
				    {
				      $('.ot').html(res);
				      $("#myInput").on("keyup", function() {
						var value = $(this).val().toLowerCase();
						$("#staff_data tr").filter(function() {
						  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
						});
						});
				    }
				  });
			}
		$(document).ready(function(){
			load_att('<?php echo date('Y-m-d')?>');		
			$('#date').on('change',function(){
			//alert('hello');
			let mon= $(this).val();
			  load_att(mon);
			});
		});
</script>

<?php
  require '../admin_footer.php';
?>