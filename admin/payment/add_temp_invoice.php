<?php 
   $page_title="t";
   $page_icon='<i class="mdi mdi-currency-inr menu-icon"></i>&nbsp;&nbsp';

   require '../config.php';

   function client_details($id)
   {
     require '../config.php';
     error_reporting('0');
   $data='';
       $sql="SELECT `id`, `office_name`,`office_address`, `office_contact_no`, `GstNO` FROM `office_deatils` WHERE `id`='$id'";
       $run=mysqli_query($conn,$sql);
      
     while ($row=mysqli_fetch_array($run))
     {
        $data.="<br>".$row['office_name'];
        $data.="<br>".$row['office_address'];
        $data.="<br>".$row['office_contact_no'];
        $data.="<br>".$row['GstNO'];
     }
     echo  $data;
   }
   ?>
   <div class="content-wrapper">
      <form class="form" style="max-width: none; width: 1005px;">
    <h2 class="text-center mt-2 mb-3"> Tax Invoice </h2>
      <div class="container" style="border:1px solid black;">

        <div class="row">
          <div class="col-6" style="border:1px solid black; height: 150px;">
            Form :-<br>
            <?php echo $company_name;?><br>
            <?php echo $company_address?>
          </div>

          <div class="col-6" style="border:1px solid black; height: 150px;">

            <div class="row">
              <div class="col-6" style="border:1px solid black; height: 50px;">
                Invoice Number
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                Dated :<br> <?php echo $today=date('Y-m-d');?>
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                Delivery Note
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                 Mode/ Terms of payment
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                 supplier's ref
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                 other reference(s)
              </div>

            </div>

          </div>

        </div>
        <div class="row">
          <div class="col-6" style="border:1px solid black; height: 230px;">
            To
            <?php  $d=$_GET['companyid'];?>
              <?php  client_details($d);?>
          </div>

          <div class="col-6" style="border:1px solid black; height: 230px;">

            <div class="row">
              <div class="col-6" style="border:1px solid black; height: 50px;">
                Buyer's ordr No.
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                Dated
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                Despatch Document No.
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                 Dilivery Note Date
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                 Despatched through
              </div>
              <div class="col-6" style="border:1px solid black; height: 50px;">
                 Destination
              </div>
              <div class="col-12" style="border:1px solid black; height:80px;">
                Terms of Delivery 
              </div>
            </div>

          </div>
          <table class="mt-3" width="100%" border="1">
            <tr>
              <td width="2%">
                Sr.No
              </td>
              <td width="46%">
                Description of Goods 
              </td>
              <td>
                HSN/SAC 
              </td>
              <td>
                Quantity
              </td>
              <td>
                Rate
              </td>
              <td>
                per
              </td>
              <td>
                Amount
              </td>
            </tr>
            <?php  $date=$_GET['date'];

            $sql_for_data="SELECT  `services_name`, `hsn_number`, `qunatity`, `rate`, `price_type`, `amount` FROM `temp_invoice` WHERE `comapny_id`='$d' AND `date`='$date';";
            $run_for_data=mysqli_query($conn,$sql_for_data);
            $sr;
            while ($row_for_data=mysqli_fetch_array($run_for_data))
            {
              $sr=$sr+1;
              ?>
              <tr>
                <td width="2%">
                 <?php echo $sr;?>
                </td>
                <td width="46%">
                  <?php echo $row_for_data['services_name'];?>
                </td>
                <td>
                  <?php echo $row_for_data['hsn_number'];?>
                </td>
                <td>
                  <?php echo $row_for_data['qunatity'];?>
                </td>
                <td>
                  <?php echo $row_for_data['rate'];?>
                </td>
                <td>
                  <?php echo $row_for_data['price_type'];?>
                </td>
                <td>
                 <?php echo $row_for_data['amount'];?>
                </td>
              </tr>
              <?php
            }

            ?>
            <tr>
              <td width="2%">
                
              </td>
              <td width="46%" align="right" style="margin-right:80px;">
                Total
              </td>
              <td>
                 
              </td>
              <td>
                
              </td>
              <td>
                
              </td>
              <td>
                
              </td>
              <td>
                Amount
              </td>
            </tr>
          </table>
          <div class="container-fluid mt-2">
            <div class="row">
              <div class="col-11">
                Amount Chargeable (in words)
              </div>
              <div class="col-1">
                E. & O.E
              </div>
            </div>
            amount
          </div>
          <div class="container-fluid mt-2">
            <table width="100%" style="border:1px solid black;">
            <tr style="border:1px solid black;">
              <td rowspan="2" style="border:1px solid black;">
                HSN/SAC
              </td>
              <td rowspan="2"style="border:1px solid black;">
                Taxable Value
              </td>
              <td colspan="2"style="border:1px solid black;">
                central tax
              </td>
              <td colspan="2"style="border:1px solid black;">
                state tax
              </td>
              <td rowspan="2"style="border:1px solid black;">
                total amount
              </td>
            </tr>
            <tr style="border:1px solid black;">
              <td style="border:1px solid black;">
                Rate
              </td>
              <td>
                Amount
              </td>
              <td style="border:1px solid black;">
                Rate
              </td>
              <td style="border:1px solid black;">
                Amount
              </td>
            </tr>
            <tr style="border:1px solid black;">
              <td>
                
              </td>
              <td align="right" style="margin-right: 60px;">
                Total
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
              <td style="border:1px solid black;">
                
              </td>
            </tr>
          </table>

          </div>
          <div class="container-fluid mt-2" style="height:50px;">
            Tax Amount ( in words ) 
          </div>
          <div class="row">
            <div class="col-6">
              
            </div>
            <div class="col-6">
              <p>
                Company Bank Details 
              </p>
              <table>
                <tr>
                  <td>
                    Bank Name  
                  </td>
                  <td>
                    : GS Mahanagar Co-Oprative Bank Ltd
                  </td>
                </tr>
                <tr>
                  <td>
                    A/C
                  </td>
                  <td>
                    : 052011200004493
                  </td>
                </tr>
                <tr>
                  <td>
                    Branch & IFS Code 
                  </td>
                  <td>
                    : Chandan Nagar & MCBL0960052
                  </td>
                </tr>
              </table>
            </div>
            <div class="col-6 mt-2">
              <ul>
                Declaration
              </ul>
              <p>
                We declare that this invoice shows the actual price of the
                goods described and that all particulars are true and
                correct.
              </p>
            </div>
            <div class="col-5 p-3 container-fluid mt-2" style="border:1px solid black;">

            </div>
          </div>
      </div>   
    </div>
      <p class="text-center mt-2">This is a Computer Generated Invoice</p> 
      <div class="text-center">
        <input type="button" id="create_pdf" value="Generate PDF" class="m-2"> 
      </div>
    </div>
    <form>
      <?php 
        $file_name="invoice_format.pdf";
      ?>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <script>
    (function () {
        var
         form = $('.form'),
         cache_width = form.width(),
         a4 = [595.28, 841.89]; // for a4 size paper width and height

        $('#create_pdf').on('click', function () {
            $('body').scrollTop(0);
            createPDF();
        });
        //create pdf
        function createPDF() {
            getCanvas().then(function (canvas) {
                var
                 img = canvas.toDataURL("image/png"),
                 doc = new jsPDF({
                     unit: 'px',
                     format: 'a4'
                 });
                doc.addImage(img, 'JPEG', 20, 20);
                doc.save('<?php echo $file_name;?>');
                form.width(cache_width);
            });
        }

        // create canvas object
        function getCanvas() {
            form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
            return html2canvas(form, {
                imageTimeout: 2000,
                removeContainer: true
            });
        }

    }());
</script>
<script>
    (function ($) {
        $.fn.html2canvas = function (options) {
            var date = new Date(),
            $message = null,
            timeoutTimer = false,
            timer = date.getTime();
            html2canvas.logging = options && options.logging;
            html2canvas.Preload(this[0], $.extend({
                complete: function (images) {
                    var queue = html2canvas.Parse(this[0], images, options),
                    $canvas = $(html2canvas.Renderer(queue, options)),
                    finishTime = new Date();

                    $canvas.css({ position: 'absolute', left: 0, top: 0 }).appendTo(document.body);
                    $canvas.siblings().toggle();

                    $(window).click(function () {
                        if (!$canvas.is(':visible')) {
                            $canvas.toggle().siblings().toggle();
                            throwMessage("Canvas Render visible");
                        } else {
                            $canvas.siblings().toggle();
                            $canvas.toggle();
                            throwMessage("Canvas Render hidden");
                        }
                    });
                    throwMessage('Screenshot created in ' + ((finishTime.getTime() - timer) / 1000) + " seconds<br />", 4000);
                }
            }, options));

            function throwMessage(msg, duration) {
                window.clearTimeout(timeoutTimer);
                timeoutTimer = window.setTimeout(function () {
                    $message.fadeOut(function () {
                        $message.remove();
                    });
                }, duration || 2000);
                if ($message)
                    $message.remove();
                $message = $('<div ></div>').html(msg).css({
                    margin: 0,
                    padding: 10,
                    background: "#000",
                    opacity: 0.7,
                    position: "fixed",
                    top: 10,
                    right: 10,
                    fontFamily: 'Tahoma',
                    color: '#fff',
                    fontSize: 12,
                    borderRadius: 12,
                    width: 'auto',
                    height: 'auto',
                    textAlign: 'center',
                    textDecoration: 'none'
                }).hide().fadeIn().appendTo('body');
            }
        };
    })(jQuery);
</script>
   </div>
   