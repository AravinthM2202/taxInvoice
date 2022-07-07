var customObj = {
    onLoad: function () {
        this.registerEvent();
    },
    registerEvent: function () {
        var self = this;
        
        // Table with server side processing
        var invoiceList = $('#invoiceList').DataTable({
            "processing": true,
            "serverSide": true,
            "autoWidth":false,
            "ajax": window.baseUrl + "home/invoiceList",
            columnDefs: [			
                {"searchable": false, "orderable": false, "width": "85px", "targets": 0},
                {"width": "800px", "targets": 1},
                {"width": "800px", "targets": 2},
                {"width": "800px", "targets": 3},
                {"width": "400px", "targets": 4},
                {"width": "400px", "targets": 5},
                {"width": "400px", "targets": 6}
            ],
            order: [[1, 'desc']]
        });

        // Table list Counter
        invoiceList.on('draw.dt', function () {
            var info = invoiceList.page.info();
            invoiceList.column(0, {search:'applied', order:'applied', page: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1 + info.start;
            });
        }).draw();

        // Added new item
        var templateCounter = 1;
        var template = jQuery.validator.format($.trim($("#addChild").html()));
        $(document).on('click', '#addItem', function(e) {
            $(template(++templateCounter)).appendTo("#invoiceItems");
            e.preventDefault();

            $('html, body').animate({
                'scrollTop' : $("#invoiceItem" + templateCounter).position().top
            });
        });

        // Remove added item
        $(document).on('click','.removeItem',function() {
            $('#invoiceItemsErrorDiv').hide();
            $(this).closest("div.invoiceItem").remove();
        });

        // JQuery Validator For Particular Number
        jQuery.validator.addMethod("validateTaxPercent", function (value, element) {
            var validPercentage = ['0', '1', '5', '10'];
            if(validPercentage.includes(value)) {
                return true;
            } else {
                return false;
            }
        },"Tax percentage should be any one of the following 0, 1, 5, 10.");

        // Form Validation and Submission
        $('#createInvoiceForm').submit(function(e) {
            e.preventDefault();
        }).validate({
            rules: {
                'quantity[]': {
                    required: true,
                    number: true,
                    maxlength:5
                },
                'unitPrice[]': {
                    required: true,
                    number: true,
                    maxlength:5
                },
                taxPercentage: {
                  required: true,
                  number: true,
                  maxlength:2,
                  validateTaxPercent: true
                },
                discount: {
                    required: false,
                    digits: true
                }
            },
            submitHandler: function (form) {
                $('input.itemName').each(function() {
                    $(this).rules("add", {
                        required: true
                    });
                });

                $("html, body").animate({ scrollTop: 0 }, "slow");
                var ajaxUrl = window.baseUrl + "home/addInvoiceDetails";
                var data = $(form).serialize();
                
                self.ajaxCall(ajaxUrl, data, "Invoice details added successfully.", window.baseUrl, "invoiceSubmitBtn");
            }
        });
    },
    ajaxCall: function (url, data, successMessage, redirectUrl, buttonId) {
        var self = this;
        self.showInfoAlert(buttonId);

        // Common Ajax Call
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: 'JSON',
            success: function (result) {
                if (result.status == 1) {
                    self.showSuccessAlert(successMessage, buttonId);
                    setTimeout("window.open('" + redirectUrl + "','_self'); ", 4000);                 
                } else {
                    self.showErrorAlert(result.message, buttonId);
                }
            }
        });
    },
    showSuccessAlert : function(message, buttonId) {
        var self = this;
        
        $("#" + buttonId).prop('disabled', true);
        $("#successMessage").html(message);
        self.hideInfoAlert();
        $("#successAlert").slideDown(1000);
        setTimeout(function () {
            self.hideSuccessAlert();            
        }, 4000);
    },
    hideSuccessAlert : function() {
        $("#successAlert").slideUp(1000);
    },
    showErrorAlert : function(message, buttonId) {
        var self = this;

        $("#" + buttonId).prop('disabled', false);
        $("#errorMessage").html(message);
        self.hideInfoAlert();
        $("#errorAlert").slideDown(1000);
        setTimeout(function () {
            self.hideErrorAlert();            
        }, 4000);
    },
    hideErrorAlert : function() {
        $("#errorAlert").slideUp(1000);
    },
    showInfoAlert : function(buttonId) {
        $("#" + buttonId).prop('disabled', true);
        $("#infoAlert").slideDown(1000);
    },
    hideInfoAlert : function() {
        $("#infoAlert").slideUp(1000);
    },
    sectionToTop : function(sectionId) {
        $('#' + sectionId).animate({ scrollTop: 0 }, 'slow');
    }
}