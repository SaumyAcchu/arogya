 <table cellpadding="6" cellspacing="1" style="width:100%" border="0" class="table table-bordered">

<tr class="info" style="color: black;">
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">BV</th>
        <th style="text-align:right">Sub Total</th>
        <th style="text-align:right">PV</th>
        <th style="text-align:right">PV Total</th>
        <th>Actiopn</th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>
<!-- <?php 
echo "<pre>";
print_r($items); ?> -->

        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
        <tr>
                <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5','readonly'=>'true')); ?></td>
                <td>
                        <?php echo $items['name']; ?>

                       <!--  <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                        <?php endforeach; ?>
                                </p>

                        <?php endif; ?> -->

                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?></td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['cv']); ?></td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['qty']*$items['cv']); ?></td>
                <td> 

                  <button type="button" class="btn btn-warning" onclick="addToCartRemove('<?php echo $items['rowid']; ?>')" style="background-color:  #f34235;">Remove</button>
                </td>
        </tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>         <!-- <td colspan="2"> </td> -->         <td class="left"
colspan="2"><strong>Total</strong> <?= $this->cart->total_items(); ?></td>         <td class="left"><?php echo
$this->cart->format_number($this->cart->total()); ?></td>         <td
class="left" colspan="3"><strong>-</strong></td> <td><a class="btn btn-warning" href="<?=base_url('user/explore/products-payment');?>"> <i class="fa fa-inr"></i>Go To Purchase</a></td> </tr>

</table>