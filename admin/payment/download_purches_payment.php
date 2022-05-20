<?php 
require '../config.php';
require 'services_function.php';
                   $table_data='<table class="table table-hover mt-1 mt-2" border=1 width=100%>
                      <thead>
                        <tr>
                          <th scope="col">
                            Sr.no
                          </th>
                          <th scope="col">
                            Invoice Number
                           </th>
                          <th scope="col">
                            Office Name
                          </th>
                          <th scope="col">
                            Amount
                          </th>
                          <th scope="col">
                            Mode 
                          </th>
                          <th scope="col">
                            Date & Time
                          </th>
                        </tr>
                      </thead>
                        <tbody>';
                           
                           $s=0;
                              $sql_for_invoice="SELECT purches_invoice.invoice_number,purches_invoice.supplier_id,purches_payment.amount,purches_payment.mode ,purches_payment.create_at FROM purches_invoice INNER JOIN purches_payment ON purches_invoice.id = purches_payment.invoice_id";
                              $run_for_invoice=mysqli_query($conn,$sql_for_invoice);
            
                              $s=$s+1;
                            while($row_for_invoice=mysqli_fetch_array($run_for_invoice))
                               {
                                
                                $table_data.='<tr>
                                    <td>
                                       '.$s.'
                                    </td>
                                    <td>
                                       '.$row_for_invoice['invoice_number'].'
                                    </td>
                                    <td>
                                       '.supplier_name($row_for_invoice['supplier_id']).'
                                    </td>
                                    <td>
                                       '.$row_for_invoice['amount'].'
                                    </td>
                                    <td>
                                       '.$row_for_invoice['mode'].'
                                    </td>
                                     <td>
                                       '.$row_for_invoice['create_at'].'
                                    </td>
                                 </tr>';
                              }
                           
                         $table_data.='</tbody>
                      </table>';

$file_name=date('Y-m-d')." purches payment ";
header('Content-Type:application/xls');
 	header('Content-Disposition:attachment;filename='.$file_name.'.xls');
 	echo $table_data;
?>