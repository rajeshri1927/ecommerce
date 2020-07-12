<link href="<?= base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<hr>
<?php
if (!isset($_GET['settings'])) {
    if (!empty($orders)) {
        ?>
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $tr) {
                        if ($tr['processed'] == 0) {
                            $class = 'bg-danger';
                            $type = 'No processed';
                        }
                        if ($tr['processed'] == 1) {
                            $class = 'bg-success';
                            $type = 'Processed';
                        }
                        if ($tr['processed'] == 2) {
                            $class = 'bg-warning';
                            $type = 'Rejected';
                        }
                        ?>
                        <tr>
                            <td class="relative" id="order_id-id-<?= $tr['order_id'] ?>">
                                # <?= $tr['order_id'] ?>
                                <?php if ($tr['viewed'] == 0) { ?>
                                    <div id="new-order-alert-<?= $tr['id'] ?>">
                                        <img src="<?= base_url('assets/imgs/new-blinking.gif') ?>" style="width:100px;" alt="blinking">
                                    </div>
                                <?php } ?>
                                <div class="confirm-result">
                                    <?php if ($tr['confirmed'] == '1') { ?>
                                        <span class="label label-success">Confirmed by email</span>
                                    <?php } else { ?> 
                                        <span class="label label-danger">Not Confirmed</span> 
                                    <?php } ?>
                                </div>
                            </td>
                            <td><?= date('d.M.Y / H:i:s', $tr['date']); ?></td>
                            <td>
                                <i class="fa fa-user" aria-hidden="true"></i> 
                                <?= $tr['first_name'] . ' ' . $tr['last_name'] ?>
                            </td>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> <?= $tr['phone'] ?></td>
                            <td class="<?= $class ?> text-center" data-action-id="<?= $tr['id'] ?>">
                                <div class="status" style="padding:5px; font-size:16px;">
                                    -- <b><?= $type ?></b> --
                                </div>
                                <div style="margin-bottom:4px;"><a href="javascript:void(0);" onclick="changeOrdersOrderStatus(<?= $tr['id'] ?>, 1, '<?= htmlentities($tr['products']) ?>', '<?= $tr['email'] ?>')" class="btn btn-success btn-xs">Processed</a></div>
                                <div style="margin-bottom:4px;"><a href="javascript:void(0);" onclick="changeOrdersOrderStatus(<?= $tr['id'] ?>, 0)" class="btn btn-danger btn-xs">No processed</a></div>
                                <div style="margin-bottom:4px;"><a href="javascript:void(0);" onclick="changeOrdersOrderStatus(<?= $tr['id'] ?>, 2)" class="btn btn-warning btn-xs">Rejected</a></div>
                            </td>
                            <td class="hidden" id="order-id-<?= $tr['order_id'] ?>">
                              <!--   <div class="table-responsive">
                                    <table class="table more-info-purchase">
                                        <tbody>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td><a href="mailto:<?= $tr['email'] ?>"><?= $tr['email'] ?></a></td>
                                            </tr>
                                            <tr>
                                                <td><b>City</b></td>
                                                <td><?= $tr['city'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td><?= $tr['address'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Postcode</b></td>
                                                <td><?= $tr['post_code'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Notes</b></td>
                                                <td><?= $tr['notes'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Come from site</b></td>
                                                <td>
                                                    <?php if ($tr['referrer'] != 'Direct') { ?>
                                                        <a target="_blank" href="<?= $tr['referrer'] ?>" class="orders-referral">
                                                            <?= $tr['referrer'] ?>
                                                        </a>
                                                    <?php } else { ?>
                                                        Direct traffic or referrer is not visible                       
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Payment Type</b></td>
                                                <td><?= $tr['payment_type'] ?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Discount</b></td>
                                                <td><?= $tr['discount_type'] == 'float' ? '-' . $tr['discount_amount'] : '-' . $tr['discount_amount'] . '%' ?></td>
                                            </tr>
                                            <?php if ($tr['payment_type'] == 'PayPal') { ?>
                                                <tr>
                                                    <td><b>PayPal Status</b></td>
                                                    <td><?= $tr['paypal_status'] ?></td>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td colspan="2"><b>Products</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <?php
                                                    $arr_products = unserialize($tr['products']);
                                                    foreach ($arr_products as $product) {
                                                        $total_amount = 0;
                                                        $total_amount += str_replace(' ', '', str_replace(',', '.',$product['product_info']['price']));
                                                        ?>
                                                        <div style="word-break: break-all;">
                                                            <div>
                                                                <img src="<?= base_url('attachments/shop_images/' . $product['product_info']['image']) ?>" alt="Product" style="width:100px; margin-right:10px;" class="img-responsive">
                                                            </div>
                                                            <a data-toggle="tooltip" data-placement="top" title="Click to preview" target="_blank" href="<?= base_url($product['product_info']['url']) ?>">
                                                                <?= base_url($product['product_info']['url']) ?>
                                                                <div style=" background-color: #f1f1f1; border-radius: 2px; padding: 2px 5px;">
                                                                    <b>Quantity:</b> <?= $product['product_quantity'] ?> / 
                                                                    <b>Price: <?= $product['product_info']['price'].' '.$this->config->item('currency') ?></b>
                                                                </div>
                                                            </a>
                                                            <div class="">
                                                                <b>Vendor:</b>
                                                                <a href=""><?= $product['product_info']['vendor_name'] ?></a>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div style="padding-top:10px; font-size:16px;">Total amount of products: <?= $total_amount.' '.$this->config->item('currency') ?></div>
                                                        <hr>
                                                    <?php }
                                                    ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> -->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?= $links_pagination ?>
    <?php } else { ?>
        <div class="alert alert-info">No orders to the moment!</div>
    <?php }
    ?>        
    <hr>
    <?php  } ?>
<script src="<?= base_url('assets/js/bootstrap-toggle.min.js') ?>"></script>
