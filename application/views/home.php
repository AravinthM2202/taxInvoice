        
        <main class="page-wrapper">
            <div class="container pb-5 mb-2 mb-md-4">
                <div class="row">
                    <!-- Content  -->
                    <section class="col-lg-12">
                        <!-- Invoice List -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="<?php echo base_url('home/createInvoice'); ?>" class="btn btn-primary" role="button">Create Invoice</a>
                                <h4 class="fs-base mb-3 text-center">List of items you added to Invoice</h4>
                                <table class="table table-bordered" id="invoiceList">
                                    <thead class="text-primary">
                                        <tr>
                                            <th class="text-primary">S.No</th>
                                            <th class="text-primary">Invoice Id</th>
                                            <th class="text-primary">Invoice Name</th>
                                            <th class="text-primary">Grand Total</th>
                                            <th class="text-primary">Created Date</th>
                                            <th class="text-primary">Status</th>
                                            <th class="text-primary">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
        <?php $this->load->view('includes/footer-includes'); ?>

    </body>

</html>