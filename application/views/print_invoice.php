<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style type="text/css">
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
    
</style>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Bill No # <?php if(isset($bill_details[0]->bill_id)){ echo $bill_details[0]->bill_id; } ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					<?php if(isset($bill_details[0]->customer_name)){ echo $bill_details[0]->customer_name; } ?><br>
    					<?php if(isset($bill_details[0]->customer_name)){ echo $bill_details[0]->address; } ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>From:</strong><br>
    					AVS PrimeTechnology LLP<br>
    					1234 Main<br>
    					Apt. 4B<br>
    					Springfield, ST 54321
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?php if(isset($bill_details[0]->customer_type)){ echo $bill_details[0]->customer_type; } ?><br>
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php if(isset($bill_details[0]->bill_date)){ echo date('d-M-Y',strtotime($bill_details[0]->bill_date)); } ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $grand_totel = 0; foreach($bill_details as $row){ ?>
                                
    							<tr>
    								<td><?php echo $row->d_product_name; ?></td>
    								<td class="text-center"><?php echo $row->transaction_amount/$row->product_quantity; ?></td>
    								<td class="text-center"><?php echo +$row->product_quantity; ?></td>
    								<td class="text-right"><?php echo number_format($row->transaction_amount, 2); $grand_totel += $row->transaction_amount; ?></td>
    							</tr>
                                
                                <?php } ?>
                               
    						</tbody>
                                  <td></td>
                                  <td></td>
                                  <td></td> 
                                  <td style="text-align:right;"><?php echo number_format($grand_totel, 2); ?></td>
                            <tfoot>
                                
                                
                            </tfoot>
    					</table>
                        
                        <div class="col-md-12">
                            <a href="<?php echo base_url(); ?>/billing/add_billing">Back</a>
                        </div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>