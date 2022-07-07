        <style>
            @page { size: auto;  margin-top: 0mm; margin-bottom: 0mm; }
        </style>
        <?php
            $itemNameArray = explode("|", $itemName);
            $itemUnitPriceArray = explode("|", $itemUnitPrice);
            $itemQuantityArray = explode("|", $itemQuantity);
            $itemTotalPriceArray = explode("|", $itemTotalPrice);
        ?>
        <main class="page-wrapper">
            <div class="container pb-5 mb-2 mb-md-4">
                <div class="row" id="printDiv">
                    <!-- Content  -->
                    <section class="col-lg-12">
                        <div class="card-body">
                            <table class="table" style="border: transparent;">
                                <tbody>
                                    <tr>
                                        <td width="25%"><button class="btn btn-primary" id="printPageHomeButton">Home</button></td>
                                        <td width="50%"><h1 class="fs-base mb-0 text-center">Invoice</h1></td>
                                        <td width="25%"><button class="btn btn-primary float-end" id="printPageButton" onClick="window.print();">Generate Invoice</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- Section for Invoice information -->
                    <section class="col-lg-12">
                        <div class="card-body">
                            <table class="table" style="border: transparent;">
                                <tbody>
                                    <tr>
                                        <td><b>Billed To:</b><br><?php echo $invoiceName; ?></td>
                                        <td><b>Invoice Id:</b><br><?php echo $invoiceId; ?></td>
                                        <td class="float-end"><b>Invoice Total:</b><br><h1 class="text-primary"><?php echo "$ " . number_format($grandTotal, 2); ?></h1></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- Section for Item Listing -->
                    <section class="col-lg-12">
                        <!-- View Invoice -->
                        <div class="card-body">
                            <h3 class="mb-4">Item Details</h3>
                            <table class="table table-bordered">
                                <thead class="text-primary">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($itemNameArray as $itemNameKey => $itemName) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $itemName; ?></th>
                                            <td><?php echo $itemUnitPriceArray[$itemNameKey]; ?></td>
                                            <td><?php echo $itemQuantityArray[$itemNameKey]; ?></td>
                                            <td><?php echo $itemTotalPriceArray[$itemNameKey]; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <!-- Section for Subtotal and Total -->
                    <section class="col-lg-12">
                        <div class="card-body">
                            <table class="table" style="border: transparent;">
                                <tbody>
                                    <tr>
                                        <td colspan="2" width="60%">&nbsp;</td>
                                        <td class="text-primary align-middle"><h5>Sub Total</h5></td>
                                        <td class="align-middle"><h6><?php echo "$ " . number_format($subTotalWithoutTax, 2); ?></h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" width="60%">&nbsp;</td>
                                        <td class="text-primary align-middle"><h5>Tax</h5></td>
                                        <td class="align-middle"><h6><?php echo "$ " . number_format($taxAmount, 2); ?></h6></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" width="60%">&nbsp;</td>
                                        <td class="text-primary align-middle"><h5>Discount</h5></td>
                                        <td class="align-middle"><h6><?php echo "$ " . number_format($discount, 2); ?></h6></td>
                                    </tr>
                                    <tr>
                                        <td><b>Invoice Terms:</b><br>Terms & Conditions if any</td>
                                        <td>&nbsp;</td>
                                        <td class="text-primary align-middle"><h5>Grand Total</h5></td>
                                        <td class="align-middle"><h6><?php echo "$ " . number_format($grandTotal, 2); ?></h6></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                </div>
            </div>
        </main>
        <?php $this->load->view('includes/footer-includes'); ?>

        <!-- Load the print function and home page link -->
        <script defer>
            window.print();

            $(document).on('click', '#printPageHomeButton', function() {
                window.location.href = window.baseUrl;
            });
        </script>
    </body>

</html>