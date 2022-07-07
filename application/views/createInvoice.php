        <main class="page-wrapper">
            <div class="container pb-5 mb-2 mb-md-4">
                <div class="row">
                    <!-- Content  -->
                    <section class="col-lg-12">
                        <!-- Create Invoice -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <button class="btn btn-primary" id="homePage">Home</button>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="fs-base mb-3 text-center">Create Invoice</h4>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                            <!-- Alert Messages -->
                            <?php $this->load->view('includes/basicAlert'); ?>

                            <!-- Create Invoice Form -->
                            <form class="row g-3" id="createInvoiceForm" method="post">
                                <div class="col-md-6">
                                    <label for="invoiceName" class="form-label">Invoice Name <span class="requiredLabel">*</span></label>
                                    <input type="text" class="form-control" id="invoiceName" name="invoiceName" placeholder="Invoice Name" required="" />
                                </div>

                                <div class="mt-5" id="invoiceItemsStart">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <legend>Invoice Items</legend>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="btn btn-primary float-end" id="addItem">Add Item</div>
                                        </div>
                                    </div>
                                </div>

                                <div id="invoiceItemsErrorDiv">
                                    <div class="row">
                                        <div class="col-12 requiredLabel" id="invoiceItemsErrorMessage">You have reached the limit count.</div>
                                    </div>
                                </div>

                                <div class="mb-5" id="invoiceItems">
                                    <div class="row invoiceItem mb-3" id="invoiceItem1">
                                        <div class="col-md-4">
                                            <label for="itemName1" class="form-label">Item Name <span class="requiredLabel">*</span></label>
                                            <input type="text" class="form-control itemName" id="itemName1" name="itemName[]" placeholder="Item Name" required="" />
                                        </div>

                                        <div class="col-md-4">
                                            <label for="unitPrice1" class="form-label">Unit Price (in $) <span class="requiredLabel">*</span></label>
                                            <input type="text" class="form-control unitPrice" id="unitPrice1" name="unitPrice[]" placeholder="Unit Price" required="" />
                                        </div>

                                        <div class="col-md-3">
                                            <label for="quantity1" class="form-label">Quantity <span class="requiredLabel">*</span></label>
                                            <input type="text" class="form-control quantity" id="quantity1" name="quantity[]" placeholder="Quantity" required="" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="taxPercentage" class="form-label">Tax (in %) <span class="requiredLabel">*</span></label>
                                    <input type="text" class="form-control" id="taxPercentage" name="taxPercentage" placeholder="Tax (in %)" required="" />
                                </div>

                                <div class="col-md-4">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" />
                                </div>

                                <div class="col-md-2">
                                    <label for="discountType" class="form-label">&nbsp;</label>
                                    <select class="form-select" id="discountType" name="discountType">
                                        <option value="amount">In $</option>
                                        <option value="percentage">In %</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" id="invoiceSubmitBtn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <?php $this->load->view('includes/footer-includes'); ?>

        <!-- Load Clone Content For Item -->
        <script type="text/html" id="addChild">
            <div class="row invoiceItem mb-3" id="invoiceItem{0}">
                <div class="col-md-4">
                    <label for="itemName{0}" class="form-label">Item Name <span class="requiredLabel">*</span></label>
                    <input type="text" class="form-control itemName" id="itemName{0}" name="itemName[]" placeholder="Item Name" required="" />
                </div>

                <div class="col-md-4">
                    <label for="unitPrice{0}" class="form-label">Unit Price (in $) <span class="requiredLabel">*</span></label>
                    <input type="text" class="form-control unitPrice" id="unitPrice{0}" name="unitPrice[]" placeholder="Unit Price" required="" />
                </div>

                <div class="col-md-3">
                    <label for="quantity{0}" class="form-label">Quantity <span class="requiredLabel">*</span></label>
                    <input type="text" class="form-control quantity" id="quantity{0}" name="quantity[]" placeholder="Quantity" required="" />
                </div>
                <div class="col-md-1">
                    <label>&nbsp;</label>
                    <a class="removeItem"><i class="fa fa-close" aria-hidden="true"></i></a>
                </div>
            </div>
        </script>
        
        <!-- Load Home URL For Button -->
        <script defer>
            $(document).on('click', '#homePage', function() {
                window.location.href = window.baseUrl;
            });
        </script>
    </body>

</html>