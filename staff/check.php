<?php 
   $page_title="Dashboard";
   $page_icon='<i class="mdi mdi-ticket-confirmation menu-icon"></i>&nbsp;&nbsp';
?>
<?php 
   require 'admin_header.php';
   
   ?>
   <div class="content-wrapper">
     
   <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
                    </li>                   
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="table-responsive">
                        	<table class="table table-hover mt-1 mt-2" id="services_data_unit">
		                      <thead>
		                        <tr>
		                          <th scope="col">
		                            Sr.no
		                          </th>
		                          <th scope="col">
		                            Office Name 
		                          </th>
		                          <th scope="col">
		                            Services Name
		                          </th>
		                          <th scope="col">
		                            Qunatity
		                          </th>
		                          <th scope="col">
		                            Date & Time
		                          </th>
		                        </tr>
		                      </thead>
		                  </table>
                        <div>
						</div>
						</div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="table-responsive">
                        	<table class="table table-hover mt-1 mt-2" id="services_data_month">
		                      <thead>
		                        <tr>
		                          <th scope="col">
		                            Sr.no
		                          </th>
		                          <th scope="col">
		                            Office Name 
		                          </th>
		                          <th scope="col">
		                            Services Name
		                          </th>
		                          <th scope="col">
		                            Status
		                          </th>
		                          <th scope="col">
		                            Date & Time
		                          </th>
		                        </tr>
		                      </thead>                        		
                        	</table>
                        </div>
                      </div>
                    </div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
   </div>

   <?php
      require 'admin_footer.php';
 ?>